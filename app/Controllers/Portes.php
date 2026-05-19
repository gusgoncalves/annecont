<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PortesModel;

class Portes extends BaseController
{
   public function index()
    {      
        $portesModel = new PortesModel();
        $porte = $portesModel->findAll();        
        return view('portes/index',['active_menu' => 'portes','portes' => $porte]);
    }
    // ============================== BUSCAR DADOS DE PORTES PARA A DATATABLE ==============================
    public function buscaDadosPorte()
    {
        $portesModel = new PortesModel();
    	$result = array('data' => array());
		
        $data = $portesModel->orderBy('descricao', 'asc')->findAll();

		foreach ($data as $value) {
            $buttons = '';
    
            if(hasPermission('modificarPorte')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editPorte('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarPorte')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removePorte('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'descricao' =>$value['descricao'],            
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR PORTE ==============================
    public function create()
    {
       $rules = [
            
            'descricao' => 'required',
        ];
        $messages = [
            'descricao' => [
                'required' => 'O campo Descrição é obrigatório'
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
        $data = [
            'descricao' => $this->request->getPost('descricao'),
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit; 
        $portesModel = new PortesModel();
        $create = $portesModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Login criado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar login'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO LOGIN POR ID =================
    public function getById($id)
    {
        $portesModel = new PortesModel();
        $data = $portesModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Porte não encontrado'
            ]);
        }
    }
    // ============================== ATUALIZAR PORTE ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_descricao' => 'required',
        ];
        $messages = [
            'edit_descricao' => [
                'required' => 'O campo descrição é obrigatório'
            ]
        ];
        if (!$this->validate($rules, $messages)) {

            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'descricao' => $this->request->getPost('edit_descricao')
        ];
        $portesModel = new PortesModel();
        $update = $portesModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Porte atualizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar porte'
            ]);
        }
    }
    // ============================== DELETAR PORTE ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Porte não encontrada na base de dados!!'
            ]);
        }
        $portesModel = new PortesModel();
        $delete = $portesModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do porte excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
