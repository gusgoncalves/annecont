<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LoginsModel;
use App\Models\ClientesModel;

class Logins extends BaseController
{
    public function index()
    {
        $clienteModel = new ClientesModel();
        $cliente = $clienteModel->findAll();
        
        $loginsModel = new LoginsModel();
        $login = $loginsModel->findAll();        
        return view('logins/index',['active_menu' => 'logins','clientes' => $cliente,'logins' => $login]);
    }
    // ============================== BUSCAR DADOS DE LOGINS PARA A DATATABLE ==============================
    public function abaLogins($id_cliente = null)
    {
        $LoginsModel = new LoginsModel();
        
        $logins = $LoginsModel->where('id_cliente', $id_cliente)->orderBy('descricao', 'DESC')->findAll();        
        $data = [
            'id_cliente' => $id_cliente,
            'logins' => $logins,
            'active_menu' => 'area_cliente'
        ];
        return view('logins/index', $data);
    }

    // ============================== SALVAR ==============================
    public function create()
    {
       $rules = [
            'descricao_login' => 'required',
            'usuario_login' => 'required',
        ];
        $messages = [
            'descricao_login' => [
                'required' => 'O campo descrição é obrigatório'
            ],
            'usuario_login' => [
                'required' => 'O campo usuário é obrigatório'
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
        $id_cliente = $this->request->getPost('id_cliente');
        $data = [
            'id_cliente' => $id_cliente,
            'descricao' => $this->request->getPost('descricao_login'),
            'usuario' => $this->request->getPost('usuario_login'),
            'senha' => $this->request->getPost('senha_login'),
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit; 
        $loginsModel = new LoginsModel();
        $create = $loginsModel->insert($data);
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
        $loginsModel = new LoginsModel();
        $data = $loginsModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Login não encontrado'
            ]);
        }
    }
    // ============================== ATUALIZAR ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_descricao_login' => 'required',
            'edit_usuario_login' => 'required',
        ];
        $messages = [
            'edit_descricao_login' => [
                'required' => 'O campo descrição é obrigatório'
            ],
            'edit_usuario_login' => [
                'required' => 'O campo usuário é obrigatório',
            ]
        ];
        if (!$this->validate($rules, $messages)) {

            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'descricao' => $this->request->getPost('edit_descricao_login'),
            'usuario' => $this->request->getPost('edit_usuario_login'),
            'senha' => $this->request->getPost('edit_senha_login'),
        ];
        $loginsModel = new LoginsModel();
        $update = $loginsModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Login atualizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar login'
            ]);
        }
    }
    // ============================== DELETAR ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Login não encontrado!!'
            ]);
        }
        $loginsModel = new LoginsModel();
        $delete = $loginsModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do login excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
