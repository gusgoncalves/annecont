<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClientesModel;
use App\Models\SociosModel;
use App\Models\CertificadosModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $clientesModel      = new ClientesModel();
        $sociosModel        = new SociosModel();
        $certificadosModel  = new CertificadosModel();

        $hoje = date('Y-m-d');
        $mais30 = date('Y-m-d', strtotime('+30 days'));

        // Clientes ativos
        $totalClientes = $clientesModel
            ->where('ativo', 2)
            ->countAllResults();

        // Mensalistas
        $totalMensalistas = $clientesModel
            ->where('ativo', 1)
            ->where('mensal', 1)
            ->countAllResults();

        // Declaram IR (clientes PF)
        $clientesIR = $clientesModel
            ->where('declara_ir', 1)
            ->countAllResults();

        // Declaram IR (sócios)
        $sociosIR = $sociosModel
            ->where('declara_ir', 1)
            ->countAllResults();

        $totalIR = $clientesIR + $sociosIR;

        // Aniversariantes próximos 2 dias
        $aniversariantes = [];

        for ($i = 0; $i <= 2; $i++) {

            $data = date('m-d', strtotime("+{$i} days"));

            $resultado = $sociosModel
                ->select('nome,nascimento')
                ->where("DATE_FORMAT(nascimento,'%m-%d') =", $data)
                ->findAll();

            foreach ($resultado as $row) {

                $row['dias'] = $i;

                $aniversariantes[] = $row;
            }
        }

        // Certificados vencidos
        $certificadosVencidos = $certificadosModel
            ->where('dt_validade <', $hoje)
            ->where('ativo', 1)
            ->countAllResults();

        // Certificados vencendo em 30 dias
        $certificados30dias = $certificadosModel
            ->where('dt_validade >=', $hoje)
            ->where('dt_validade <=', $mais30)
            ->where('ativo', 1)
            ->countAllResults();
        // Próximos certificados a vencer
        $proximosCertificados = $certificadosModel
            ->select('
                certificados.id,
                certificados.dt_validade,
                certificados.descricao,
                clientes.fantasia,
                clientes.razao
            ')
            ->join('clientes', 'clientes.id = certificados.id_cliente')
            ->where('certificados.ativo', 1)
            ->where('certificados.dt_validade >=', $hoje)
            ->orderBy('certificados.dt_validade', 'ASC')
            ->limit(5)
            ->find();

        $dados = [
            'active_menu'           => 'dashboard',
            'totalClientes'         => $totalClientes,
            'totalMensalistas'      => $totalMensalistas,
            'totalIR'               => $totalIR,
            'aniversariantes'       => $aniversariantes,
            'certificadosVencidos'  => $certificadosVencidos,
            'certificados30dias'    => $certificados30dias,
            'proximosCertificados' => $proximosCertificados,
        ];

        return view('dashboard', $dados);
    }
     //======================
    public function clientesInativos()
    {
        $clientesModel = new \App\Models\ClientesModel();

        $dados = $clientesModel
            ->select('razao, fantasia, cnpj, whatsapp, email')
            ->where('ativo', 2)
            ->orderBy('razao', 'ASC')
            ->findAll();

        $cabecalhos = [
            'Razão Social',
            'Fantasia',
            'CNPJ',
            'WhatsApp',
            'E-mail'
        ];

        return view('dashboard/relatorio', [
            'titulo' => 'Clientes Inativos',
            'cabecalhos' => $cabecalhos,
            'dados' => $dados,
            'campos' => [
                'razao',
                'fantasia',
                'cnpj',
                'whatsapp',
                'email'
            ]
        ]);
    }
    //=====================
    public function clientesIR()
    {
        $clientesModel = new \App\Models\ClientesModel();

        $dados = $clientesModel
            ->select('razao, fantasia, cnpj, whatsapp, email')
            ->where('declara_ir', 1)
            ->orderBy('razao', 'ASC')
            ->findAll();

        $cabecalhos = [
            'Razão Social',
            'Fantasia',
            'CNPJ',
            'WhatsApp',
            'E-mail'
        ];

        return view('dashboard/relatorio', [
            'titulo' => 'Clientes que Declaram IR',
            'cabecalhos' => $cabecalhos,
            'dados' => $dados,
            'campos' => [
                'razao',
                'fantasia',
                'cnpj',
                'whatsapp',
                'email'
            ]
        ]);
    }
   
    //======================
    public function mensalistas()
    {
        $clientesModel = new \App\Models\ClientesModel();

        $dados = $clientesModel
            ->select('razao, fantasia, cnpj, whatsapp, email, valor')
            ->where('mensal', 1)
            ->where('ativo', 1)
            ->orderBy('razao', 'ASC')
            ->findAll();

        return view('dashboard/relatorio', [
            'titulo' => 'Clientes Mensalistas',
            'cabecalhos' => [
                'Razão Social',
                'Fantasia',
                'CNPJ',
                'WhatsApp',
                'E-mail',
                'Mensalidade'
            ],
            'dados' => $dados,
            'campos' => [
                'razao',
                'fantasia',
                'cnpj',
                'whatsapp',
                'email',
                'valor'
            ]
        ]);
    }
    //======================
    public function certificadosVencendo()
    {
        $certificadosModel = new \App\Models\CertificadosModel();

        $dados = $certificadosModel
            ->select('
                clientes.razao,
                clientes.fantasia,
                certificados.descricao,
                certificados.dt_validade
            ')
            ->join('clientes', 'clientes.id = certificados.id_cliente')
            ->where('certificados.ativo', 1)
            ->where('certificados.dt_validade >=', date('Y-m-d'))
            ->where(
                'certificados.dt_validade <=',
                date('Y-m-d', strtotime('+30 days'))
            )
            ->orderBy('certificados.dt_validade', 'ASC')
            ->findAll();

        return view('dashboard/relatorio', [
            'titulo' => 'Certificados Vencendo em 30 Dias',
            'cabecalhos' => [
                'Razão Social',
                'Fantasia',
                'Descrição',
                'Validade'
            ],
            'dados' => $dados,
            'campos' => [
                'razao',
                'fantasia',
                'descricao',
                'dt_validade'
            ]
        ]);
    }
    public function aniversariantes()
    {
        $sociosModel = new \App\Models\SociosModel();

        $dados = [];

        for ($i = 0; $i <= 2; $i++) {

            $data = date('m-d', strtotime("+{$i} days"));

            $resultado = $sociosModel
                ->select('nome,nascimento,whatsapp,email')
                ->where("DATE_FORMAT(nascimento,'%m-%d') =", $data)
                ->findAll();

            foreach ($resultado as $row) {

                $row['dias'] = $i;

                $dados[] = $row;
            }
        }

        return view('dashboard/relatorio', [
            'titulo' => 'Aniversariantes dos Próximos Dias',
            'cabecalhos' => [
                'Nome',
                'Nascimento',
                'WhatsApp',
                'E-mail',
                'Dias'
            ],
            'dados' => $dados,
            'campos' => [
                'nome',
                'nascimento',
                'whatsapp',
                'email',
                'dias'
            ]
        ]);
    }
}
