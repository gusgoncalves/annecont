<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificadosModel extends Model
{
    protected $table            = 'certificados';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

    public function MostraCertificadosPorCliente($id_cliente)	{
		$sql = "SELECT * FROM certificados WHERE id_cliente = $id_cliente";
		$query = $this->db->query($sql);
		return $query->getResultArray();
	}
}
