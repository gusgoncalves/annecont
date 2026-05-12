<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginsModel extends Model
{
    protected $table            = 'logins';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

    public function MostraLoginsPorCliente($id_cliente){
		$sql = "SELECT * FROM login_cliente WHERE id_cliente = $id_cliente";
		$query = $this->db->query($sql);
		return $query->getResultArray();
	}

	public function contaTotalLogins()	{
		$sql = "SELECT * FROM login_cliente WHERE id_cliente = ?";
		$query = $this->db->query($sql, array(1));
		return $query->getRowArray();
	}
}
