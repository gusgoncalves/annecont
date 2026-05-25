<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table            = 'empresa';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nome_fantasia',
        'razao_social',
        'dias_aviso_receber',
        'dias_aviso_pagar',
        'dias_aviso_certificado',
        'dias_aviso_certidoes',
        'dias_aviso_logins',
        'dias_aviso_aniversario',
        'cnpj',
        'endereco',
        'telefone',
        'email',
        'chave_pix',
        'informacoes'
    ];
}
