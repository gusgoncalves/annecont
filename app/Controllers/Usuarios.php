<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $usuariosModel = new UsuariosModel();
        return view('usuarios/index',['active_menu' => 'usuarios','user_data'=>$usuariosModel->getUserGrupo()]);
    }
    //
    public function create()
    {        
        $grupoModel = new \App\Models\GruposModel();
        //CARREGA NA VIEW AS TABELAS PARA USAR NA PESQUISA
        return view('usuarios/create', [
            'active_menu' => 'usuarios',
            'grupos' => $grupoModel->findAll(),
        ]);
    }
    // ============================== SALVAR USUÁRIO ==============================
    public function store()
    {
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'fname' => 'required|min_length[3]',
            'groups' => 'required',
            'password' => 'required|min_length[5]',
            'cpassword' => 'required|matches[password]',
            'phone' => 'required',
        ];
        $messages = [
            'username' => [
                'required' => 'O campo usuário é obrigatório',
                'min_length' => 'O campo usuário deve conter no mínimo 3 caracteres',
                'is_unique' => 'O nome de usuário já existe na base de dados'
            ],
            'fname' => [
                'required' => 'O campo nome é obrigatório',
                'min_length' => 'O campo nome deve conter no mínimo 3 caracteres',
            ],
            'groups' => [
                'required' => 'O campo grupo é obrigatório',
            ],
            'password' => [
                'required' => 'O campo senha é obrigatório',
                'min_length' => 'O campo senha deve conter no mínimo 5 caracteres',
            ],
            'cpassword' => [
                'required' => 'O campo confirme a senha é obrigatório',
                'matches' => 'As senhas não conferem'
            ],
            'phone' => [
                'required' => 'O campo telefone é obrigatório',
            ]
        ];
        if(!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', implode('<br>', $this->validator->getErrors()));
        }
        $data = [
            'username' => $this->request->getPost('username'),
            'firstname' => $this->request->getPost('fname'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phone' => $this->request->getPost('phone'),
            'gender' => $this->request->getPost('gender'),
            'group_id' => $this->request->getPost('groups'),
        ];
        $usuariosModel = new UsuariosModel();
        $create = $usuariosModel->createUser($data);
        if ($create) {
            return redirect()->to('/usuarios')->with('success', 'Usuário criado com sucesso');
        } else {
            return redirect()->back()->withInput()->with('errors','Um erro ocorreu!!');
        }
    }
    public function edit($id)
    {
        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->find($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('errors', 'Usuário não encontrado');
        }
        $grupoModel = new \App\Models\GruposModel();

        $db = \Config\Database::connect();
        $user_group = $db->table('user_group')
        ->where('user_id', $id)
        ->get()
        ->getRowArray();

        //CARREGA NA VIEW AS TABELAS PARA USAR NA PESQUISA
        return view('usuarios/edit', [
            'active_menu' => 'usuarios',
            'usuario' => $usuario,
            'grupos' => $grupoModel->findAll(),
            'user_group' => $user_group,
        ]);
    }

    public function update($id)
    {
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username,id,'.$id.']',
            'fname' => 'required|min_length[3]',
            'groups' => 'required',
            'phone' => 'required',
        ];
        $messages = 
        [
            'username' => [
                'required'   => 'O campo usuário é obrigatório',
                'min_length' => 'O campo usuário deve conter no mínimo 3 caracteres',
                'is_unique'  => 'O nome de usuário já existe na base de dados'
            ],
            'fname' => [
                'required'   => 'O campo nome é obrigatório',
                'min_length' => 'O campo nome deve conter no mínimo 3 caracteres',
            ],
            'groups' => [
                'required' => 'O campo grupo é obrigatório',
            ],
            'phone' => [
                'required' => 'O campo telefone é obrigatório',
            ]
        ];
        if (!empty($this->request->getPost('password'))) {
            $rules['password'] = 'min_length[5]';
            $rules['cpassword'] = 'matches[password]';
            $messages['password'] = [
                'min_length' => 'O campo senha deve conter no mínimo 5 caracteres',
            ];
            $messages['cpassword'] = [
                'matches' => 'As senhas não conferem'
            ];
        }
        if (!$this->validate($rules, $messages)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', implode('<br>', $this->validator->getErrors()));
        }
        $data = array(
            'username' => $this->request->getPost('username'),
            'firstname' => $this->request->getPost('fname'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'gender' => $this->request->getPost('gender'),
        );
        if (!empty($this->request->getPost('password'))) {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }
        
        $usuariosModel = new UsuariosModel();
        $update = $usuariosModel->update($id, $data);
        $db = \Config\Database::connect();

        $db->table('user_group')
            ->where('user_id', $id)
            ->update([
            'group_id' => $this->request->getPost('groups')
        ]);
        if ($update) {
            return redirect()->to('/usuarios')->with('success', 'Usuário atualizado com sucesso');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('errors', 'Um erro ocorreu!!');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Usuário não encontrado na base de dados!!'
            ]);
        }
        $usuariosModel = new UsuariosModel();
        $delete = $usuariosModel->delete($id);
        if ($delete == true) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do usuário excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
