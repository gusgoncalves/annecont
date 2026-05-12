<?php

namespace App\Models;

use CodeIgniter\Model;

class CidadesModel extends Model
{
    protected $table            = 'cidades';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

     public function getCidadesPorEstado($idUf)
    {
        return $this->where('id_uf', $idUf)
                    ->orderBy('nome_cidade', 'ASC')
                    ->findAll();
    }
}
