<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CidadesModel;
use App\Models\EstadosModel;

class Cidades extends BaseController
{
   public function index()
    {   
        $estadosModel = new EstadosModel();
        $estados = $estadosModel->findAll();
        $cidadesModel = new CidadesModel();
        $cidades = $cidadesModel->findAll();        
        return view('cidades/index',['active_menu' => 'cidades','cidades' =>$cidades, 'estados' => $estados]);
    }
    // ============================== BUSCAR DADOS PARA A DATATABLE ==============================
    public function buscaDados()
    {
        $cidadesModel = new CidadesModel();
    	$result = array('data' => array());
		
        $data = $cidadesModel->select('cidades.*,uf.uf')
            ->join('uf','uf.id = cidades.id_uf','left')
            ->orderBy('nome_cidade', 'asc')
            ->findAll();
		foreach ($data as $value) {
            $buttons = '';
    
            if(hasPermission('modificarCidade')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editCidade('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarCidade')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeCidade('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'nome_cidade' =>$value['nome_cidade'],
                'UF' => $value['uf'],
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR CIDADE ==============================
    public function create()
    {
       $rules = [
            
            'nome_cidade' => 'required',
            'sigla_uf' => 'required',
        ];
        $messages = [
            'nome_cidade' => [
                'required' => 'O campo Nome é obrigatório'
            ],
             'sigla_uf' => [
                'required' => 'O campo UF é obrigatório',
            ],
        ];  
        //  echo '<pre>';
        //  print_r($this->request->getPost());
        //  echo '</pre>';
        //  exit;      
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'nome_cidade' => $this->request->getPost('nome_cidade'),
            'id_uf' => $this->request->getPost('sigla_uf')
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit; 
        $cidadesModel = new CidadesModel();
        $create = $cidadesModel->insert($data);
        if ($create) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Cidade criada com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar Cidade'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS POR ID =================
    public function getById($id)
    {
        $cidadesModel = new CidadesModel();
        $data = $cidadesModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Cidade não encontrada'
            ]);
        }
    }
    // ============================== ATUALIZAR ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_cidade' => 'required',
            'edit_sigla_uf' => 'required'
        ];
        $messages = [
            'edit_cidade' => [
                'required' => 'O campo nome é obrigatório',
            ],
            'edit_sigla_uf' => [
                'required' => 'O campo sigla é obrigatório',
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'nome_cidade' => $this->request->getPost('edit_cidade'),
            'id_uf' => $this->request->getPost('edit_sigla_uf')
        ];
        $cidadesModel = new CidadesModel();
        $update = $cidadesModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Cidade atualizada com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar Cidade'
            ]);
        }
    }
    // ============================== DELETAR ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Cidade não encontrada na base de dados!!'
            ]);
        }
        $cidadesModel = new CidadesModel();
        $delete = $cidadesModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro da Cidade excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
