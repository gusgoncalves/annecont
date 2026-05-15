<?php

namespace App\Models;

use CodeIgniter\Model;

class CertidoesModel extends Model
{
    protected $table            = 'certidoes';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
       protected $allowedFields    = ['id_cliente', 'id_tipo_certidao', 'descricao','dt_expira'];
   
}
