<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PagarModel;
use App\Models\TiposContaModel;
use App\Models\BancosModel;

class Pagar extends BaseController
{
    public function index()
    {
        $bancosModel = new BancosModel();
        $bancos = $bancosModel->findAll();
        $tipoConta = new TiposContaModel();
        $tipo = $tipoConta->findAll();
        $pagarModel = new PagarModel();
        $pagar = $pagarModel->findAll();
        return view('financeiro/pagar', ['active_menu' => 'pagar', 'pagar' => $pagar, 'tipos' => $tipo, 'bancos' => $bancos]);
    }
    // ============================== BUSCAR DADOS DE PAGAR PARA A DATATABLE ==============================
    public function buscaDados()
    {
        $tipoContaModel = new TiposContaModel();
        $pagarModel = new PagarModel();
        $result = array('data' => array());
        $data = $pagarModel->where('quitado',0)->orderBY('dt_vencimento', 'asc')->findAll();
        foreach ($data as $value) {
            $tipoData = $tipoContaModel->where('id', $value['id_tipo'])->first();
            $buttons = '';
            if ($value['quitado'] == 0) {
                if (hasPermission('modificarPagar')) {
                    $buttons = ' <button type="button" style="font-size:0.55em" class="btn btn-success" onclick="quitarFunc(' . $value['id'] . ', ' . $value['valor_pagar'] . ')" data-toggle="modal" title="Quitar esta conta" data-target="#quitarModal"><i class="fa fa-check"></i></button>';
                }
            }
            if ($value['quitado'] == 1) {
                if (hasPermission('modificarPagar')) {
                    $buttons .= ' <button type="button" style="font-size:0.55em" class="btn btn-warning" onclick="estornarFunc(' . $value['id'] . ')" data-toggle="modal" title="Estornar Quitado" data-target="#estornarModal"><i class="fa fa-minus"></i></button>';
                }
            } else {
                if (hasPermission('modificarPagar')) { //se tiver permissão para alterar clientes
                    $buttons .= ' <button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editFunc(' . $value['id'] . ')"><i class="fas fa-edit"></i></button>';
                }
            }
            if (hasPermission('apagarPagar')) {
                $buttons .= ' <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
            $result['data'][] = array(
                'descricao' => $value['nome'],
                'vencimento' => date('d/m/Y', strtotime($value['dt_vencimento'])),
                'valor' => number_format($value['valor_pagar'], 2, ',', '.'),
                'situacao' => $value['quitado'] == 0 ? '<span class="badge badge-warning">Aberto</span>' : '<span class="badge badge-success">Pago</span>',
                'tipo' => $tipoData['nome'],
                'acoes' => $buttons
            );
        } // /foreach
        echo json_encode($result);
    }
    // ============================== SALVAR BANCO ==============================
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
        $pagarModel = new PagarModel();
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
                'valor_pagar'   => $this->request->getPost('valor'),
                'id_usuario'    => session()->get('id')
            ];
            // tenta inserir
            if (!$pagarModel->insert($data)) {

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
        $pagarModel = new PagarModel();
        $data = $pagarModel->find($id);
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
            'valor_pagar'   => $this->request->getPost('editar_valor'),
            'id_usuario'    => session()->get('id')
        ];
        //  echo '<pre>';
        //  print_r($data);
        //  echo '</pre>';
        //  exit;
        $pagarModel = new PagarModel();
        $update = $pagarModel->update($id, $data);
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
    //=============================QUITAR UMA CONTA A PAGAR ================================
    public function quitarPagar()
    {
        $pagarModel = new PagarModel();
        $id = $this->request->getPost('quitar_id');
        // busca conta
        $conta = $pagarModel->find($id);
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
        if ($pagarModel->update($id, $data)) {

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
        $pagarModel = new PagarModel();
        $delete = $pagarModel->delete($id);
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
    public function estornarPagar()
    {
        $response = [
            'success' => false,
            'messages' => ''
        ];
        $id = $this->request->getPost('id_pagar');
        if (!$id) {
            $response['messages'] = 'Conta inválida.';
            return $this->response->setJSON($response);
        }
        $pagarModel = new PagarModel();
        $conta = $pagarModel->find($id);
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
        if ($pagarModel->update($id, $dados)) {
            $response['success'] = true;
            $response['messages'] = 'Conta estornada com sucesso!';
        } else {
            $response['messages'] = 'Erro ao realizar estorno.';
        }
        return $this->response->setJSON($response);
    }
    //=========================HISTÓRICO DE PAGAMENTOS =================================
    public function historicoPagar()
    {
        $tipoConta = new TiposContaModel();
        $tipo = $tipoConta->findAll();
        $pagarModel = new PagarModel();
        $pagar = $pagarModel->findAll();
        return view('financeiro/historico', ['active_menu' => 'historico', 'pagar' => $pagar, 'tipos' => $tipo]);
    }
    //=========================CARREGA NA DATATABLE OS DADOS DE CONTAS QUITADAS ==========================
    public function buscaDadosHistorico()
    {
        $tipoContaModel = new TiposContaModel();
        $pagarModel     = new PagarModel();

        $dataInicial = $this->request->getPost('data_inicial');
        $dataFinal   = $this->request->getPost('data_final');

        // não carrega nada sem filtro
        if (empty($dataInicial) || empty($dataFinal)) {

            return $this->response->setJSON([
                'data' => []
            ]);
        }

        $data = $pagarModel
            ->where('quitado', 1)
            ->where('DATE(dt_vencimento) >=', $dataInicial)
            ->where('DATE(dt_vencimento) <=', $dataFinal)
            ->orderBy('dt_vencimento', 'DESC')
            ->findAll();

        $result = ['data' => []];

        foreach ($data as $value) {

            $tipoData = $tipoContaModel
                ->where('id', $value['id_tipo'])
                ->first();

            $buttons = '';

            if (hasPermission('modificarPagar')) {

                $buttons .= '
                <button 
                    type="button"
                    style="font-size:0.55em"
                    class="btn btn-warning"
                    onclick="estornarFunc('.$value['id'].')"
                    title="Estornar Quitado">
                    <i class="fa fa-minus"></i>
                </button>';
            }

            if (hasPermission('modificarPagar')) {

                $buttons .= '
                <button 
                    type="button"
                    class="btn btn-primary"
                    style="font-size:0.55em"
                    onclick="editFunc('.$value['id'].')">
                    <i class="fas fa-edit"></i>
                </button>';
            }

            $result['data'][] = [

                'descricao' => $value['nome'],

                'vencimento' => date(
                    'd/m/Y',
                    strtotime($value['dt_vencimento'])
                ),

                'valor' => number_format(
                    $value['valor_pagar'],
                    2,
                    ',',
                    '.'
                ),

                'situacao' => '
                <span class="badge badge-success">
                    Pago
                </span>',

                'tipo' => $tipoData['nome'] ?? '-',

                'acoes' => $buttons
            ];
        }

        return $this->response->setJSON($result);
    }

}
