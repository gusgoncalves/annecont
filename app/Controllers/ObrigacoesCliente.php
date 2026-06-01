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
            ->select('obrigacoes_cliente.*,obrigacoes.descricao')
            ->join('obrigacoes','obrigacoes_cliente.id_obrigacao = obrigacoes.id')
            ->where('id_cliente', $id_cliente)
            ->orderBy('obrigacoes.descricao','ASC')
            ->findAll();
        $pendentes = 0;
        foreach($obrigacoescli as $o) {
            if($o['feito'] == 0) {
                $pendentes ++;
            }
        }
        $data = [
            'id_cliente' => $id_cliente,
            'obrigacoescli' => $obrigacoescli,
            'active_menu' => 'area_cliente',
            'combo_obrigacoes' => $combo_obrigacoes,
            'obrigacoes' => $obrigacoes,
            'pendentes' => ($pendentes == 1),
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
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do finalizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }

        // Verifica se ainda existem tarefas pendentes do cliente
        $pendentes = $obrigacoesClienteModel
            ->where('id_cliente', $id_cliente)
            ->where('feito', 0)
            ->countAllResults();

        return $this->response->setJSON([
            'success'          => true,
            'messages'         => 'Tarefa concluída com sucesso.',
        ]);
        return redirect()->back();
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
