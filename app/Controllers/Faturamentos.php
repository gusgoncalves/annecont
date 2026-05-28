<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FaturamentoModel;
use App\Models\MesesModel;

class Faturamentos extends BaseController
{
    // ============================== BUSCAR DADOS DE FATURAMENTOS PARA A DATATABLE ==============================
    public function abaFaturamento($id_cliente = null)
    {
        $FaturamentoModel = new FaturamentoModel();
        $MesesModel = new MesesModel();
        
        $faturamento = $FaturamentoModel
            ->select('faturamentos.*, meses.nome')
            ->join('meses', 'faturamentos.id_mes = meses.id ', 'left')
            ->where('faturamentos.id_cliente', $id_cliente)
            ->orderBy('faturamentos.mes', 'ASC')
            ->orderBy('faturamentos.ano', 'ASC')
            ->findAll();
        $meses = $MesesModel->findAll();
        
        $data = [
            'id_cliente' => $id_cliente,
            'faturamento' => $faturamento,
            'meses' => $meses,
            'active_menu' => 'area_cliente'
        ];
        return view('faturamento/index', $data);
    }       
    // ============================== SALVAR FATURAMENTO ==============================
    public function create()
    {
        $mesesModel = new MesesModel();
        $rules = [
            'mes' => 'required',
            'faturamento_ano' => 'required',
            'faturamento_valor' => 'required',
        ];
        $messages = [
            'mes' => [
                'required' => 'O campo mes é obrigatório'
            ],
            'faturamento_ano' => [
                'required' => 'O campo ano é obrigatório'
            ],
            'faturamento_valor' => [
                'required' => 'O campo valor é obrigatório'
            ],
        ];  
        //  echo '<pre>';
        //  print_r($this->request->getPost());
        //  echo '</pre>';
        //  exit;      
        if(!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $mes = $mesesModel->where('id', $this->request->getPost('mes'))->first();
        $id_cliente = $this->request->getPost('id_cliente');
        $data = [
            'id_cliente' => $id_cliente,
            'id_mes' => $this->request->getPost('mes'),
            'mes' => $mes['nome'],
            'ano' => $this->request->getPost('faturamento_ano'),
            'valor' => $this->request->getPost('faturamento_valor'),
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit; 
        $faturamentoModel = new FaturamentoModel();
        $create = $faturamentoModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Faturamento criado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar faturamento'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO FATURAMENTO POR ID =================
    public function getById($id)
    {
        $faturamentoModel = new FaturamentoModel();
        $data = $faturamentoModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Faturamento não encontrado'
            ]);
        }
    }
    // ============================== ATUALIZAR FATURAMENTO ==============================
    public function update($id = null)
    {
        $mesesModel = new MesesModel();
        $rules = [
            'edit_faturamento_mes' => 'required',
            'edit_faturamento_ano' => 'required',
            'edit_faturamento_valor' => 'required',
        ];
        $messages = [
            'edit_faturamento_mes' => [
                'required' => 'O campo mes é obrigatório'
            ],
            'edit_faturamento_ano' => [
                'required' => 'O campo ano é obrigatório'
            ],
            'edit_faturamento_valor' => [
                'required' => 'O campo valor é obrigatório'
            ],
        ];  
        if (!$this->validate($rules, $messages)) {

            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $mes = $mesesModel->where('id', $this->request->getPost('edit_faturamento_mes'))->first();
        $data = [
            'id_mes' => $this->request->getPost('edit_faturamento_mes'),
            'mes' => $mes['nome'],
            'ano' => $this->request->getPost('edit_faturamento_ano'),
            'valor' => $this->request->getPost('edit_faturamento_valor'),
        ];
        $faturamentoModel = new FaturamentoModel();
        $update = $faturamentoModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Faturamento atualizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar faturamento'
            ]);
        }
    }
    // ============================== DELETAR FATURAMENTO ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Faturamento não encontrado na base de dados!!'
            ]);
        }
        $faturamentoModel = new FaturamentoModel();
        $delete = $faturamentoModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do faturamento excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
