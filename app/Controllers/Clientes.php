<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClientesModel;

class Clientes extends BaseController
{
    public function index()
    {
        return view('clientes/index', ['active_menu' => 'area_cliente']);
    }
    // ==================================================================
    // FUNÇÃO PARA BUSCAR OS DADOS DO CLIENTE PARA EXIBIR NA TABELA
    // ==================================================================
    public function buscaDados()
    {
        $result = array('data' => array());
        $clientesModel = new ClientesModel();
        $dados = $clientesModel->recebeDadosClienteComContadores();
        foreach($dados as $value) {
           $buttons = '';
           $icone = '';
           if(hasPermission('verCliente')) {
               $buttons .= '<a href="' . base_url('clientes/ver/' . $value['id']) . '" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a> ';
           }
           if(hasPermission('modificarCliente')) {
               $buttons .= '<a href="' . base_url('clientes/edit/' . $value['id']) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a> ';
           }
           if(hasPermission('apagarCliente')) {
               $buttons .= '<button type="button" class="btn btn-sm btn-danger" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
           }
           if ($value['qtd_funcionarios']>0){ 
                $icone = ' <span class="badge badge-light border border-success text-success" title="Funcionários"><i class="fas fa-user"></i> '.$value['qtd_funcionarios'].'</span>';
            }
            if ($value['qtd_certificados']>0) {
                $icone .= ' <span class="badge badge-light border border-success text-success" title="Certificados"><i class="fas fa-certificate"></i> '.$value['qtd_certificados'].'</span>';
            }
            if ($value['qtd_certidoes']>0) {
                $icone .= ' <span class="badge badge-light border border-success text-success" title="Certidões"><i class="fas fa-scroll"></i> '.$value['qtd_certidoes'].'</span>';
            }
            if ($value['qtd_obrigacoes']>0) {
                $icone .= ' <span class="badge badge-light border border-success text-success" title="Obrigações"><i class="fas fa-sitemap"></i> '.$value['qtd_obrigacoes'].'</span>';
            }
            if ($value['qtd_logins']>0) {
                $icone .= ' <span class="badge badge-light border border-success text-success" title="Logins"><i class="fas fa-unlock-alt"></i> '.$value['qtd_logins'].'</span>';
            }
            if ($value['qtd_faturamentos']>0) {
                $icone .= ' <span class="badge badge-light border border-success text-success" title="Faturamentos"><i class="fas fa-hand-holding-usd"></i> '.$value['qtd_faturamentos'].'</span>';
            }
           $result['data'][] = array(
                'razao' => $value['razao'] . $icone,
                'cnpj' => $value['cnpj'],
                'whatsapp' => $value['whatsapp'],
                'ativo' => $value['ativo'],
                'acoes' => $buttons
           );
        }
        return $this->response->setJSON($result);
    }
    // ==================================================================
    // FUNÇÃO PARA EXIBIR O FORMULÁRIO DE CADASTRO DE CLIENTE
    // ==================================================================
    public function create()
    {        
        $portesModel = new \App\Models\PortesModel();
        $estadosModel = new \App\Models\EstadosModel();
        //CARREGA NA VIEW AS TABELAS PARA USAR NA PESQUISA
        return view('clientes/create', [
            'active_menu' => 'area_cliente',
            'portes' => $portesModel->findAll(),
            'estados' => $estadosModel->selectEstados(),
        ]);
    }
    // ==================================================================
    // FUNÇÃO PARA RECEBER OS DADOS DO FORMULÁRIO DE CADASTRO DE CLIENTE
    // ==================================================================
    public function store()
    {
        $data = array(
            'fantasia' => $this->request->getPost('cliente_fantasia'),
            'razao' => $this->request->getPost('cliente_razao'),
            'cnpj' => $this->request->getPost('cliente_cnpj'),
            'whatsapp' => $this->request->getPost('cliente_whats'),
            'dt_abertura' => $this->request->getPost('cliente_dt_abertura') ?? date('Y-m-d'),
            'endereco' => $this->request->getPost('cliente_endereco'),
            'cep' => $this->request->getPost('cliente_cep'),
            'id_cidade' => $this->request->getPost('cliente_cidade'),
            'id_uf' => $this->request->getPost('cliente_uf'),
            'email' => $this->request->getPost('cliente_email'),
            'valor' => $this->request->getPost('cliente_valor'),
            'dia_vencimento' => $this->request->getPost('cliente_vencimento'),
            'observacoes' => $this->request->getPost('cliente_descricao'),
            'dt_cadastro' => date('Y-m-d H:i:s'),
            'ativo' => 1,
            'id_porte' => $this->request->getPost('cliente_porte'),
        );
        $ClientesModel = new ClientesModel();
        $create = $ClientesModel->insert($data);
        if ($create == true) {
            return redirect()->to('/clientes')->with('success', 'Cliente criado com sucesso');
        } else {
            return redirect()->back()
                    ->withInput()
                    ->with('errors', 'Um erro ocorreu!!');
        }
    }
    // ==================================================================
    // FUNÇÃO PARA EXIBIR O FORMULÁRIO DE EDIÇÃO DE CLIENTE
    // ==================================================================
    public function edit($id)
    {
        $clientesModel = new ClientesModel();
        $cliente = $clientesModel->find($id);
        if (!$cliente) {
            return redirect()->to('/clientes')->with('errors', 'Cliente não encontrado');
        }
        $portesModel = new \App\Models\PortesModel();
        $cidadesModel = new \App\Models\CidadesModel();
        $estadosModel = new \App\Models\EstadosModel();
        //CARREGA NA VIEW AS TABELAS PARA USAR NA PESQUISA
        return view('clientes/edit', [
            'active_menu' => 'area_cliente',
            'cliente' => $cliente,
            'portes' => $portesModel->findAll(),
            'estados' => $estadosModel->selectEstados(),
            'cidades' => $cidadesModel->where('id', $cliente['id_cidade'])->findAll(),
        ]);
    }
    // ==================================================================
    // FUNÇÃO PARA RECEBER OS DADOS DO FORMULÁRIO DE EDIÇÃO DE CLIENTE
    // ==================================================================
    public function update($id)
    {
        $data = array(
            'fantasia' => $this->request->getPost('cliente_fantasia'),
            'razao' => $this->request->getPost('cliente_razao'),
            'cnpj' => $this->request->getPost('cliente_cnpj'),
            'whatsapp' => $this->request->getPost('cliente_whats'),
            'dt_abertura' => $this->request->getPost('cliente_abertura') ?? date('Y-m-d'),
            'endereco' => $this->request->getPost('cliente_endereco'),
            'cep' => $this->request->getPost('cliente_cep'),
            'id_cidade' => $this->request->getPost('cliente_cidade'),
            'id_uf' => $this->request->getPost('cliente_uf'),
            'email' => $this->request->getPost('cliente_email'),
            'valor' => $this->request->getPost('cliente_valor'),
            'dia_vencimento' => $this->request->getPost('cliente_vencimento'),
            'observacoes' => $this->request->getPost('cliente_descricao'),
            'id_porte' => $this->request->getPost('cliente_porte'),
            'ativo' => $this->request->getPost('ativo'),
        );
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>'; 
        // exit;
        $clientesModel = new ClientesModel();
        $update = $clientesModel->update($id, $data);
        if ($update == true) {
            return redirect()->to('/clientes')->with('success', 'Cliente atualizado com sucesso');
        } else {
            return redirect()->to('/clientes/edit/' . $id)->with('errors', 'Um erro ocorreu!!');
        }
    }
    // ==================================================================
    // FUNÇÃO PARA EXCLUIR O CLIENTE
    // ==================================================================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Cliente não encontrado na base de dados!!'
            ]);
        }
        $clientesModel = new ClientesModel();
        $delete = $clientesModel->delete($id);
        if ($delete == true) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do cliente excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
    // ==================================================================
    // FUNÇÃO PARA BUSCAR AS CIDADES DE ACORDO COM O ESTADO SELECIONADO
    // ==================================================================
    public function getCidades()
    {
        $idUf = $this->request->getPost('id_estado');
        $cidadesModel = new \App\Models\CidadesModel();
        $cidades = $cidadesModel->where('id_uf', $idUf)->findAll();
        return $this->response->setJSON($cidades);
    }
    // ==================================================================
    // FUNÇÃO PARA EXIBIR OS DETALHES DO CLIENTE
    // ==================================================================
    public function ver($id = null)
    {
        $clientesModel = new ClientesModel();
        $cidadeModel = new \App\Models\CidadesModel();
        
        $cliente = $clientesModel->find($id);
        $cidade = $cidadeModel->find($cliente['id_cidade']);

        if (!$cliente) {
            return redirect()->to('/clientes')->with('errors', 'Cliente não encontrado');
        }
        return view('clientes/ver', [
            'active_menu' => 'area_cliente',
            'cliente' => $cliente,
            'cidade' => $cidade
        ]);
    } 
    //===========ABA DADOS DOS CLIENTES ==========================
    public function abaClientes($id_cliente = null)
    {   
        $portesModel = new \App\Models\PortesModel();
        $cidadesModel = new \App\Models\CidadesModel();
        $clientesModel = new ClientesModel();
        $cliente = $clientesModel->find($id_cliente);
        $cidades = $cidadesModel->where('id', $cliente['id_cidade'])->findAll();

        $data = [
            'active_menu' => 'area_cliente',
            'portes' => $portesModel->findAll(),
            'cidades' => $cidades,
            'cliente' => $cliente
        ];
        return view('clientes/dados', $data);
    }                                                                                 
}
