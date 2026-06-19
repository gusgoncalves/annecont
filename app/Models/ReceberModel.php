<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceberModel extends Model
{
    protected $table            = 'receber';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nome',
        'dt_recebimento',
        'valor',
        'id_banco',
        'id_cliente',
        'observacoes',
        'quitado',
        'dt_quitado',
        'dt_estorno',
        'id_usuario',
        'id_usuario_quitou',
        'id_usuario_estorno',
        'vl_acrescimo',
        'vl_desconto',
        'referencia'
    ];
}
