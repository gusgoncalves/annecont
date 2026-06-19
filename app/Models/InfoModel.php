<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoModel extends Model
{
    protected $table            = 'informacoes_cliente';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['descricao','dt_inclusao','id_usuario','id_cliente'];

}
