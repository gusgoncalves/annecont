<?php

namespace App\Models;

use CodeIgniter\Model;

class FaturamentoModel extends Model
{
    protected $table            = 'faturamentos';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_cliente', 'id_mes','mes', 'ano', 'valor'];

}
