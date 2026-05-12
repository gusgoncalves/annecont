<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncionariosModel extends Model
{
	protected $table            = 'funcionarios';
	protected $returnType       = 'array';
	protected $allowedFields    = [
			'id_cliente','nome','nascimento','cpf','alimentacao','diaria','transporte','endereco','cep','whatsapp','email','observacoes','dt_cadastro','ativo'
	];

	public function getFuncionariosPorCliente($id = null){
		
		if($id) {
			//Os usuários filtram apenas pelos funcionarios ativos
			$sql = "SELECT * FROM `funcionarios` WHERE id_cliente = $id";
			$query = $this->db->query($sql);
			return $query->getResultArray();
		}
		else
		{
			$sql = "SELECT * FROM `funcionarios` ORDER BY nome asc";
			$query = $this->db->query($sql);
			return $query->getResultArray();		
		}
	}

}
