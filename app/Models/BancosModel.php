<?php

namespace App\Models;

use CodeIgniter\Model;

class BancosModel extends Model
{
    protected $table            = 'bancos';
    protected $returnType       = 'array';
    protected $allowedFields    = ['descricao'];
}
