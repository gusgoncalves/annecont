<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AuthModel;

class Auth extends BaseController
{
    public function login()
    {
        if($redirect = $this->logado())
        {
            return $redirect;
        }
        if (!$this->request->is('post')) {
            return view('login');
        }

         $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
         $messages = [
            'username' => [
                'required' => 'Informe o usuário'
            ],
            'password' => [
                'required' => 'Informe a senha'
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', implode('<br>', $this->validator->getErrors()));
        }
        $authModel = new AuthModel();
       
        $username = strtolower($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        $login = $authModel->login($username, $password);
        if(!$login)
        {
            return redirect()->back()
                ->withInput()
                ->with('errors', 'Usuário ou senha inválidos')  ;
        }
        $this->session->set([
            'id' => $login['id'],
            'username' => $login['username'],
            'email' => $login['email'],
            'logou' => true
        ]);
        return redirect()->to('/dashboard');
    }

    public function logout()
	{
		$this->session->destroy();
		return redirect()->to('login');
	}
}
