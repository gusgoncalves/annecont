<?php

namespace App\Models;

use CodeIgniter\Model;

class ObrigacoesClienteModel extends Model
{
    protected $table            = 'obrigacoes_cliente';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_cliente',
        'id_obrigacao',
        'dt_ultimo',
        'feito',
        'id_usuario_fechou'
    ];

}
