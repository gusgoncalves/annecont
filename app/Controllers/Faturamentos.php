<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FaturamentoModel;
use App\Models\ClientesModel;
use App\Models\MesesModel;

class Faturamentos extends BaseController
{
   public function index()
    {
        $clienteModel = new ClientesModel();
        $cliente = $clienteModel->findAll();
        
        $mesesModel = new MesesModel();
        $meses = $mesesModel->findAll();
        
        $faturamentoModel = new FaturamentoModel();
        $faturamento = $faturamentoModel->findAll();        
        return view('faturamento/index',['active_menu' => 'faturamento','clientes' => $cliente,'meses' => $meses,'faturamentos' => $faturamento]);
    }
    // ============================== BUSCAR DADOS DE FATURAMENTOS PARA A DATATABLE ==============================
    public function buscaDadosFaturamento()
    {
        $faturamentoModel = new FaturamentoModel();
        $clienteModel = new ClientesModel();
    	$result = array('data' => array());
		
        $data = $faturamentoModel->findAll();

		foreach ($data as $value) {
            $clienteData = $clienteModel->where('id', $value['id_cliente'])->first();
            $buttons = '';
    
            if(hasPermission('modificarFaturamento')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editFaturamento('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarFaturamento')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeFaturamento('.$value['id'].')" data-toggle="modal" data-target="#removeModalFaturamento"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'cliente' => $clienteData['razao'],
                'mes' =>$value['mes'],
                'ano' => $value['ano'],
                'valor' => number_format($value['valor'], 2, ',', '.'),               
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR FATURAMENTO ==============================
    public function create()
    {
        $mesesModel = new MesesModel();
        $rules = [
            'id_cliente' => 'required',
            'mes' => 'required',
            'faturamento_ano' => 'required',
            'faturamento_valor' => 'required',
        ];
        $messages = [
            'id_cliente' => [
                'required' => 'O campo cliente é obrigatório'
            ],
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
        $data = [
            'id_cliente' => $this->request->getPost('id_cliente'),
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
