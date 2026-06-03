<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CertificadosModel;

class Certificados extends BaseController
{
    public function index()
    {
        $CertificadoModel = new CertificadosModel();
        $certificados = $CertificadoModel->findAll();
        return view('certificados/index',['active_menu' => 'certificados','certificados' => $certificados]);
    }
    // ============================== BUSCAR DADOS PARA A DATATABLE ==============================
    public function abaCertificados($id_cliente = null)
    {
        $CertificadoModel = new CertificadosModel();
        
        $certificados = $CertificadoModel->where('id_cliente', $id_cliente)->orderBy('descricao', 'DESC')->findAll();        
        $data = [
            'id_cliente' => $id_cliente,
            'certificados' => $certificados,
            'active_menu' => 'area_cliente'
        ];
        return view('certificados/index', $data);
    }
    // ============================== SALVAR  ==============================
    public function create()
    {
       $rules = [
            'certificado_validade' => 'required'
        ];
        $messages = [
            'certificado_validade' => [
                'required' => 'O campo validade é obrigatório',
            ]
        ];  
        if(!$this->validate($rules, $messages)) {
           return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $cliente = $this->request->getPost('id_cliente');
        $data = [
            'id_cliente' => $cliente,
            'descricao' => $this->request->getPost('certificado_descricao'),
            'dt_validade' => $this->request->getPost('certificado_validade'),
            'senha' => $this->request->getPost('certificado_senha'),
            'ativo' => 1//$this->request->getPost('certificado_ativo') ? 1 : 0,
        ];
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
    //========================FUNÇÃO PARA PEGAR OS DADOS POR ID =================
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
    // ============================== ATUALIZAR ==============================
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
    // ============================== DELETAR  ==============================
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
