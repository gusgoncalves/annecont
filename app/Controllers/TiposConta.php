<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TiposContaModel;

class TiposConta extends BaseController
{
    public function index()
    {
        $tiposContaModel = new TiposContaModel();
        $tipo = $tiposContaModel->findAll();        
        return view('tipo_conta/index',['active_menu' => 'tipo_conta','tipos' => $tipo]);
    }
    // ============================== BUSCAR DADOS DE TIPO DE CONTA PARA A DATATABLE ==============================
    public function buscaDados()
    {
        $tiposContaModel = new TiposContaModel();
    	$result = array('data' => array());
        $data = $tiposContaModel->findAll();
		foreach ($data as $value) {
            $buttons = '';
            if(hasPermission('modificarTipoConta')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editTipo('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarTipoConta')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeTipo('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'nome' => $value['nome'],
                'tipo' => $value['tipo']==0 ? '<span class="badge badge-danger">Pagar</span>':'<span class="badge badge-success">Receber</span>',
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR TIPO DE CONTA ==============================
    public function create()
    {
       $rules = [
            'nome' => 'required',
            'tipo' => 'required'
        ];
        $messages = [
            'nome' => [
                'required' => 'O campo nome da conta é obrigatório'
            ],
            'tipo' => [
                'required' => 'O campo categoria deve ser escolhido'
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
            'nome' => $this->request->getPost('nome'),
            'tipo' => $this->request->getPost('tipo')
        ];
        $tiposContaModel = new TiposContaModel();
        $create = $tiposContaModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Tipo de conta criado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar tipo de conta'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO TIPO DE CONTA POR ID =================
    public function getById($id)
    {
        $tiposContaModel = new TiposContaModel();
        $data = $tiposContaModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Tipo de conta não encontrado'
            ]);
        }
    }
    // ============================== ATUALIZAR TIPO DE CONTA ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_nome' => 'required',
            'edit_tipo' => 'required',
        ];
        $messages = [
            'edit_nome' => [
                'required' => 'O Nome da Conta é obrigatório'
            ],
            'edit_tipo' => [
                'required' => 'A Categoria da Conta é obrigatório'
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'nome' => $this->request->getPost('edit_nome'),
            'tipo' => $this->request->getPost('edit_tipo'),
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit;
        $tiposContaModel = new TiposContaModel();
        $update = $tiposContaModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Tipo de conta atualizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar tipo de conta'
            ]);
        }
    }
    // ============================== DELETAR TIPO DE CONTA ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Tipo de certidão não encontrado na base de dados!!'
            ]);
        }
        $tiposContaModel = new TiposContaModel();
        $delete = $tiposContaModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do tipo de conta removido com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
