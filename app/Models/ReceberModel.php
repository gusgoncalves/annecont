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
        'obserevacoes',
        'quitado',
        'dt_quitado',
        'dt_estornado',
        'id_usuario',
        'id_usuario_quitou',
        'id_usuario_estornou',
        'vl_acrescimo',
        'vl_desconto'
    ];
}
