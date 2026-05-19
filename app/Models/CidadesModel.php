<?php

namespace App\Models;

use CodeIgniter\Model;

class CidadesModel extends Model
{
    protected $table            = 'cidades';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nome_cidade', 'id_uf'];

}
