<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracoesModel extends Model
{
    protected $table            = 'configuracoes';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['chave','valor'];
 
}
