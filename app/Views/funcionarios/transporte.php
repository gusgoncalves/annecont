<style>
    h1 {
        font-family: Arial, Helvetica, sans-serif;
        text-align:center;
        text-decoration: underline;
    }
    .texto {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13pt;
    }
    .report-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .report-footer {
        text-align: center;
        margin-top: 20px;
    }
    .report-table {
        width: 100%;
        border-collapse: collapse;
    }
    .report-table th, .report-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .report-table th {
        background-color: #f2f2f2;
    }
    .hr-pontilhado {
        border: none;
        border-top: 1px dotted #000; /* Ajuste a cor e a espessura aqui */
        margin: 20px 0; /* Ajuste o espaçamento conforme necessário */
        position: relative; /* Necessário para posicionar o ícone */
    }

    .hr-pontilhado::before {
        content: '\f0c4'; /* Código Unicode para o ícone de tesoura do Font Awesome */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900; /* Necessário para o estilo sólido do ícone */
        position: absolute;
        top: -12px; /* Ajuste para alinhar verticalmente */
        left: 1%; /* Centraliza horizontalmente */
        transform: translateX(-50%); /* Ajuste fino para centralização */
        background: #fff; /* Fundo branco para que o ícone não sobreponha a linha */
        padding: 0 5px; /* Ajuste o preenchimento conforme necessário */
    }
    .moldura {
        border: 1px solid #000; /* Define a borda: espessura, estilo e cor */
        padding: 10px;          /* Espaçamento interno */
        margin: 20px;           /* Espaçamento externo */
        border-radius: 5px;     /* Bordas arredondadas */
        background-color: #f9f9f9; /* Cor de fundo */
    }
</style>
<?
/**@var array $cliente */
/**@var array $funcionario */
?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Transporte de Funcionário
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <section class="content-header"></section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3>IMPRESSÃO DO VALE TRANSPORTE</h3>
                    </div>
                    <form role="form" action="" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="valor_passagem">VALOR DA PASSAGEM</label>
                                        <input type="text" class="form-control" id="valor_passagem" name="valor_passagem" value="<?= $funcionario['transporte']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantidade">QUANTIDADE DE PASSAGENS</label>
                                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="0" max="100" oninput="updateResult()" required>
                                        <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total">TOTAL CALCULADO</label>
                                        <input type="text" class="form-control" id="total" name="total"  readonly>    
                                    </div>
                                </div>
                            </div><!-- div row -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-success" onclick="printReport()">CALCULAR</button>
                                <?php if ($cliente) : ?>
                                    <a href="<?= base_url('clientes/ver/').$cliente['id'] ?>" class="btn btn-danger">FECHAR</a>
                                <?php else : ?>
                                    <a href="<?= base_url('funcionarios/') ?>" class="btn btn-danger">FECHAR</a>
                                <?php endif; ?>
                            </div><!-- card footer -->
                        </div>
                    </form>
                    <?php
                        // Define a cidade
                        $cidade = "Ponta Grossa";

                        // Array com os nomes dos meses em português
                        $meses = [
                            1 => "Janeiro", 2 => "Fevereiro", 3 => "Março",
                            4 => "Abril", 5 => "Maio", 6 => "Junho",
                            7 => "Julho", 8 => "Agosto", 9 => "Setembro",
                            10 => "Outubro", 11 => "Novembro", 12 => "Dezembro"
                        ];

                        // Obtém o dia, mês e ano atuais
                        $dia = date('d');
                        $mes = $meses[(int)date('m')];
                        $ano = date('Y');

                        // Formata a data no estilo desejado
                        $data_formatada = sprintf("%s, %02d de %s de %d", $cidade, $dia, $mes, $ano);

                    ?>
                    <div id="imprimir" style="display:none;">
                        <div class="moldura">
                            </br>
                            <h1>RECIBO</h1>
                            </br>           
                            <p class="text-left texto">Recebi da empresa <?= $cliente['razao']; ?>, CNPJ Nº <?=$cliente['cnpj']; ?>, situado na <?=$cliente['endereco'] ?>
                            , <?=$cidade ?>, a importância supra de <b>R$ <span id="calculadov1"></span></b>, referente a quantidade de <b><span id="quantidadev1"></span></b> vales-transporte,
                                no valor unitário de <b>R$ <?= number_format($funcionario['transporte'],2, ',','.') ?></b> referente ao mês de <?= $mes ?>
                                de <?= $ano?>. E, para maior clareza, firmo o presente recibo para que produza os efeitos, dando plena, rasa e irrevogável quitação, pelo valor recebido.</p>
                            <br>
                            
                            <p class="text-left"><?= $data_formatada?>. </p>
                            <p class="text-right">____________________________________ </p>
                            <p class="text-right"><?= $funcionario['nome']; ?> </p>
                        </div>                    
                        <hr class="hr-pontilhado">
                        <div class="moldura">
                            </br>
                            <h1>RECIBO</h1>
                            </br>           
                            <p class="text-left texto">Recebi da empresa <?= $cliente['razao']; ?>, CNPJ Nº <?=$cliente['cnpj']; ?>, situado na <?=$cliente['endereco'] ?>
                            , <?=$cidade ?>, a importância supra de <b>R$ <span id="calculadov2"></span></b>, referente a quantidade de <b><span id="quantidadev2"></span></b> vales-transporte,
                                no valor unitário de <b>R$ <?= number_format($funcionario['transporte'],2, ',','.') ?></b> referente ao mês de <?= $mes ?>
                                de <?= $ano?>. E, para maior clareza, firmo o presente recibo para que produza os efeitos, dando plena, rasa e irrevogável quitação, pelo valor recebido.</p>
                            <br>
                            
                            <p class="text-left"><?= $data_formatada?>. </p>
                            <p class="text-right">____________________________________ </p>
                            <p class="text-right"><?= $funcionario['nome']; ?> </p>
                            </br>
                        </div>
                    </div>
                </div><!--card -->
            </div><!-- col-md-12 -->
        </div><!-- /.row --> 
    </section><!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <script type="text/javascript">
        var base_url = "<?= base_url(); ?>";

            function updateResult() {
                const quantidadeElement = document.getElementById('quantidade');
                const valorPassagemElement = document.getElementById('valor_passagem');
                const totalElement = document.getElementById('total');

                // Verifica se os elementos existem
                if (quantidadeElement && valorPassagemElement && totalElement) {
                    const quantidade = parseFloat(quantidadeElement.value) || 0;
                    const valorPassagem = parseFloat(valorPassagemElement.value);

                    // Verifica se valor_passagem é um número válido
                    if (!isNaN(valorPassagem)) {
                        const total = quantidade * valorPassagem;
                        totalElement.value = total.toFixed(2);
                        quantidadeElement.value = quantidade; // Isto é redundante se quantidade não for alterado
                    } else {
                        console.error("Valor da passagem não é um número válido.");
                    }
                } else {
                    console.error("Elementos não encontrados no DOM.");
                }
            }

        function printReport() {

            const total = document.getElementById('total').value;
            const quantidade = document.getElementById('quantidade').value;

            if (quantidade == '' || quantidade <= 0) {
                alert('Informe a quantidade de passagens.');
                return;
            }

            document.getElementById('calculadov1').textContent = total;
            document.getElementById('calculadov2').textContent = total;

            document.getElementById('quantidadev1').textContent = quantidade;
            document.getElementById('quantidadev2').textContent = quantidade;

            const conteudo = document.getElementById('imprimir').innerHTML;

            const tela_impressao = window.open('', '', 'width=900,height=700');

            tela_impressao.document.write(`
                <html>
                <head>
                    <title>Impressão</title>
                    <style>
                        body {
                            font-family: Arial, Helvetica, sans-serif;
                            margin: 10px;
                            font-size: 12px;
                        }
                        h1 {
                            text-align: center;
                            text-decoration: underline;
                            margin: 5px 0;
                            font-size: 20px;
                        }
                        .texto {
                            font-size: 14px;
                            line-height: 1.5;
                            text-align: justify;
                        }
                        .moldura {
                            border: 1px solid #000;
                            padding: 10px;
                            margin-bottom: 10px;
                            border-radius: 5px;
                        }
                        .hr-pontilhado {
                            border: none;
                            border-top: 1px dotted #000;
                            margin: 15px 0;
                        }
                        p {
                            margin: 5px 0;
                        }
                        @media print {
                            body {
                                margin: 0;
                            }
                            .moldura {
                                page-break-inside: avoid;
                            }
                        }
                    </style>
                </head>
                <body>
                    ${conteudo}
                </body>
                </html>
            `);
            tela_impressao.document.close();
            setTimeout(() => {
                tela_impressao.focus();
                tela_impressao.print();
                tela_impressao.close();
            }, 500);
        }
    </script>
<?= $this->endSection() ?>
