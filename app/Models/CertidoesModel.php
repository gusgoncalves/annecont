<?php

namespace App\Models;

use CodeIgniter\Model;

class CertidoesModel extends Model
{
    protected $table            = 'certidoes';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
   
    protected $allowedFields    = [];

    public function MostraCertidoesPorCliente($id_cliente)
	{
		$sql = "SELECT * FROM certidoes WHERE id_cliente = $id_cliente";
		$query = $this->db->query($sql);
		return $query->getResultArray();
	}

   
}
