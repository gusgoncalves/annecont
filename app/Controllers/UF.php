<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EstadosModel;

class UF extends BaseController
{
    public function index()
    {      
        $estadosModel = new EstadosModel();
        $estado = $estadosModel->findAll();        
        return view('uf/index',['active_menu' => 'uf','estados' => $estado]);
    }
    // ============================== BUSCAR DADOS DE ESTADOS PARA A DATATABLE ==============================
    public function buscaDados()
    {
        $estadosModel = new EstadosModel();
    	$result = array('data' => array());
		
        $data = $estadosModel->orderBy('nome', 'asc')->findAll();

		foreach ($data as $value) {
            $buttons = '';
    
            if(hasPermission('modificarUF')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editUF('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarUF')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeUF('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'descricao' =>$value['nome'],
                'sigla' => $value['uf'],
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR UF ==============================
    public function create()
    {
       $rules = [
            
            'nome_uf' => 'required|min_length[3]',
            'sigla_uf' => 'required|min_length[2]|max_length[2]',
        ];
        $messages = [
            'nome_uf' => [
                'required' => 'O campo Nome é obrigatório',
                'min_length' => 'O campo Nome deve ter pelo menos 3 letras'
            ],
             'sigla_uf' => [
                'required' => 'O campo Sigla é obrigatório',
                'min_length' => 'O campo Sigla deve ter no mínimo 2 letras',
                'max_length' => 'O campo Sigla deve ter apenas 2 letras'
            ],
        ];  
        //  echo '<pre>';
        //  print_r($this->request->getPost());
        //  echo '</pre>';
        //  exit;      
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'nome' => $this->request->getPost('nome_uf'),
            'uf' => $this->request->getPost('sigla_uf')
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit; 
        $estadosModel = new EstadosModel();
        $create = $estadosModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'UF criada com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar UF'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO UF POR ID =================
    public function getById($id)
    {
        $estadosModel = new EstadosModel();
        $data = $estadosModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'UF não encontrada'
            ]);
        }
    }
    // ============================== ATUALIZAR UF ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_uf' => 'required|min_length[3]',
            'edit_sigla_uf' => 'required|min_length[2]|max_length[2]'
        ];
        $messages = [
            'edit_uf' => [
                'required' => 'O campo descrição é obrigatório',
                'min_length' => 'Estado deve ter no mínimo 3 letras'
            ],
            'edit_sigla_uf' => [
                'required' => 'O campo sigla é obrigatório',
                'min_length' => 'A sigla deve ter no mínimo 2 letras',
                'max_length' => 'A sigla deve ter apenas 2 letras'
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'nome' => $this->request->getPost('edit_uf'),
            'uf' => $this->request->getPost('edit_sigla_uf')
        ];
        $estadosModel = new EstadosModel();
        $update = $estadosModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'UF atualizada com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar UF'
            ]);
        }
    }
    // ============================== DELETAR UF ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'UF não encontrada na base de dados!!'
            ]);
        }
        $estadosModel = new EstadosModel();
        $delete = $estadosModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do UF excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
