<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\GruposModel;

class Grupos extends BaseController
{
    public function index()
    {
        $gruposModel = new GruposModel();
        return view('grupos/index',['active_menu' => 'grupos','grupos'=>$gruposModel->findAll()]);
    }
    
    public function create()
    {        
        $grupoModel = new GruposModel();
        //CARREGA NA VIEW AS TABELAS PARA USAR NA PESQUISA
        return view('grupos/create', ['active_menu' => 'grupos','grupos' => $grupoModel->findAll(),
        ]);
    }

    public function store()
    {
        $rules = [
            'group_name' => 'required|min_length[3]|is_unique[groups.group_name]',
        ];
        $messages = [
            'group_name' => [
                'required' => 'O campo nome do grupo é obrigatório',
                'min_length' => 'O campo nome do grupo deve conter no mínimo 3 caracteres',
                'is_unique' => 'O nome de Grupo já existe na base de dados'
            ]
        ];
        if(!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', implode('<br>', $this->validator->getErrors()));
        }
        $permissions = serialize($this->request->getPost('permission') ?? []);
        $data = [
            'group_name' => $this->request->getPost('group_name'),
            'permission' => $permissions,
        ];
        $gruposModel = new GruposModel();
        $create = $gruposModel->insert($data);
        if ($create) {
            return redirect()->to('/grupos')->with('success', 'Grupo criado com sucesso');
        } else {
            return redirect()->back()->withInput()->with('errors','Um erro ocorreu!!');
        }
    }

    public function edit($id)
    {
        $gruposModel = new GruposModel();
        $grupo = $gruposModel->find($id);
        if (!$grupo) {
            return redirect()->to('/grupos')->with('errors', 'Grupo não encontrado');
        }
        //CARREGA NA VIEW AS TABELAS PARA USAR NA PESQUISA
        return view('grupos/edit', ['active_menu' => 'grupos','grupo' => $grupo]);
    }

    public function update($id)
    {
        $data = array(
            'group_name' => $this->request->getPost('group_name'),
            'permission' => serialize($this->request->getPost('permission') ?? []),
        );
        $gruposModel = new GruposModel();
        $update = $gruposModel->update($id, $data);
        if ($update == true) {
            return redirect()->to('/grupos')->with('success', 'Grupo atualizado com sucesso');
        } else {
            return redirect()->to('/grupos/edit/' . $id)->with('errors', 'Um erro ocorreu!!');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Grupo não encontrado!!'
            ]);
        }
        $gruposModel = new GruposModel();
        $delete = $gruposModel->delete($id);
        if ($delete == true) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
