<?php

namespace App\Models;

use CodeIgniter\Model;

class ObrigacoesRealizadasModel extends Model
{
    protected $table            = 'obrigacoes_realizadas';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
            'id_cliente',
            'valor_obrigacoes',
            'valor_cliente',
            'descricao',
            'data_cobranca',
            'id_usuario_enviou',
            'status',
            'dt_pagamento',
            'id_conta_receber',
            ];
}
