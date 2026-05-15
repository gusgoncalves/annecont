<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObrigacoesModel;

class Obrigacoes extends BaseController
{
    public function index()
    {
        return view('obrigacoes/index',['active_menu' => 'obrigacoes']);
    }
    // ============================== BUSCAR DADOS DE OBRIGAÇÕES PARA A DATATABLE ==============================
    public function buscaDadosObrigacao()
    {
        $obrigacoesModel = new ObrigacoesModel();
    	$result = array('data' => array());
		
        $data = $obrigacoesModel->orderBy('descricao', 'asc')->findAll();

		foreach ($data as $value) {
            $buttons = '';
            if(hasPermission('modificarObrigacao')) {//se tiver permissão para alterar clientes
    			$buttons .= '<button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editObrigacao('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            }
            if(hasPermission('apagarObrigacao')) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeObrigacao('.$value['id'].')" data-toggle="modal" data-target="#removeModalObrigacao"><i class="fas fa-trash"></i></button>';
            }
			$result['data'][] = array(
                'descricao' => $value['descricao'],
                'valor' => $value['valor'],
                'dt_inicio' => date('d/m/Y', strtotime($value['dt_inicio'])),
                'dt_fim' => date('d/m/Y', strtotime($value['dt_fim'])),
                'ativo' => $value['ativo'] == 1 ? '<span class="badge badge-success">Sim</span>' : '<span class="badge badge-danger">Não</span>',
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }    
    // ============================== SALVAR FUNCIONÁRIO ==============================
    public function create()
    {
       $rules = [
            'descricao' => 'required',
        ];
        $messages = [
            'descricao' => [
                'required' => 'O campo descrição é obrigatório'
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
            'descricao' => $this->request->getPost('descricao'),
            'valor' => $this->request->getPost('valor'),
            'ativo' => $this->request->getPost('ativo'),
            'dt_inicio' => $this->request->getPost('dt_inicio'),
            'dt_fim' => $this->request->getPost('dt_fim'),
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit; 
        $obrigacoesModel = new ObrigacoesModel();
        $create = $obrigacoesModel->insert($data);
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
        $obrigacoesModel = new ObrigacoesModel();
        $data = $obrigacoesModel->find($id);
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
        $obrigacoesModel = new ObrigacoesModel();
        $update = $obrigacoesModel->update($id, $data);
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
        $obrigacoesModel = new ObrigacoesModel();
        $delete = $obrigacoesModel->delete($id);
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
