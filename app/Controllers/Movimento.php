<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PagarModel;
use App\Models\ReceberModel;
use App\Models\MovimentoModel;

class Movimento extends BaseController
{
    public function index()
    {
        $movimentoModel = new MovimentoModel();
        $pagarModel = new PagarModel();
        $receberModel = new ReceberModel();
        $dt_inicial = $this->request->getGet('dt_inicial') ?? date('Y-m-01');
        $dt_final = $this->request->getGet('dt_final') ?? date('Y-m-t');
        $tipo       = $this->request->getGet('tipo');
       
        //=====LISTAGEM =====
        $builder = $movimentoModel;
        if (!empty($dt_inicial)) {
            $builder->where('dt_movimento >=', $dt_inicial);
        }
        if (!empty($dt_final)) {
            $builder->where('dt_movimento <=', $dt_final);
        }
        if (!empty($tipo)) {
            $builder->where('tipo', $tipo);
        }
        $movimento = $builder
            ->orderBy('dt_movimento', 'DESC')
            ->findAll();
        //========TOTAL DE ENTRADAS ==========
        $builderEntrada = $movimentoModel->builder();
        $builderEntrada->selectSum('valor');
        if (!empty($dt_inicial)) {
            $builderEntrada->where('dt_movimento >=', $dt_inicial);
        }
        if (!empty($dt_final)) {
            $builderEntrada->where('dt_movimento <=', $dt_final);
        }
        $builderEntrada->where('tipo', 'C');
        $totalEntradas = $builderEntrada->get()->getRow()->valor ?? 0;

        //=======TOTAL DE SAÍDAS ================
        $builderSaida = $movimentoModel->builder();
        $builderSaida->selectSum('valor');
        if (!empty($dt_inicial)) {
            $builderSaida->where('dt_movimento >=', $dt_inicial);
        }
        if (!empty($dt_final)) {
            $builderSaida->where('dt_movimento <=', $dt_final);
        }
        $builderSaida->where('tipo', 'D');
        $totalSaidas = $builderSaida->get()->getRow()->valor ?? 0;

        //===========SALDO ==================
        $saldo = $totalEntradas - $totalSaidas;
        
        //=========CONTAS RECEBER FUTURAS =====
        $receber = $receberModel
            ->select('
                id,
                nome as descricao,
                valor,
                dt_recebimento as data_vencimento,
                "RECEBER" as tipo,
            ')
            ->where('quitado',0)
            ->where('dt_recebimento >=', date('Y-m-d'))
            ->where('dt_recebimento <=', date('Y-m-d', strtotime('+30 days')))
            ->findAll();
        //==========CONTAS A PAGAR FUTURAS ===========
        $pagar = $pagarModel
            ->select('
                id,
                nome as descricao,
                valor_pagar as valor,
                dt_vencimento as data_vencimento,
                "PAGAR" as tipo,
            ')
            ->where('quitado',0)
            ->where('dt_vencimento >=', date('Y-m-d'))
            ->where('dt_vencimento <=',date('Y-m-d', strtotime('+30 days')))
            ->findAll();
        //===============UNIFICA A VERIFICAÇÃO ======

        $fluxoPrevisto = array_merge($receber,$pagar);
        usort($fluxoPrevisto,function($a,$b){
            return strtotime($a['data_vencimento']) - strtotime($b['data_vencimento']);
        });
        //===================CALCULA SALDO FUTURO ==================
        $saldoPrevisto = $saldo;
        foreach ($fluxoPrevisto as &$item) {
            if ($item['tipo'] == 'RECEBER') {
                $saldoPrevisto += $item['valor'];
            } else {
                $saldoPrevisto -= $item['valor'];
            }
            $item['saldo_previsto'] = $saldoPrevisto;
        }


        return view('financeiro/movimento', [
            'active_menu'   => 'movimento',
            'movimento'     => $movimento,
            'dt_inicial'    => $dt_inicial,
            'dt_final'      => $dt_final,
            'tipo'          => $tipo,
            'totalEntradas' => $totalEntradas,
            'totalSaidas'   => $totalSaidas,
            'saldo'         => $saldo,
            'fluxoPrevisto' => $fluxoPrevisto
        ]);
    }
}
