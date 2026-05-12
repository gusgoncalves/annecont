<?php

namespace App\Models;

use CodeIgniter\Model;

class PortesModel extends Model
{
    protected $table            = 'porte';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

    public function selectPortes(){
		return $this->orderBy('descricao', 'ASC')->findAll();
	}
}
