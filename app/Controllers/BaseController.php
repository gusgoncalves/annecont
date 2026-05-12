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
            return redirect()->to('/dashboard');
        }
    }

    protected function nao_logado()
    {
        if(!$this->session->get('logou')){
            return redirect()->to('/login');
        }
    }

}
