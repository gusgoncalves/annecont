<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CertificadosModel;
use App\Models\ClientesModel;

class Certificados extends BaseController
{
    public function index()
    {
        $clienteModel = new ClientesModel();
        $cliente = $clienteModel->findAll();
        return view('certificados/index',['active_menu' => 'certificados','clientes' => $cliente]);
    }
    // ============================== BUSCAR DADOS DE CERTIFICADOS PARA A DATATABLE ==============================
    public function buscarDadosCertificados()
    {
        $certificadosModel = new CertificadosModel();
        $clienteModel = new ClientesModel();
    	$result = array('data' => array());
		
        $data = $certificadosModel->orderBy('descricao', 'asc')->findAll();

		foreach ($data as $value) {
            $clienteData = $clienteModel->where('id', $value['id_cliente'])->first();
            $buttons = '';
    
            if(hasPermission('modificarCertificado')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editCertificado('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarCertificado')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeCertificado('.$value['id'].')" data-toggle="modal" data-target="#removeModalCertificado"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'cliente' => $clienteData['razao'],
				'descricao' => $value['descricao'],
                'dt_validade' => date('d/m/Y', strtotime($value['dt_validade'])),
                'senha' => $value['senha'],
                'ativo' => $value['ativo'] == 1 ? '<span class="badge badge-success">ATIVO</span>' : '<span class="badge badge-danger">INATIVO</span>',
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR FUNCIONÁRIO ==============================
    public function create()
    {
       $rules = [
            'id_cliente' => 'required',
            'certificado_validade' => 'required'
        ];
        $messages = [
            'id_cliente' => [
                'required' => 'O campo cliente é obrigatório'
            ],
            'certificado_validade' => [
                'required' => 'O campo validade é obrigatório',
            ]
        ];  
        //  echo '<pre>';
        //  print_r($this->request->getPost());
        //  echo '</pre>';
        //  exit;      
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
            'descricao' => $this->request->getPost('certificado_descricao'),
            'dt_validade' => $this->request->getPost('certificado_validade'),
            'senha' => $this->request->getPost('certificado_senha'),
            'ativo' => 1//$this->request->getPost('certificado_ativo') ? 1 : 0,
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit; 
        $certificadosModel = new CertificadosModel();
        $create = $certificadosModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Certificado criado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar certificado'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO CERTIFICADO POR ID =================
    public function getById($id)
    {
        $certificadosModel = new CertificadosModel();
        $data = $certificadosModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Certificado não encontrado'
            ]);
        }
    }
    // ============================== ATUALIZAR FUNCIONÁRIO ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_certificado_validade' => 'required'
        ];
        $messages = [
            'edit_certificado_validade' => [
                'required' => 'O campo validade é obrigatório'
            ]
        ];
        if (!$this->validate($rules, $messages)) {

            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'descricao' => $this->request->getPost('edit_certificado_descricao'),
            'dt_validade' => $this->request->getPost('edit_certificado_validade'),
            'senha' => $this->request->getPost('edit_certificado_senha'),
        ];
        $certificadosModel = new CertificadosModel();
        $update = $certificadosModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Certificado atualizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar certificado'
            ]);
        }
    }
    // ============================== DELETAR FUNCIONÁRIO ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Certificado não encontrado na base de dados!!'
            ]);
        }
        $certificadosModel = new CertificadosModel();
        $delete = $certificadosModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do certificado excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
