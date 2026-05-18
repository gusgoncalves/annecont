<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginsModel extends Model
{
    protected $table            = 'login_cliente';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_cliente','descricao','usuario','senha'];

}
