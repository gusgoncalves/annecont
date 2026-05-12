<style>
        @media print {
            body * {
                visibility: hidden;
            }
            #imprimir, #imprimir * {
                visibility: visible;
            }
            #imprimir {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                margin: 0 auto;
            }
        }
        h1 {
            font-family: Arial, Helvetica, sans-serif;
            text-align:center;
            text-decoration: underline;
        }
        .texto {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18pt;
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  </section>
  <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3>IMPRESSÃO DO RECIBO</h3>
                        </div>
                        <form role="form" action="" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
                            <div class="card-body">
                              <div class="form-group">
                                  <input type="hidden" class="form-control" id="alimentacao" name="alimentacao" value="<?= $funcionario_data['alimentacao']; ?>">
                              </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="diaria">DIÁRIA</label>
                                            <input type="text" class="form-control" id="diaria" name="diaria" value="<?= $funcionario_data['diaria']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dias">DIAS TRABALHADOS</label>
                                            <input type="number" class="form-control" id="dias" name="dias" min="0" max="31" oninput="updateResult()" required>
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
                        </form>
                        <div id="imprimir" style="display: none;">
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
                            <div class="moldura">
                                </br>
                                <h1>RECIBO</h1>
                                </br>
                                <p class="text-left texto">Recebi da empresa <?= $cliente['razao']; ?>, CNPJ Nº <?=$cliente['cnpj']; ?> os seguintes valores, referentes ao mês <?= date('m/Y') ?>.</p>
                                <p class="text-left texto"> - Vale Alimentação - R$ <?= $funcionario_data['alimentacao'] ?></p>
                                <p class="text-left texto"> - Diária - R$ <?= $funcionario_data['diaria']; ?></p>
                                <p class="text-left texto"> - Total Diária R$ <span id="calculadov1"></span> </p>
                                <p class="text-left texto"><b> - Total a Receber R$ <span id="calculadov3"></span></b> </p>
                                <br>
                                
                                <p class="text-left"> <?=$data_formatada?>. </p>
                                <p class="text-right">____________________________________ </p>
                                <p class="text-right"><?= $funcionario_data['nome']; ?> </p>
                                </br>                    
                            </div>
                            <hr class="hr-pontilhado">
                            <div class="moldura">
                                </br>
                                <h1>RECIBO</h1>
                                </br>           
                                <p class="text-left texto">Recebi da empresa <?= $cliente['razao']; ?>, CNPJ Nº <?=$cliente['cnpj']; ?> os seguintes valores, referentes ao mês <?= date('m/Y') ?>.</p>
                                <p class="text-left texto"> - Vale Alimentação - R$ <?= $funcionario_data['alimentacao'] ?></p>
                                <p class="text-left texto"> - Diária - R$ <?= $funcionario_data['diaria'] ?></p> 
                                <p class="text-left texto"> - Total Diária - R$ <span id="calculadov2"></span> </p>
                                <p class="text-left texto"><b> - Total a Receber - R$ <span id="calculadov4"></span></b> </p>
                                <br>
                                
                                <p class="text-left"><?= $data_formatada?>. </p>
                                <p class="text-right">____________________________________ </p>
                                <p class="text-right"><?= $funcionario_data['nome']; ?> </p>
                                </br>
                            </div>
                        </div>
                    </div><!--card -->
                </div><!-- col-md-12 -->
            </div> <!-- /.row -->
        <div><!-- <div class="container-fluid"> -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";

  //=======================ATIVAR O MENU ===========================
$(function () {
    var url = window.location.href;

    // Ativar o link diretamente acessado no menu
    $('ul.nav-sidebar a, ul.nav-treeview a').filter(function () {
        return this.href === url || url.startsWith(this.href);
    }).addClass('active')
    .closest('.nav-treeview') // Ativa o submenu se necessário
    .css({'display': 'block'})
    .addClass('menu-open')
    .prev('a') // Ativa o menu principal
    .addClass('active');
});

function updateResult() {
    const dias = parseFloat(document.getElementById('dias').value) || 0;
    const diaria = parseFloat(document.getElementById('diaria').value);
    const total = dias * diaria;
    document.getElementById('total').value = total.toFixed(2);
}

function printReport() {
    const total = parseFloat(document.getElementById('total').value) || 0;
    const alimentacao = parseFloat(document.getElementById('alimentacao').value);
    const totalGeral = (total + alimentacao);
    document.getElementById('calculadov1').textContent = total.toFixed(2);
    document.getElementById('calculadov2').textContent = total.toFixed(2);
    document.getElementById('calculadov3').textContent = totalGeral.toFixed(2);
    document.getElementById('calculadov4').textContent = totalGeral.toFixed(2);
    document.getElementById('imprimir').style.display = 'block';
    window.print();
    document.getElementById('imprimir').style.display = 'none';
}
</script>
