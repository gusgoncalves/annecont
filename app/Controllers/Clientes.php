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
           if(hasPermission('verCliente')) {
               $buttons .= '<a href="' . base_url('clientes/ver/' . $value['id']) . '" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a> ';
           }
           if(hasPermission('modificarCliente')) {
               $buttons .= '<a href="' . base_url('clientes/edit/' . $value['id']) . '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> ';
           }
           if(hasPermission('apagarCliente')) {
               $buttons .= '<button type="button" class="btn btn-sm btn-danger" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
           }
           if ($value['qtd_funcionarios']!=0){ 
                $icone = ' <button type="button" style="font-size:0.55em" class="btn btn-success sm" title="Possui funcionários"><i class="fas fa-user"></i></button>';
            }else {
                $icone = ' <button type="button" style="font-size:0.55em" class="btn btn-secondary" title="Não póssui funcionários"><i class="fas fa-user"></i></button>';
            }
            if ($value['qtd_certificados']!=0) {
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-success" title="Possui certificados"><i class="fas fa-certificate"></i></button>';
            }else {               
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-secondary" title="Não possui certificados"><i class="fas fa-certificate"></i></button>';
            }
            if ($value['qtd_certidoes']!=0) {
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-success" title="Possui certidoes"><i class="fas fa-scroll"></i></button>';
            }else {               
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-secondary" title="Não possui certidoes"><i class="fas fa-scroll"></i></button>';
            }
            if ($value['qtd_obrigacoes']!=0) {
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-success" title="Possui obrigacoes"><i class="fas fa-sitemap"></i></button>';
            }else {               
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-secondary" title="Não possui obrigacoes"><i class="fas fa-sitemap"></i></button>';
            }
            if ($value['qtd_logins']!=0) {
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-success" title="Possui logins"><i class="fas fa-unlock-alt"></i></button>';
            }else {               
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-secondary" title="Não possui logins"><i class="fas fa-unlock-alt"></i></button>';
            }
            if ($value['qtd_faturamentos']!=0) {
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-success" title="Possui faturamentos"><i class="fas fa-hand-holding-usd"></i></button>';
            }else {               
                $icone .= ' <button type="button" style="font-size:0.55em" class="btn btn-secondary" title="Não possui faturamentos"><i class="fas fa-hand-holding-usd"></i></button>';
            }
           $result['data'][] = array(
                'icone'=> $icone,
                'razao' => $value['razao'],
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
            'portes' => $portesModel->selectPortes(),
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
            'portes' => $portesModel->selectPortes(),
            'estados' => $estadosModel->selectEstados(),
            'cidades' => $cidadesModel->getCidadesPorEstado($cliente['id_uf']),
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

        $model = new \App\Models\CidadesModel();
        $cidades = $model->getCidadesPorEstado($idUf);

        return $this->response->setJSON($cidades);
    }
    // ==================================================================
    // FUNÇÃO PARA EXIBIR OS DETALHES DO CLIENTE
    // ==================================================================
    public function ver($id)
    {
        $clientesModel = new ClientesModel();
        $cidadeModel = new \App\Models\CidadesModel();
        $obrigacoesModel = new \App\Models\ObrigacoesModel();
        $funcionariosModel = new \App\Models\FuncionariosModel();
        $sociosModel = new \App\Models\SociosModel();
        $certificadosModel = new \App\Models\CertificadosModel();
        $certidoesModel = new \App\Models\CertidoesModel();
        $faturamentoModel = new \App\Models\FaturamentoModel();
        $loginsModel = new \App\Models\LoginsModel();
        $mesesModel = new \App\Models\MesesModel();
        $tipoCertidao = new \App\Models\TipoCertidaoModel();

        $cliente = $clientesModel->find($id);
        $cidade = $cidadeModel->find($cliente['id_cidade']);
        $obrigacoes_data = $obrigacoesModel->getObrigacoesPorCliente($id);
        $obrigacoes_feito = $obrigacoesModel->obrigacoesFeita($id);
        $funcionarios = $funcionariosModel->getFuncionariosPorCliente($id);
        $socios = $sociosModel->where('id_cliente',$id);
        $certificados = $certificadosModel->where('id_cliente',$id);
        $certidoes = $certidoesModel->where('id_cliente',$id);
        $faturamentos = $faturamentoModel->where('id_cliente',$id);
        $total_faturamento = $faturamentoModel->selectSum('valor')->where('id_cliente',$id)->findAll();
        $logins = $loginsModel->where('id_cliente',$id);
        $tipo = $tipoCertidao->findAll();
        $meses = $mesesModel->orderBy('nome','asc')->findAll();
        if (!$cliente) {
            return redirect()->to('/clientes')->with('errors', 'Cliente não encontrado');
        }
        return view('clientes/ver', [
            'active_menu' => 'area_cliente',
            'cliente' => $cliente,
            'cidade' => $cidade,
            'obrigacoes_data' => $obrigacoes_data,
            'obrigacoes_feito' => $obrigacoes_feito,
            'funcionario_data' => $funcionarios,
            'socio_data' => $socios,
            'certificado_data' => $certificados,
            'certidao_data' => $certidoes,
            'faturamento_data' => $faturamentos,
            'total_faturamento' => $total_faturamento,
            'login_data' => $logins,
            'combo_meses' => $meses,
            'tipo_certidao' => $tipo,
        ]);
    }                                                                                                                           
}
