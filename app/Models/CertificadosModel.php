<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificadosModel extends Model
{
    protected $table            = 'certificados';
    protected $primaryKey = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
      'id_cliente',
      'descricao',
      'dt_validade',
      'login',
      'senha',
      'arquivo',
      'ativo'
    ];

}
