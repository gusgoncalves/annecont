<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObrigacoesClienteModel;
use App\Models\ObrigacoesModel;

class ObrigacoesCliente extends BaseController
{
    public function index()
    {
        //
    }
    //===================ABA DE OBRIGAÇÕES =====================
    public function abaObrigacoesCliente($id_cliente = null)
    {
        $ObrigacoesClienteModel = new ObrigacoesClienteModel();
        $obrigacoesModel = new ObrigacoesModel();

        $subquery = $ObrigacoesClienteModel
            ->select('id_obrigacao')
            ->where('id_cliente', $id_cliente)
            ->findAll();
        $ids = array_column($subquery, 'id_obrigacao');
        $combo_obrigacoes = $obrigacoesModel
            ->select('id, descricao')
            ->orderBy('descricao', 'ASC');

        if(!empty($ids)) {
            $combo_obrigacoes->whereNotIn('id', $ids);
        }
        $combo_obrigacoes = $combo_obrigacoes->findAll();

        $obrigacoes = $obrigacoesModel->findAll();
        $obrigacoescli = $ObrigacoesClienteModel
            ->select('obrigacoes_cliente.*,obrigacoes.descricao, obrigacoes.valor')
            ->join('obrigacoes','obrigacoes_cliente.id_obrigacao = obrigacoes.id')
            ->where('id_cliente', $id_cliente)
            ->orderBy('obrigacoes.descricao','ASC')
            ->findAll();
        
        $concluidas = 0;
        foreach($obrigacoescli as $o) {
            if($o['feito'] == 0) {
                $concluidas ++;
            }
        }
        $valorTotal = 0;
        foreach($obrigacoescli as $val) {
            $valorTotal += $val['valor'];
        }
        $data = [
            'id_cliente' => $id_cliente,
            'obrigacoescli' => $obrigacoescli,
            'active_menu' => 'area_cliente',
            'combo_obrigacoes' => $combo_obrigacoes,
            'obrigacoes' => $obrigacoes,
            'concluidas' => ($concluidas == 0),
            'valorTotal' => $valorTotal
        ];
        return view('obrigacoes/obrigacoes_cliente/index', $data);
    }
    //==============INSERE OS DADOS NA FICHA DO CLIENTE ==================
    public function create()
    {
        $ObrigacoesClienteModel = new ObrigacoesClienteModel();
        $id_cliente = $this->request->getPost('id_cliente');
        $obrigacoes = $this->request->getPost('id_obrigacao');
        if(empty($obrigacoes)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Selecione ao menos uma obrigação.'
            ]);
        }
        $dados = [];
        foreach($obrigacoes as $id_obrigacao) {
            $dados[] = [
                'id_cliente'   => $id_cliente,
                'id_obrigacao' => $id_obrigacao
            ];
        }
        $insert = $ObrigacoesClienteModel->insertBatch($dados);
        return $this->response->setJSON([
            'success' => $insert ? true : false,
            'messages' => $insert
                ? 'Obrigações inseridas com sucesso.'
                : 'Erro ao inserir obrigações.'
        ]);
    }
    //====================INSERE OBRIGAÇÕES NO CLIENTE =============
    public function removerObrigacoesCliente($id_cliente = null)
    {
        $ObrigacoesClienteModel = new ObrigacoesClienteModel();
        $obrigacoesModel = new ObrigacoesModel();

        $subquery = $ObrigacoesClienteModel
            ->select('id_obrigacao')
            ->where('id_cliente', $id_cliente)
            ->findAll();
        $ids = array_column($subquery, 'id_obrigacao');
        $obrigacoesCliente = $obrigacoesModel
            ->select('id, descricao')
            ->orderBy('descricao', 'ASC');

        if(!empty($ids)) {
            $obrigacoesCliente->whereIn('id', $ids);
        }
        $obrigacoesCliente = $obrigacoesCliente->findAll();
        
        $data = [
            'id_cliente' => $id_cliente,
            'active_menu' => 'area_cliente',
            'obrigacoes_cliente' => $obrigacoesCliente,
        ];
        return view('obrigacoes/obrigacoes_cliente/remover_obrigacao_cliente', $data);        
    }
    //======================FEITO =====================================
    public function feito()
    {
        $obrigacoesClienteModel = new ObrigacoesClienteModel();

        $id_obrigacao = $this->request->getPost('id');
        $id_cliente   = $this->request->getPost('cliente');
        
        $update = $obrigacoesClienteModel
            ->where ('id_cliente', $id_cliente)
            ->where('id_obrigacao', $id_obrigacao)
            ->set([
                'feito' => 1,
                'dt_ultimo' => date('Y-m-d'),
                'id_usuario_fechou' => session()->get('id')
            ])
            ->update();

        if ($update) {
            return redirect()->back()->with(
                'success',
                'Registro finalizado com sucesso'
            );
        } else {
            return redirect()->back()->with(
                'error',
                'Um erro ocorreu'
            );
        }
    }
    //======================DESFEITO =====================================
    public function desfeito()
    {
        $obrigacoesClienteModel = new ObrigacoesClienteModel();

        $id_obrigacao = $this->request->getPost('id_obriga');
        $id_cliente   = $this->request->getPost('id_clien');

        $update = $obrigacoesClienteModel
            ->where ('id_cliente', $id_cliente)
            ->where('id_obrigacao', $id_obrigacao)
            ->set([
                'feito' => 0,
                'dt_ultimo' => null,
                'id_usuario_fechou' => null
            ])
            ->update();

        if ($update) {
            return redirect()->back()->with(
                'success',
                'Registro desfeito com sucesso'
            );
        } else {
            return redirect()->back()->with(
                'error',
                'Um erro ocorreu'
            );
        }
    }
    //==========================APAGA OBRIGAÇÕES NO CLIENTE ===========================
    public function delete($id_cliente = null)
    {
        $ObrigacoesClienteModel = new ObrigacoesClienteModel();
        $obrigacoes = $this->request->getPost('cod_obrigacao');
        // VALIDAÇÃO
        if(empty($obrigacoes)) {
            return redirect()->back()
                ->with('error', 'Selecione ao menos uma obrigação.');
        }
        // REMOVE TODOS DE UMA VEZ
        $ObrigacoesClienteModel
            ->whereIn('id_obrigacao', $obrigacoes)
            ->delete();
        return redirect()->to(site_url('clientes/ver/'.$id_cliente))
            ->with('success', 'Obrigações removidas com sucesso.');
    }
}
