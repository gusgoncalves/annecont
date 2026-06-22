<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObrigacoesModel;
use App\Models\ClientesModel;
use App\Models\SociosModel;
use App\Models\ObrigacoesClienteModel;

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

    //===================================================================================
    public function gerarIR()
    {
        $obrigacoesModel = new ObrigacoesModel();
        $clientesModel = new ClientesModel();
        $sociosModel = new SociosModel();
        $obrigacoesClientesModel = new ObrigacoesClienteModel();

        $hoje = date('Y-m-d');
        // Obrigações dentro do período
        $obrigacoes = $obrigacoesModel
            ->where('dt_fim >=', $hoje)
            ->findAll();
        if (empty($obrigacoes)) {
            return redirect()->back()->with('warning', 'Nenhuma obrigação ativa encontrada.');
        }
        // Clientes com declara IR
        $clientesDiretos = $clientesModel
            ->select('id')
            ->where('declara_ir', 1)
            ->findAll();

        // Clientes com sócios que declaram IR
        $clientesSocios = $sociosModel
            ->select('id_cliente')
            ->where('declara_ir', 1)
            ->findAll();
        $idsClientes = [];
        foreach ($clientesDiretos as $c) {
            $idsClientes[] = $c['id'];
        }
        foreach ($clientesSocios as $s) {
            $idsClientes[] = $s['id_cliente'];
        }
        $idsClientes = array_unique($idsClientes);
        $inseridos = 0;
        $existentes = 0;
        foreach ($obrigacoes as $obrigacao) {
            foreach ($idsClientes as $idCliente) {
                $existe = $obrigacoesClientesModel
                    ->where('id_cliente', $idCliente)
                    ->where('id_obrigacao', $obrigacao['id'])
                    ->first();
                if ($existe) {
                    $existentes++;
                    continue;
                }
                $obrigacoesClientesModel->insert([
                    'id_cliente' => $idCliente,
                    'id_obrigacao' => $obrigacao['id'],
                    'feito' => 0,
                    'dt_ultimo' => null,
                    'id_usuario_fechou' => null
                ]);
                $inseridos++;
            }
        }
        return redirect()->back()->with(
            'success',
            "Processo concluído. {$inseridos} obrigações inseridas. {$existentes} já existiam."
        );
    }
}
