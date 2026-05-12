<?php

namespace App\Models;

use CodeIgniter\Model;

class FaturamentoModel extends Model
{
    protected $table            = 'faturamentos';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

    public function MostraFaturamentoPorCliente($id_cliente){
		$ano = date('Y');
		$sql = "SELECT * FROM faturamentos WHERE id_cliente = $id_cliente AND ano = '$ano' ORDER BY ano, id_mes ASC";
		$query = $this->db->query($sql);
		return $query->getResultArray();
	}

	public function MostraTotalFaturamentoPorCliente($id_cliente){
		$ano = date('Y');
		$sql = "SELECT sum(valor) as total FROM faturamentos WHERE id_cliente = $id_cliente and ano='$ano'";
		$query = $this->db->query($sql);
		return $query->getRowArray();
	}
}
