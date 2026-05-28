<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CertidoesModel;
use App\Models\TipoCertidaoModel;

class Certidoes extends BaseController
{
   
    // ============================== BUSCAR DADOS DE CERTIDOES PARA A DATATABLE ==============================
    public function abaCertidoes($id_cliente = null)
    {
        $CertidoesModel = new CertidoesModel();
        $TipoCertidao = new TipoCertidaoModel();
        
        $certidoes = $CertidoesModel
            ->select('certidoes.*, tipo_certidao.nome')
            ->join('tipo_certidao', 'tipo_certidao.id = certidoes.id_tipo_certidao ', 'left')
            ->where('id_cliente', $id_cliente)
            ->orderBy('descricao', 'DESC')
            ->findAll();
        $tipos = $TipoCertidao->findAll();
        
        $data = [
            'id_cliente' => $id_cliente,
            'certidoes' => $certidoes,
            'tipos' => $tipos,
            'active_menu' => 'area_cliente'
        ];
        return view('certidoes/index', $data);
    }    
    // ============================== SALVAR FUNCIONÁRIO ==============================
    public function create()
    {
       $rules = [
            'id_tipo_certidao' => 'required',
            'certidao_descricao' => 'required',
            'certidao_expira' => 'required'
        ];
        $messages = [
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

        if(!$this->validate($rules, $messages)) {
           return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $cliente = $this->request->getPost('id_cliente');
        $data = [
            'id_cliente' => $cliente,
            'id_tipo_certidao' => $this->request->getPost('id_tipo_certidao'),
            'descricao' => $this->request->getPost('certidao_descricao'),
            'dt_expira' => $this->request->getPost('certidao_expira'),
        ];
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
                'messages' => 'Certidão não encontrada'
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
