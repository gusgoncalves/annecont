<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TipoCertidaoModel;

class TiposCertidao extends BaseController
{
    public function index()
    {
        $tipoCertidaoModel = new TipoCertidaoModel();
        $tipo = $tipoCertidaoModel->findAll();        
        return view('tipo_certidao/index',['active_menu' => 'tipos_certidao','tipos' => $tipo]);
    }
    // ============================== BUSCAR DADOS DE CERTIFICADOS PARA A DATATABLE ==============================
    public function buscarDadosTipoCertidao()
    {
        $tipoCertidaoModel = new TipoCertidaoModel();
    	$result = array('data' => array());
        $data = $tipoCertidaoModel->findAll();
		foreach ($data as $value) {
            $buttons = '';
            if(hasPermission('modificarTipoCertidao')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editTipoCertidao('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarTipoCertidao')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeTipoCertidao('.$value['id'].')" data-toggle="modal" data-target="#removeModalTipoCertidao"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'nome' => $value['nome'],
                'descricao' => $value['descricao'],
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR FUNCIONÁRIO ==============================
    public function create()
    {
       $rules = [
            'tipo_certidao_nome' => 'required'
        ];
        $messages = [
            'tipo_certidao_nome' => [
                'required' => 'O campo nome é obrigatório'
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
            'nome' => $this->request->getPost('tipo_certidao_nome'),
            'descricao' => $this->request->getPost('tipo_certidao_descricao')
        ];
        $TipoCertidaoModel = new TipoCertidaoModel();
        $create = $TipoCertidaoModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Tipo de certificado criado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar tipo de certificado'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO CERTIFICADO POR ID =================
    public function getById($id)
    {
        $TipoCertidaoModel = new TipoCertidaoModel();
        $data = $TipoCertidaoModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Tipo de certidão não encontrado'
            ]);
        }
    }
    // ============================== ATUALIZAR FUNCIONÁRIO ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_tipo_certidao_nome' => 'required'
        ];
        $messages = [
            'edit_tipo_certidao_nome' => [
                'required' => 'O campo nome é obrigatório'
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'nome' => $this->request->getPost('edit_tipo_certidao_nome'),
            'descricao' => $this->request->getPost('edit_tipo_certidao_descricao'),
        ];
        $TipoCertidaoModel = new TipoCertidaoModel();
        $update = $TipoCertidaoModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Tipo de certidão atualizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar tipo de certidão'
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
                'messages' => 'Tipo de certidão não encontrado na base de dados!!'
            ]);
        }
        $TipoCertidaoModel = new TipoCertidaoModel();
        $delete = $TipoCertidaoModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro do tipo de certidão excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
