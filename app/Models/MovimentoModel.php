<?php

namespace App\Models;

use CodeIgniter\Model;

class MovimentoModel extends Model
{
    protected $table            = 'movimentacao_conta';
    protected $returnType       = 'array';
    protected $allowedFields    = [];
}
