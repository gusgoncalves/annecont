<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SociosModel;
use App\Models\ClientesModel;

class Socios extends BaseController
{
   public function index()
    {
        //return view('socios/index',['active_menu' => 'cliente_menu']);
    }
    // ============================== BUSCAR DADOS DE SÓCIOS PARA A DATATABLE ==============================
    // public function buscaDados()
    // {
    //     $socioModel = new SociosModel();
    //     $clienteModel = new ClientesModel();
    // 	$result = array('data' => array());
		
    //     $data = $socioModel->orderBy('nome', 'asc')->findAll();

	// 	foreach ($data as $value) {
    //         $clienteData = $clienteModel->where('id', $value['id_cliente'])->first();
    //         $buttons = '';
    
    //         if(hasPermission('modificarCliente')) {//se tiver permissão para alterar clientes
    // 			$buttons .= ' <a href="'.base_url('socios/edit/'.$value['id']).'" class="btn btn-primary" style="font-size:0.55em"><i class="fas fa-edit"></i></a>';
    //         }
    //         if(hasPermission('apagarCliente')) { 
    // 			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
    //         }
	// 		$result['data'][] = array(
    //             'cliente' => $clienteData['razao'],
	// 			'nome' => $value['nome'],
    //             'whatsapp' => $value['whatsapp'],
	// 			'acoes' => $buttons
	// 		);
	// 	} // /foreach
	// 	echo json_encode($result);
    // }
    // ============================== FIM BUSCAR DADOS DE SÓCIOS PARA A DATATABLE ==============================
    public function create($id_cliente = null)
    {
        $clienteModel = new ClientesModel();
        $cliente = $clienteModel->find($id_cliente);
        return view('socios/create', ['active_menu' => 'area_cliente','cliente'=> $cliente]);
    }
    // ============================== SALVAR FUNCIONÁRIO ==============================
    public function store()
    {
       $rules = [
            'socio_nome' => 'required|min_length[3]',
            'socio_cpf' => 'required|exact_length[14]',
            'socio_whats' => 'required',
        ];
        $messages = [
            'socio_nome' => [
                'required' => 'O campo nome é obrigatório',
                'min_length' => 'O campo nome deve conter no mínimo 3 caracteres',
            ],
            'socio_cpf' => [
                'required' => 'O campo CPF é obrigatório',
                'exact_length' => 'O campo CPF deve conter 14 caracteres',
            ],
            'socio_whats' => [
                'required' => 'O campo WhatsApp é obrigatório',
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
        $id_cliente = $this->request->getPost('id_cliente');
        $data = [
            'id_cliente' => $id_cliente,
            'nome' => $this->request->getPost('socio_nome'),
            'cpf' => $this->request->getPost('socio_cpf'),
            'rg' => $this->request->getPost('socio_rg'),
            'titulo' => $this->request->getPost('socio_titulo'),
            'nascimento' => $this->request->getPost('socio_nascimento'),
            'nome_mae' => $this->request->getPost('socio_mae'),
            'endereco' => $this->request->getPost('socio_endereco'),
            'whatsapp' => $this->request->getPost('socio_whats'),
            'email' => $this->request->getPost('socio_email') ?: '',
            'recibo' => $this->request->getPost('socio_recibo') ?: '',
            'observacoes' => $this->request->getPost('socio_observacoes') ?: '',
            'dt_cadasto' => date('Y-m-d H:i:s'),
            'declara_ir' => $this->request->getPost('declara_ir'),
        ];
        $SociosModel = new SociosModel();
        $create = $SociosModel->insert($data);
        if ($create) {
            return redirect()->to('/clientes/ver/'.$id_cliente)->with('success', 'Sócio criado com sucesso');
        } else {
            return redirect()->back()->withInput()->with('errors','Um erro ocorreu!!');
        }
    }
    // ============================== EDITAR FUNCIONÁRIO ==============================
    public function edit($id_socio = null)
    {
        $SociosModel = new SociosModel();
        $socios = $SociosModel->find($id_socio);
        $id_cliente = $socios['id_cliente'];
        return view('socios/edit', ['socios' => $socios, 'active_menu' => 'area_cliente', 'id_cliente' => $id_cliente]);
    }
    // ============================== ATUALIZAR FUNCIONÁRIO ==============================
    public function update($id = null)
    {
        $rules = [
            'socio_nome' => 'required|min_length[3]',
            'socio_cpf' => 'required|exact_length[14]',
            'socio_whats' => 'required',
        ];
        $messages = [
            'socio_nome' => [
                'required' => 'O campo nome é obrigatório',
                'min_length' => 'O campo nome deve conter no mínimo 3 caracteres',
            ],
            'socio_cpf' => [
                'required' => 'O campo CPF é obrigatório',
                'exact_length' => 'O campo CPF deve conter 14 caracteres',
            ],
            'socio_whats' => [
                'required' => 'O campo WhatsApp é obrigatório',
            ],
        ];
        
        if(!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', implode('<br>', $this->validator->getErrors()));
        }
        $id_cliente = $this->request->getPost('id_cliente');
        $data = [
            'nome' => $this->request->getPost('socio_nome'),
            'cpf' => $this->request->getPost('socio_cpf'),
            'rg' => $this->request->getPost('socio_rg'),
            'titulo' => $this->request->getPost('socio_titulo'),
            'nascimento' => $this->request->getPost('socio_nascimento'),
            'nome_mae' => $this->request->getPost('socio_mae'),
            'endereco' => $this->request->getPost('socio_endereco'),
            'whatsapp' => $this->request->getPost('socio_whats'),
            'email' => $this->request->getPost('socio_email') ?: '',
            'recibo' => $this->request->getPost('socio_recibo') ?: '',
            'observacoes' => $this->request->getPost('socio_observacoes') ?: '',
            'declara_ir' => $this->request->getPost('declara_ir'),
        ];
        $sociosModel = new SociosModel();
        $update = $sociosModel->update($id, $data);
        if ($update) {
            return redirect()->to('/clientes/ver/'.$id_cliente)->with('success', 'Sócio atualizado com sucesso');
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
                'messages' => 'Sócio não encontrado na base de dados!!'
            ]);
        }
        $SociosModel = new SociosModel();
        $cliente = $SociosModel->find($id);
        $delete = $SociosModel->delete($id);
       
        if ($delete){
        return redirect()
            ->to(site_url('clientes/ver/' . $cliente['id_cliente']))
            ->with('success', 'Registro do sócio excluído com sucesso');
        }
        return redirect()->back()
            ->with('error', 'Um erro ocorreu.');
    }
    //==================ABA DOS SOCIOS =======================
    public function abaSocios($id_cliente = null)
    {   $sociosModel = new SociosModel();
        $socios = $sociosModel->where('id_cliente', $id_cliente)->findAll();
        return view('socios/dados',['id_cliente'=> $id_cliente, 'socio'=>$socios,'active_menu' => 'area_cliente']);
    }            
}
