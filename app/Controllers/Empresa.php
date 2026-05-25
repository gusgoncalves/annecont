<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmpresaModel;

class Empresa extends BaseController
{
    public function index()
    {
        $empresaModel = new EmpresaModel();
        $empresa = $empresaModel->findAll();
        return view('empresa/index', ['active_menu' => 'empresa', 'empresa' => $empresa]);
    }
    public function update()
    {
        $empresaModel = new EmpresaModel();
        $empresa = $empresaModel->findAll();        
    }
}
