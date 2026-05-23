<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PagarModel;
use App\Models\ReceberModel;
use App\Models\MovimentoModel;

class Movimento extends BaseController
{
    public function index()
    {
        $pagarModel = new PagarModel();
        $pagar = $pagarModel->findAll();
        $receberModel = new ReceberModel();
        $receber = $receberModel->findAll();
        $movimentoModel = new MovimentoModel();
        $movimento = $movimentoModel->findAll();
        return view('financeiro/movimento', ['active_menu' => 'fluxo_caixa', 'pagar' => $pagar, 'receber' => $receber,'movimento' => $movimento]);
    }
}
