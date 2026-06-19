<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\GruposModel;

abstract class BaseController extends Controller
{
   protected $session;
   protected $modelGrupos;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        $this->gerarMensalidades();
        //sessão
        $this->session = session();
        //permissões
        helper('global_helper');
        //models
        $this->modelGrupos = new GruposModel();
        //controler de logins
        if($this->session->get('logou') && !$this->session->get('user_permission')){
            $user_id = $this->session->get('id');
            $grupo_data = $this->modelGrupos->getUserGroupByUserId($user_id);
            $permissoes = unserialize($grupo_data['permission']?? '') ?: [];
            $this->session->set('user_permission', $permissoes);
        }
    }

    protected function logado()
        {
        if($this->session->get('logou')===true){
            $this->gerarMensalidades();
            return redirect()->to('/dashboard');
        }
    }

    protected function nao_logado()
    {
        if(!$this->session->get('logou')){
            return redirect()->to('/login');
        }
    }
    //===================MENSALIDADES ===================
    protected function gerarMensalidades()
    {
        $configModel = new \App\Models\ConfiguracoesModel();
        $clientesModel = new \App\Models\ClientesModel();
        $receberModel = new \App\Models\ReceberModel();

        $config = $configModel
            ->where('chave', 'ultima_geracao_mensalidade')
            ->first();
        $mesAtual = date('Y-m');
        // já executou este mês?
        if ($config['valor'] == $mesAtual) {
            return;
        }
        $clientes = $clientesModel
            ->where('ativo', 1)
            ->findAll();
        foreach ($clientes as $cliente) {
            if (empty($cliente['valor'])) {
                continue;
            }
            if (empty($cliente['dia_vencimento'])) {
                continue;
            }
            $mesReferencia = date('Y-m', strtotime('+1 month'));
            $existe = $receberModel
                ->where('id_cliente', $cliente['id'])
                ->where('referencia', $mesReferencia)
                ->countAllResults();
            if ($existe > 0) {
                continue;
            }
            $vencimento = date('Y-m-d', strtotime($mesReferencia . '-' .str_pad($cliente['dia_vencimento'], 2, '0', STR_PAD_LEFT)));
            $receberModel->insert([
                'id_cliente'     => $cliente['id'],
                'nome'           => 'Mensalidade ' . date('m/Y', strtotime('+1 month')),
                'valor'          => $cliente['valor'],
                'dt_recebimento' => $vencimento,
                'quitado'        => 0,
                'referencia'     => $mesReferencia
            ]);
        }
        $configModel->update($config['id'],['valor' => $mesAtual]);
    }
}
