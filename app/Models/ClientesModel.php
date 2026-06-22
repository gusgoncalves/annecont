<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table            = 'clientes';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_porte',
        'fantasia',
        'razao',
        'cnpj',
        'endereco',
        'cep',
        'id_cidade',
        'id_uf',
        'whatsapp',
        'email',
        'dt_abertura',
        'observacoes',
        'dt_cadastro',
        'valor',
        'dia_vencimento',
        'ativo',
        'declara_ir',
        'mensal'
    ];    
    public function recebeDadosClienteComContadores()
	{
        $sql = "SELECT c.*, 
        (SELECT COUNT(*) FROM funcionarios f WHERE f.id_cliente = c.id) as qtd_funcionarios,
        (SELECT COUNT(*) FROM certificados cert WHERE cert.id_cliente = c.id) as qtd_certificados,
        (SELECT COUNT(*) FROM certidoes ce WHERE ce.id_cliente = c.id) as qtd_certidoes,
        (SELECT COUNT(*) FROM obrigacoes_cliente o WHERE o.id_cliente = c.id) as qtd_obrigacoes,
        (SELECT COUNT(*) FROM login_cliente l WHERE l.id_cliente = c.id) as qtd_logins,
        (SELECT COUNT(*) FROM faturamentos fatu WHERE fatu.id_cliente = c.id) as qtd_faturamentos
            FROM clientes c ORDER BY c.ativo ASC, c.razao ASC;";
        $query = $this->db->query($sql);
        return $query->getResultArray();
	}
}
