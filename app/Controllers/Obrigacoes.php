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
    public function buscaDados()
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
                'valor' => $value['valor']==0?'<span class="badge badge-default">R$ 0,00</span>':'R$ '.number_format($value['valor'],2,',','.'),
                'dt_inicio' => empty($value['dt_inicio']) ? '<span class="badge badge-secondary">Sempre</span>' : date('d/m/Y', strtotime($value['dt_inicio'])),
                'dt_fim' => empty($value['dt_fim']) ? '<span class="badge badge-secondary">Sempre</span>' : date('d/m/Y', strtotime($value['dt_fim'])),
                'ativo' => $value['ativo'] == 1 ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>',
				'acoes' => $buttons
			);
		} // /foreach
		echo json_encode($result);
    }
    // ============================== SALVAR OBRIGAÇÃO ==============================
    public function create()
    {
       $rules = [
            'obrigacao_descricao' => 'required',
        ];
        $messages = [
            'obrigacao_descricao' => [
                'required' => 'O campo descrição é obrigatório'
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
            'descricao' => $this->request->getPost('obrigacao_descricao'),
            'valor' => $this->request->getPost('valor'),
            'ativo' => 1,
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
                'messages' => 'Obrigação adicionada com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao salvar Obrigação'
            ]);
        }
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO OBRIGAÇÃO POR ID =================
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
                'messages' => 'Obrigação não encontrada'
            ]);
        }
    }
    // ============================== ATUALIZAR OBRIGAÇÃO ==============================
    public function update($id = null)
    {
        $rules = [
            'edit_obrigacao_descricao' => 'required'
        ];
        $messages = [
            'edit_obrigacao_descricao' => [
                'required' => 'O campo descrição é obrigatório'
            ],
        ];
        if (!$this->validate($rules, $messages)) {

            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'descricao' => $this->request->getPost('edit_obrigacao_descricao'),
            'valor' => $this->request->getPost('edit_valor'),
            'dt_inicio' => empty($this->request->getPost('edit_dt_inicio')) ? null : $this->request->getPost('edit_dt_inicio'),
            'dt_fim' => empty($this->request->getPost('edit_dt_fim')) ? null : $this->request->getPost('edit_dt_fim'),
            'ativo' => $this->request->getPost('edit_obrigacao_ativo'),
        ];
        $obrigacoesModel = new ObrigacoesModel();
        $update = $obrigacoesModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Obrigação atualizada com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar obrigação'
            ]);
        }
    }
    // ============================== DELETAR OBRIGAÇÃO ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if(!$id) {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Obrigaçao não encontrada na base de dados!!'
            ]);
        }
        $obrigacoesModel = new ObrigacoesModel();
        $delete = $obrigacoesModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true, 
                'messages' => 'Registro da obrigação excluído com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false, 
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
}
