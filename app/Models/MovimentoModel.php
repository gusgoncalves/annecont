<?php

namespace App\Models;

use CodeIgniter\Model;

class MovimentoModel extends Model
{
    protected $table            = 'movimentacao_conta';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'dt_movimento',
        'dt_baixa',
        'descricao',
        'valor',
        'id_banco',
        'tipo',
        'id_usuario',
        'id_pagar',
        'id_receber'
    ];
}
