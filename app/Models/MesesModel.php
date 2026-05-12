<?php

namespace App\Models;

use CodeIgniter\Model;

class MesesModel extends Model
{
    protected $table            = 'meses';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

    public function getMeses(){
		return $this->orderBy('id')->findAll();
	}
	//===================FUNÇÃO QUE MOSTRA A COMBO DO MESES NOME E CÓDIGO ==============================
	public function selectMeses(){
		$options = "<option value=''>Selecione o mes</option>";
		$meses = $this->getMeses();
	}
}
