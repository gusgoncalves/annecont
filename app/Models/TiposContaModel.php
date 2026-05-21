<?php

namespace App\Models;

use CodeIgniter\Model;

class TiposContaModel extends Model
{
    protected $table            = 'tipo_conta';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nome','tipo'];
}
