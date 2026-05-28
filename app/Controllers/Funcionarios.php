<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FuncionariosModel;
use App\Models\ClientesModel;

class Funcionarios extends BaseController
{
    public function index()
    {
        return view('funcionarios/index',['active_menu' => 'funcionarios']);
    }
    // ============================== BUSCAR DADOS DE FUNCIONÁRIOS PARA A DATATABLE ==============================
    public function abaFuncionarios($id_cliente = null)
    {
        $funcionariosModel = new FuncionariosModel();
		
        $funcionarios = $funcionariosModel->where('id_cliente', $id_cliente)->orderBy('nome', 'DESC')->findAll();        
        $data = [
            'id_cliente' => $id_cliente,
            'funcionarios' => $funcionarios,
            'active_menu' => 'area_cliente'
        ];
        return view('funcionarios/index', $data);
    }
    // ============================== FIM BUSCAR DADOS DE FUNCIONÁRIOS PARA A DATATABLE ==============================
    public function create($id_cliente = null)
    {
        return view('funcionarios/create', ['id_cliente' => $id_cliente, 'active_menu' => 'funcionarios']);
    }
    // ============================== SALVAR FUNCIONÁRIO ==============================
    public function store()
    {
        $rules = [
            'id_cliente' => 'required',
            'funcionario_nome' => 'required|min_length[3]',
            'funcionario_cpf' => 'required|exact_length[14]|is_unique[funcionarios.cpf]',
            'funcionario_whatsapp' => 'required',
            'funcionario_alimentacao' => 'permit_empty|regex_match[/^\d+([.,]\d{1,2})?$/]',
            'funcionario_diaria' => 'permit_empty|regex_match[/^\d+([.,]\d{1,2})?$/]',
            'funcionario_transporte' => 'permit_empty|regex_match[/^\d+([.,]\d{1,2})?$/]',
        ];
        $messages = [
            'id_cliente' => [
                'required' => 'O campo cliente é obrigatório'
            ],
            'funcionario_nome' => [
                'required' => 'O campo nome é obrigatório',
                'min_length' => 'O campo nome deve conter no mínimo 3 caracteres',
            ],
            'funcionario_cpf' => [
                'required' => 'O campo CPF é obrigatório',
                'exact_length' => 'O campo CPF deve conter 14 caracteres',
                'is_unique' => 'O CPF já existe na base de dados'
            ],
            'funcionario_whatsapp' => [
                'required' => 'O campo WhatsApp é obrigatório',
            ],
            'funcionario_alimentacao' => [
                'regex_match' => 'Informe um valor válido. Ex: 11,50'
            ],
            'funcionario_diaria' => [
                'regex_match' => 'Informe um valor válido. Ex: 11,50'
            ],
            'funcionario_transporte' => [
                'regex_match' => 'Informe um valor válido. Ex: 11,50'
            ],
        ];
        
        if(!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', implode('<br>', $this->validator->getErrors()));
            // echo '<pre>';
            // print_r($this->validator->getErrors());
            // echo '</pre>';
            // exit;
        }
        $id_cliente =$this->request->getPost('id_cliente'); 
        $data = [
            'id_cliente' =>$id_cliente,
            'nome' => $this->request->getPost('funcionario_nome'),
            'cpf' => $this->request->getPost('funcionario_cpf'),
            'whatsapp' => $this->request->getPost('funcionario_whatsapp'),
            'nascimento' => $this->request->getPost('funcionario_nascimento'),
            'alimentacao' => str_replace(',', '.', $this->request->getPost('funcionario_alimentacao')) ?: 0,
            'diaria' => str_replace(',', '.', $this->request->getPost('funcionario_diaria')) ?: 0,
            'transporte' => str_replace(',', '.', $this->request->getPost('funcionario_transporte')) ?: 0,
            'endereco' => $this->request->getPost('funcionario_endereco'),
            'cep' => $this->request->getPost('funcionario_cep'),
            'email' => $this->request->getPost('funcionario_email'),
            'observacoes' => $this->request->getPost('funcionario_observacoes'),
            'dt_cadastro' => $this->request->getPost('funcionario_nascimento') ?: '',
            'ativo' => 1
        ];
        $funcionariosModel = new FuncionariosModel();
        $create = $funcionariosModel->insert($data);
        if ($create) {
            return redirect()->to('/clientes/ver/'.$id_cliente)->with('success', 'Funcionário criado com sucesso');
        } else {
            return redirect()->back()->withInput()->with('errors','Um erro ocorreu!!');
        }
    }
    // ============================== EDITAR FUNCIONÁRIO ==============================
    public function edit($id)
    {
        $funcModel = new FuncionariosModel();
        $funcionarios = $funcModel->find($id);
        return view('funcionarios/edit', ['funcionario' => $funcionarios, 'active_menu' => 'funcionarios']);
    }
    // ============================== ATUALIZAR FUNCIONÁRIO ==============================
    public function update($id)
    {
        $rules = [
            'funcionario_nome' => 'required|min_length[3]',
            'funcionario_cpf' => 'required|exact_length[14]|is_unique[funcionarios.cpf, id, '.$id.']',
            'funcionario_whats' => 'required',
            'funcionario_alimentacao' => 'permit_empty|regex_match[/^\d+([.,]\d{1,2})?$/]',
            'funcionario_diaria' => 'permit_empty|regex_match[/^\d+([.,]\d{1,2})?$/]',
            'funcionario_transporte' => 'permit_empty|regex_match[/^\d+([.,]\d{1,2})?$/]',
        ];
        $messages = [
            'funcionario_nome' => [
                'required' => 'O campo nome é obrigatório',
                'min_length' => 'O campo nome deve conter no mínimo 3 caracteres',
            ],
            'funcionario_cpf' => [
                'required' => 'O campo CPF é obrigatório',
                'exact_length' => 'O campo CPF deve conter 14 caracteres',
                'is_unique' => 'O CPF já existe na base de dados'
            ],
            'funcionario_whats' => [
                'required' => 'O campo WhatsApp é obrigatório',
            ],
            'funcionario_alimentacao' => [
                'regex_match' => 'Informe um valor válido. Ex: 11,50'
            ],
            'funcionario_diaria' => [
                'regex_match' => 'Informe um valor válido. Ex: 11,50'
            ],
            'funcionario_transporte' => [
                'regex_match' => 'Informe um valor válido. Ex: 11,50'
            ],
        ];
    
        if(!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', implode('<br>', $this->validator->getErrors()));
                
        }
        $id_cliente = $this->request->getPost('id_cliente');       
        $data = [
            'nome' => $this->request->getPost('funcionario_nome'),
            'cpf' => $this->request->getPost('funcionario_cpf'),
            'whatsapp' => $this->request->getPost('funcionario_whats'),
            'nascimento' => $this->request->getPost('funcionario_nascimento'),
            'alimentacao' => str_replace(',', '.', $this->request->getPost('funcionario_alimentacao')) ?: 0,
            'diaria' => str_replace(',', '.', $this->request->getPost('funcionario_diaria')) ?: 0,
            'transporte' => str_replace(',', '.', $this->request->getPost('funcionario_transporte')) ?: 0,
            'endereco' => $this->request->getPost('funcionario_endereco'),
            'cep' => $this->request->getPost('funcionario_cep'),
            'email' => $this->request->getPost('funcionario_email'),
            'observacoes' => $this->request->getPost('funcionario_observacoes'),
            'dt_cadastro' => $this->request->getPost('funcionario_nascimento') ?: '',
            'ativo' => $this->request->getPost('funcionario_ativo')
        ];
        $funcionariosModel = new FuncionariosModel();
        $update = $funcionariosModel->update($id, $data);
        if ($update) {
            return redirect()->to('/clientes/ver/'.$id_cliente)->with('success', 'Funcionário atualizado com sucesso');
        } else {
            return redirect()->back()->withInput()->with('errors','Um erro ocorreu!!');
        }
    }
    // ============================== DELETAR FUNCIONÁRIO ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Funcionário não encontrado na base de dados!!'
            ]);
        }
        $FuncionariosModel = new FuncionariosModel();
        $delete = $FuncionariosModel->delete($id);
        if ($delete == true) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do funcionário excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
    //===================FUNÇÃO DE PÁGINA DE TRANSPORTE =======================
    public function transporte($id)
    {
        $funcModel = new FuncionariosModel();
        $clienteModel = new ClientesModel();
        $cliente = $clienteModel->where('id', $funcModel->find($id)['id_cliente'])->first();
        $funcionario = $funcModel->find($id);
        return view('funcionarios/transporte', ['funcionario' => $funcionario, 'cliente' => $cliente, 'active_menu' => 'funcionarios']);
    }
     //===================FUNÇÃO DE PÁGINA DE ALIMENTAÇÃO =======================
    public function alimentacao($id)
    {
        $funcModel = new FuncionariosModel();
        $clienteModel = new ClientesModel();
        $cliente = $clienteModel->where('id', $funcModel->find($id)['id_cliente'])->first();
        $funcionario = $funcModel->find($id);
        return view('funcionarios/alimentacao', ['funcionario' => $funcionario, 'cliente' => $cliente, 'active_menu' => 'funcionarios']);
    }
    public function ajaxList($id_cliente)
    {
        $funcionariosModel = new FuncionariosModel();
        $data['funcionarios'] = $funcionariosModel
            ->where('id_cliente', $id_cliente)
            ->findAll();

        $data['cliente_id'] = $id_cliente;

        return view('funcionarios/ajax/list', $data);
    }
    public function ajaxCreate($id_cliente)
    {
        $data['cliente_id'] = $id_cliente;

        return view('funcionarios/ajax/form', $data);
    }
    public function storeAjax()
{
    $funcionariosModel = new FuncionariosModel();
    $funcionariosModel->save([

        'id_cliente' => $this->request->getPost('id_cliente'),

        'nome' => $this->request->getPost('nome'),

        'whatsapp' => $this->request->getPost('whatsapp')

    ]);

    return $this->response->setJSON([
        'success' => true
    ]);
}
}