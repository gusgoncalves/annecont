<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadosModel extends Model
{
    protected $table            = 'uf';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nome', 'uf'];

     public function selectEstados(){
		return $this->orderBy('nome', 'ASC')->findAll();
	}
}
