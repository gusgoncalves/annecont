<?php

namespace App\Models;

use CodeIgniter\Model;

class SociosModel extends Model
{
    protected $table            = 'socios';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_cliente',
        'nome',
        'cpf',
        'rg',
        'titulo',
        'nascimento',
        'nome_mae',
        'endereco',
        'whatsapp',
        'email',
        'recibo',
        'observacoes',
        'dt_cadastro',
        'declara_ir'
    ];
}
