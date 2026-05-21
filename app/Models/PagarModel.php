<?php

namespace App\Models;

use CodeIgniter\Model;

class PagarModel extends Model
{
    protected $table            = 'pagar';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_tipo','nome',
        'dt_vencimento',
        'valor_pagar',
        'vl_acrescimo',
        'vl_desconto',
        'id_banco',
        'quitado',
        'dt_quitado',
        'id_usuario_quitou',
        'dt_estorno',
        'id_usuario'
    ];
}
