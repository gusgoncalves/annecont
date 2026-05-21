<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BancosModel;

class Bancos extends BaseController
{
    public function index()
    {
        $bancosModel = new BancosModel();
        $bancos = $bancosModel->findAll();        
        return view('bancos/index',['active_menu' => 'bancos','bancos' => $bancos]);
    }
    // ============================== BUSCAR DADOS DE BANCO PARA A DATATABLE ==============================
    public function buscaDados()
    {
        $bancosModel = new BancosModel();
    	$result = array('data' => array());
        $data = $bancosModel->findAll();
		foreach ($data as $value) {
            $buttons = '';
            if(hasPermission('modificarEmpresa')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editBanco('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('modificarEmpresa')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeBanco('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'nome' => $value['descricao'],
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR BANCO ==============================
    public function create()
    {
       $rules = [
            'descricao' => 'required',
        ];
        $messages = [
            'descricao' => [
                'required' => 'O campo nome da conta é obrigatório'
            ]
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
        $data = [
            'descricao' => $this->request->getPost('descricao')
        ];
        $bancosModel = new BancosModel();
        $create = $bancosModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Banco criado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar Banco'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO BANCO POR ID =================
    public function getById($id)
    {
        $bancosModel = new BancosModel();
        $data = $bancosModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Banco não encontrado'
            ]);
        }
    }
    // ============================== ATUALIZAR TIPO DE CONTA ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_descricao' => 'required',
        ];
        $messages = [
            'edit_nome' => [
                'required' => 'O Nome da Conta é obrigatório'
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'descricao' => $this->request->getPost('edit_descricao'),
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit;
        $bancosModel = new BancosModel();
        $update = $bancosModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Banco atualizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar Banco'
            ]);
        }
    }
    // ============================== DELETAR BANCO ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Banco não encontrado na base de dados!!'
            ]);
        }
        $bancosModel = new BancosModel();
        $delete = $bancosModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do banco removido com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
