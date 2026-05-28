<?php

namespace App\Models;

use CodeIgniter\Model;

class ObrigacoesRealizadasModel extends Model
{
    protected $table            = 'obrigacoes_realizadas';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_cliente','data'];
}
