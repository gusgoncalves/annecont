<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CertidoesModel;
use App\Models\ClientesModel;
use App\Models\TipoCertidaoModel;

class Certidoes extends BaseController
{
    public function index()
    {
        $clienteModel = new ClientesModel();
        $cliente = $clienteModel->findAll();
        $tipoCertidaoModel = new TipoCertidaoModel();
        $tipo = $tipoCertidaoModel->findAll();        
        return view('certidoes/index',['active_menu' => 'certidoes','clientes' => $cliente,'tipos' => $tipo]);
    }
    // ============================== BUSCAR DADOS DE CERTIDOES PARA A DATATABLE ==============================
    public function buscaDados()
    {
        $certidoesModel = new CertidoesModel();
    	$result = array('data' => array());
		
        $data = $certidoesModel
            ->select('certidoes.*,clientes.razao,tipo_certidao.nome')
            ->join('clientes','clientes.id = certidoes.id_cliente','left')
            ->join('tipo_certidao','tipo_certidao.id = certidoes.id_tipo_certidao','left')
            ->orderBy('descricao', 'asc')->findAll();
		foreach ($data as $value) {
            $buttons = '';
    
            if(hasPermission('modificarCertidao')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editCertidao('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarCertidao')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeCertidao('.$value['id'].')" data-toggle="modal" data-target="#removeModalCertidao"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'cliente' => $value['razao'],
                'tipo' => $value['nome'],
                'dt_expira' => date('d/m/Y', strtotime($value['dt_expira']))?: '',                
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
            'id_tipo_certidao' => 'required',
            'certidao_descricao' => 'required',
            'certidao_expira' => 'required'
        ];
        $messages = [
            'id_cliente' => [
                'required' => 'O campo cliente é obrigatório'
            ],
            'id_tipo_certidao' => [
                'required' => 'O campo tipo de certidão é obrigatório'
            ],
            'certidao_descricao' => [
                'required' => 'O campo descrição é obrigatório'
            ],
            'certidao_expira' => [
                'required' => 'O campo data de expiração é obrigatório',
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
            'id_cliente' => $this->request->getPost('id_cliente'),
            'id_tipo_certidao' => $this->request->getPost('id_tipo_certidao'),
            'descricao' => $this->request->getPost('certidao_descricao'),
            'dt_expira' => $this->request->getPost('certidao_expira'),
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit; 
        $certidoesModel = new CertidoesModel();
        $create = $certidoesModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Certidão criada com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar certidão'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO CERTIFICADO POR ID =================
    public function getById($id)
    {
        $certidoesModel = new CertidoesModel();
        $data = $certidoesModel->find($id);
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
            'edit_tipo_certidao' => 'required',
            'edit_certidao_expira' => 'required',
        ];
        $messages = [
            'edit_tipo_certidao' => [
                'required' => 'O campo tipo de certidão é obrigatório'
            ],
            'edit_certidao_expira' => [
                'required' => 'O campo data de expiração é obrigatório',
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'id_tipo_certidao' => $this->request->getPost('edit_tipo_certidao'),
            'descricao' => $this->request->getPost('edit_certidao_descricao'),
            'dt_expira' => $this->request->getPost('edit_certidao_expira'),
        ];
        $certidoesModel = new CertidoesModel();
        $update = $certidoesModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Certidão atualizada com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar certidão'
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
                'messages' => 'Certidão não encontrada na base de dados!!'
            ]);
        }
        $certidoesModel = new CertidoesModel();
        $delete = $certidoesModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro da certidão excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
