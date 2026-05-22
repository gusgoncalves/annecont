<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ReceberModel;
use App\Models\ClientesModel;
use App\Models\BancosModel;

class Receber extends BaseController
{
    public function index()
    {
        $bancosModel = new BancosModel();
        $bancos = $bancosModel->findAll();
        $clientesModel = new ClientesModel();
        $clientes = $clientesModel->findAll();
        $receberModel = new ReceberModel();
        $receber = $receberModel->findAll();
        return view('financeiro/receber', ['active_menu' => 'receber', 'receber' => $receber, 'clientes' => $clientes, 'bancos' => $bancos]);
    }
    // ============================== BUSCAR DADOS DE RECEBER PARA A DATATABLE ==============================
    public function buscaDados()
    {
        $clientesModelModel = new ClientesModel();
        $receberModel = new ReceberModel();
        $result = array('data' => array());
        $data = $receberModel->where('quitado',0)->orderBY('dt_recebimento', 'asc')->findAll();
        foreach ($data as $value) {
            $clienteData = $clientesModelModel->where('id', $value['id_cliente'])->first();
            $buttons = '';
            if ($value['quitado'] == 0) {
                if (hasPermission('modificarReceber')) {
                    $buttons = ' <button type="button" style="font-size:0.55em" class="btn btn-success" onclick="quitarFunc(' . $value['id'] . ', ' . $value['valor'] . ')" data-toggle="modal" title="Quitar esta conta" data-target="#quitarModal"><i class="fa fa-check"></i></button>';
                }
            }
            if ($value['quitado'] == 1) {
                if (hasPermission('modificarReceber')) {
                    $buttons .= ' <button type="button" style="font-size:0.55em" class="btn btn-warning" onclick="estornarFunc(' . $value['id'] . ')" data-toggle="modal" title="Estornar Quitado" data-target="#estornarModal"><i class="fa fa-minus"></i></button>';
                }
            } else {
                if (hasPermission('modificarReceber')) { //se tiver permissão para alterar clientes
                    $buttons .= ' <button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editFunc(' . $value['id'] . ')"><i class="fas fa-edit"></i></button>';
                }
            }
            if (hasPermission('apagarReceber')) {
                $buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
            $result['data'][] = array(
                'descricao' => $value['nome'],
                'vencimento' => date('d/m/Y', strtotime($value['dt_recebimento'])),
                'cliente' => $clienteData['razao'] ?? 'Cliente Inexistente',
                'valor' => number_format($value['valor'], 2, ',', '.'),
                'situacao' => $value['quitado'] == 0 ? '<span class="badge badge-warning">Aberto</span>' : '<span class="badge badge-success">Pago</span>',
                'acoes' => $buttons
            );
        } // /foreach
        echo json_encode($result);
    }
    // ============================== SALVAR NO BANCO ==============================
    public function create()
    {
        $rules = [
            'tipo' => 'required',
            'nome' => 'required|min_length[3]',
            'dt_vencimento' => 'required|valid_date[Y-m-d]',
            'valor' => 'required|decimal|greater_than[0]'
        ];
        $messages = [
            'tipo' => [
                'required' => 'O tipo deve ser escolhido'
            ],
            'nome' => [
                'required' => 'A descrição da conta deve ser preenchida',
                'min_length' => 'A Identificação deve ter no mínimo 3 letras'
            ],
            'dt_vencimento' => [
                'required' => 'A data de vencimento é necessária',
                'valid_date' => 'Informe uma data válida'
            ],
            'valor' => [
                'required' => 'O valor deve ser preenchido',
                'decimal'      => 'Informe um valor válido',
                'greater_than' => 'O valor deve ser maior que zero'
            ]
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
        $receberModel = new ReceberModel();
        $parcelas       = (int) $this->request->getPost('parcelas');
        $dataBase       = $this->request->getPost('dt_vencimento');
        // se não informar parcelas, assume 1
        if ($parcelas <= 0) {
            $parcelas = 1;
        }

        for ($i = 0; $i < $parcelas; $i++) {
            $vencimento = date('Y-m-d', strtotime("+{$i} month", strtotime($dataBase)));
            $nomeConta = $this->request->getPost('nome');
            // adiciona descrição da parcela apenas se tiver mais de 1
            if ($parcelas > 1) {
                $nomeConta .= ' - Parcela ' . ($i + 1) . '/' . $parcelas;
            }
            $data = [
                'id_tipo'       => $this->request->getPost('tipo'),
                'nome'          => $nomeConta,
                'quitado'       => 0,
                'dt_vencimento' => $vencimento,
                'valor_receber'   => $this->request->getPost('valor'),
                'id_usuario'    => session()->get('id')
            ];
            // tenta inserir
            if (!$receberModel->insert($data)) {

                return $this->response->setJSON([
                    'success' => false,
                    'messages' => 'Erro ao salvar a Conta'
                ]);
            }
        }
        return $this->response->setJSON([
            'success' => true,
            'messages' => $parcelas > 1
                ? 'Parcelas criadas com sucesso'
                : 'Conta criada com sucesso'
        ]);
    }
    //========================FUNÇÃO PARA PEGAR OS DADOS DO BANCO POR ID =================
    public function getById($id)
    {
        $receberModel = new ReceberModel();
        $data = $receberModel->find($id);
        if ($data) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Banco não encontrado'
            ]);
        }
    }
    // ============================== ATUALIZAR TIPO DE CONTA ==============================
    public function update($id = null)
    {
        $rules = [
            'editar_tipo' => 'required',
            'editar_nome' => 'required|min_length[3]',
            'editar_dt_vencimento' => 'required|valid_date[Y-m-d]',
            'editar_valor' => 'required|decimal|greater_than[0]'
        ];
        $messages = [
            'editar_tipo' => [
                'required' => 'O tipo deve ser escolhido'
            ],
            'editar_nome' => [
                'required' => 'A descrição da conta deve ser preenchida',
                'min_length' => 'A Identificação deve ter no mínimo 3 letras'
            ],
            'editar_dt_vencimento' => [
                'required' => 'A data de vencimento é necessária',
                'valid_date' => 'Informe uma data válida'
            ],
            'editar_valor' => [
                'required' => 'O valor deve ser preenchido',
                'decimal'      => 'Informe um valor válido',
                'greater_than' => 'O valor deve ser maior que zero'
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => implode('<br>', $this->validator->getErrors())
            ]);
        }
        $data = [
            'id_tipo'       => $this->request->getPost('editar_tipo'),
            'nome'          => $this->request->getPost('editar_nome'),
            'dt_vencimento' => $this->request->getPost('editar_dt_vencimento'),
            'valor_receber'   => $this->request->getPost('editar_valor'),
            'id_usuario'    => session()->get('id')
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit;
        $receberModel = new ReceberModel();
        $update = $receberModel->update($id, $data);
        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Pagamento atualizado com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Erro ao atualizar Pagamento'
            ]);
        }
    }
    //=============================QUITAR UMA CONTA A RECEBER ================================
    public function quitarReceber()
    {
        $receberModel = new ReceberModel();
        $id = $this->request->getPost('quitar_id');
        // busca conta
        $conta = $receberModel->find($id);
        if (!$conta) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Conta não encontrada.'
            ]);
        }
        // recebe dados
        $dtBaixa      = $this->request->getPost('dt_baixa');
        $idBanco      = $this->request->getPost('id_banco');
        $acrescimo    = (float) ($this->request->getPost('vl_acrescimo') ?? 0);
        $desconto     = (float) ($this->request->getPost('vl_desconto') ?? 0);
       
        //evita negativos
        if($acrescimo < 0){
            $acrescimo = 0;
        }
        if($desconto < 0){
            $desconto = 0;
        }
        // dados atualização
        $data = [
            'quitado'       => 1,
            'dt_quitado'      => $dtBaixa,
            'id_banco'      => $idBanco,
            'vl_acrescimo'  => $acrescimo,
            'vl_desconto'   => $desconto,
            'id_usuario_quitou' => session()->get('id')
        ];
        // atualiza
        if ($receberModel->update($id, $data)) {

            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Conta quitada com sucesso!'
            ]);
        }
        return $this->response->setJSON([
            'success' => false,
            'messages' => 'Erro ao quitar a conta.'
        ]);
    }
    // ============================== DELETAR BANCO ==============================
    public function delete()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Banco não encontrado na base de dados!!'
            ]);
        }
        $receberModel = new ReceberModel();
        $delete = $receberModel->delete($id);
        if ($delete) {
            return $this->response->setJSON([
                'success' => true,
                'messages' => 'Registro do banco removido com sucesso'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'messages' => 'Um erro ocorreu!!'
            ]);
        }
    }
    //==================FUNÇÃO PARA ESTORNAR UM PAGAMENTO =============================
    public function estornarReceber()
    {
        $response = [
            'success' => false,
            'messages' => ''
        ];
        $id = $this->request->getPost('id_receber');
        if (!$id) {
            $response['messages'] = 'Conta inválida.';
            return $this->response->setJSON($response);
        }
        $receberModel = new ReceberModel();
        $conta = $receberModel->find($id);
        if (!$conta) {
            $response['messages'] = 'Conta não encontrada.';
            return $this->response->setJSON($response);
        }
        // verifica se realmente está quitada
        if ($conta['quitado'] != '1') {
            $response['messages'] = 'A conta não está quitada.';
            return $this->response->setJSON($response);
        }
        $dados = [
            'quitado'        => 0,
            'dt_quitado'     => null,
            'id_banco'       => null,
            'vl_acrescimo'   => 0,
            'vl_desconto'    => 0,
            'data_pagamento' => null,
            'id_usuario_estornou' => session()->get('id')
        ];
        if ($receberModel->update($id, $dados)) {
            $response['success'] = true;
            $response['messages'] = 'Conta estornada com sucesso!';
        } else {
            $response['messages'] = 'Erro ao realizar estorno.';
        }
        return $this->response->setJSON($response);
    }
    //=========================HISTÓRICO DE RECEBIMENTOS =================================
    public function historicoReceber()
    {
        $bancosModel = new BancosModel();
        $bancos = $bancosModel->findAll();
        $clientesModel = new ClientesModel();
        $clientes = $clientesModel->findAll();
        $receberModel = new ReceberModel();
        $receber = $receberModel->findAll();
        return view('financeiro/receber_historico', ['active_menu' => 'historico', 'receber' => $receber, 'clientes' => $clientes,'bancos' => $bancos]);
    }
    //=========================CARREGA NA DATATABLE OS DADOS DE CONTAS QUITADAS ==========================
    public function buscaDadosHistorico()
    {
        $clientesModelModel = new ClientesModel();
        $receberModel     = new ReceberModel();
        $bancoModel     = new BancosModel();

        $dataInicial = $this->request->getPost('data_inicial');
        $dataFinal   = $this->request->getPost('data_final');

        $builder = $receberModel
            ->where('quitado', 1);

        // se pesquisou período
        if (!empty($dataInicial) && !empty($dataFinal)) {
            $builder->where('DATE(dt_vencimento) >=', $dataInicial);
            $builder->where('DATE(dt_vencimento) <=', $dataFinal);
        } else {
            // padrão: últimos 30 dias
            $builder->where(
                'DATE(dt_vencimento) >=',
                date('Y-m-d', strtotime('-30 days'))
            );
        }
        $data = $builder
            ->orderBy('dt_vencimento', 'DESC')
            ->findAll();
        $result = ['data' => []];
        foreach ($data as $value) {
            $tipoData = $clientesModelModel->where('id', $value['id_tipo'])->first();
            $bancoData = $bancoModel->where('id', $value['id_banco'])->first();
            $buttons = '';
            if (hasPermission('modificarreceber')) {
                $buttons .= ' <button type="button" style="font-size:0.55em" class="btn btn-warning" onclick="estornarFunc('.$value['id'].')" title="Estornar Quitado"><i class="fa fa-minus"></i></button>';
            }
            // if (hasPermission('modificarreceber')) {
            //     $buttons .= ' <button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editFunc('.$value['id'].')"><i class="fas fa-edit"></i></button>';
            // }
            $valor_total = $value['valor_receber'] + $value['vl_acrescimo'] - $value['vl_desconto'];
            $result['data'][] = [
                'descricao' => $value['nome'],
                'dt_quitado' => date('d/m/Y',strtotime($value['dt_quitado'])),
                //'valor' => number_format($value['valor_receber'],2,',','.'),
                'valor' => number_format($valor_total,2,',','.'),
                'banco' => $bancoData['descricao'],
                'situacao' => '<span class="badge badge-success">Pago</span>',
                'tipo' => $tipoData['nome'] ?? '-',
                'acoes' => $buttons
            ];
        }
        return $this->response->setJSON($result);
    }
}
