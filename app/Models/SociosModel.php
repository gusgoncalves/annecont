<?php

namespace App\Models;

use CodeIgniter\Model;

class SociosModel extends Model
{
    protected $table            = 'socios';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

    public function SociosPorCliente($id_cliente = null){
		$sql = "SELECT * FROM socios WHERE id_cliente = $id_cliente";
		$query = $this->db->query($sql);
		return $query->getResultArray();
	}

}
