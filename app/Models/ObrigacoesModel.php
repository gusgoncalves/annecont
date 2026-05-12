<?php

namespace App\Models;

use CodeIgniter\Model;

class ObrigacoesModel extends Model
{
    protected $table            = 'obrigacoes';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

    public function getObrigacoesPorCliente($id = null){
		//mostra somente de um cliente especifico
		if($id) {
			$sql = "SELECT a.id_obrigacao, a.id_cliente, b.descricao, b.dt_inicio, b.dt_fim, a.feito, a.dt_ultimo
			FROM obrigacoes_cliente a INNER JOIN obrigacoes b ON a.id_obrigacao = b.id
			WHERE a.id_cliente = ? ORDER BY b.descricao ASC";
			$query = $this->db->query($sql, array($id));
			return $query->getResultArray();
		}
		//mostra todas de todos os clientes
		$sql = "SELECT a.id_obrigacao, a.id_cliente, b.descricao
		FROM obrigacoes_cliente a INNER JOIN obrigacoes b ON a.id_obrigacao = b.id";
		$query = $this->db->query($sql);
		return $query->getResultArray();
	}

    public function obrigacoesFeita($id_cliente){
		$sql = "SELECT count(feito) as realizado FROM obrigacoes_cliente WHERE id_cliente = $id_cliente and feito <> 1";
		$query = $this->db->query($sql);
		return $query->getRowArray();
	}

}
