<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObrigacoesClienteModel;
use App\Models\ObrigacoesRealizadasModel;
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
        $ObrigacoesRealizadas = new ObrigacoesRealizadasModel();

        $obrigacaoFeito = $ObrigacoesClienteModel
            ->selectSum('feito','realizado')
            ->where('id_cliente',$id_cliente)
            ->where('feito !=', 2)
            ->findAll();

        $obrigacoescli = $ObrigacoesClienteModel
            ->select('obrigacoes_cliente.*,obrigacoes.descricao')
            ->join('obrigacoes','obrigacoes_cliente.id_obrigacao = obrigacoes.id')
            ->where('id_cliente', $id_cliente)
            ->orderBy('obrigacoes.descricao','ASC')
            ->findAll();
        $data = [
            'id_cliente' => $id_cliente,
            'obrigacoescli' => $obrigacoescli,
            'active_menu' => 'area_cliente',
            'obrigacoes_feito' => $obrigacaoFeito
        ];
        return view('obrigacoes/obrigacoes_cliente/index', $data);
    }
    //================INSERIR OBRIGAÇÕES NO CLIENTE ========================
    public function inserirObrigacaoCliente($id_cliente =  null)
    {
        $ObrigacoesModel = new ObrigacoesModel();
        $obrigacao = $ObrigacoesModel->findAll();

        $data = [
            'id_cliente' => $id_cliente,
            'obrigacao' => $obrigacao,
            'active_menu' => 'area_cliente'
        ];
        //return view('obrigacoes/obrigacoes_cliente/inserir_obrigacao_cliente',$data);

	}

    public function create($id)
    {
        $ObrigacoesClienteModel = new ObrigacoesClienteModel();

        $obrigacoes = json_encode($this->request->getPost('id_obrigacao'));
        $obrigacao = json_decode($obrigacoes);
        $total  = count($obrigacao);
        for ($i = 0; $i<$total;$i++){
            $data = array(
                'id_cliente' => $id,
                'id_obrigacao' => $obrigacao[$i],
            );
            echo "estarei inserindo o valor " .$i;
            //$insert = $ObrigacoesClienteModel->insert($data);
        }
        exit;
        if($insert = true ) {
            $this->session->set_flashdata('success', 'Obrigação inserida no cliente');
            redirect('clientes/ver/'.$id, 'refresh');
        }
        else {
            $this->session->set_flashdata('errors', 'Um erro ocorreu!!');
            redirect('obrigacoes/inserir_obrigacao_cliente', 'refresh');
        }	
	}
}
