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
    public function buscarDadosFuncionario()
    {
        $funcModel = new FuncionariosModel();
        $clienteModel = new ClientesModel();
    	$result = array('data' => array());
		$data = $funcModel->orderBy('ativo', 'ASC')->orderBy('nome', 'DESC')->findAll();

		foreach ($data as $value) {
            $clienteData = $clienteModel->where('id', $value['id_cliente'])->first();
            $buttons = '';
            if(hasPermission('verFuncionario')) {//se tiver permissão para alterar clientes
    			$buttons .= ' <a href="'.base_url('funcionarios/transporte/'.$value['id']).'" class="btn btn-dark" style="font-size:0.55em"><i class="fas fa-bus"></i></a>';
    			$buttons .= ' <a href="'.base_url('funcionarios/alimentacao/'.$value['id']).'" class="btn btn-warning" style="font-size:0.55em"><i class="fas fa-utensils"></i></a>';
            }
    
            if(hasPermission('modificarFuncionario')) {//se tiver permissão para alterar clientes
    			$buttons .= ' <a href="'.base_url('funcionarios/edit/'.$value['id']).'" class="btn btn-primary" style="font-size:0.55em"><i class="fas fa-edit"></i></a>';
            }

            if(hasPermission('apagarFuncionario')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'cliente' => $clienteData['razao'],
				'nome' => $value['nome'],
                'whatsapp' => $value['whatsapp'],
                'ativo' => $value['ativo'] == 1 ? '<span class="badge badge-success">ATIVO</span>' : '<span class="badge badge-danger">INATIVO</span>',
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }
    // ============================== FIM BUSCAR DADOS DE FUNCIONÁRIOS PARA A DATATABLE ==============================
    public function create()
    {
        $clienteModel = new ClientesModel();
        $cliente = $clienteModel->orderBy('razao', 'asc')->findAll();
        return view('funcionarios/create', ['cliente' => $cliente, 'active_menu' => 'funcionarios']);
    }
    // ============================== SALVAR FUNCIONÁRIO ==============================
    public function store()
    {
       $rules = [
            'id_cliente' => 'required',
            'funcionario_nome' => 'required|min_length[3]|is_unique[funcionarios.nome]',
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
                'is_unique' => 'O nome já existe na base de dados'
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
        $data = [
            'id_cliente' => $this->request->getPost('id_cliente'),
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
            return redirect()->to('/funcionarios')->with('success', 'Funcionário criado com sucesso');
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
            'id_cliente' => 'required',
            'funcionario_nome' => 'required|min_length[3]|is_unique[funcionarios.nome, id, '.$id.']',
            'funcionario_cpf' => 'required|exact_length[14]|is_unique[funcionarios.cpf, id, '.$id.']',
            'funcionario_whats' => 'required',
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
                'is_unique' => 'O nome já existe na base de dados'
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
        
        $data = [
            'id_cliente' => $this->request->getPost('id_cliente'),
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
            return redirect()->to('/funcionarios')->with('success', 'Funcionário atualizado com sucesso');
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
}