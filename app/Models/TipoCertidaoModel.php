<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoCertidaoModel extends Model
{
    protected $table            = 'tipo_certidao';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nome', 'descricao'];
}
