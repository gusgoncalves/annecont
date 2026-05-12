  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>
      <!-- Main content -->
      <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <div class="col-md-12 col-xs-12">
                  <div id="messages"></div>
                  <div class="card">
                      <div class="card-header bg-primary">
                          <h5 class="text-center"><?= $dados_cliente['razao']?></h5>
                      </div>
                      <!-- /.box-header -->
                      <div class="card-body">
                        <div class="mb-3">
                          <label>Escolha o ANO </label>
                            <?php foreach ($anos_disponiveis as $anoItem): ?>
                                <a href="<?= base_url("reports/faturamento/{$id_cliente}") ?>?ano=<?= $anoItem['ano'] ?>"
                                class="btn btn-sm-2 <?= ($anoItem['ano'] == $ano) ? 'btn-primary' : 'btn-outline-primary' ?> mx-1">
                                    <?= $anoItem['ano'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div>
                          <?php if($faturamento) :?>
                            <table class="table table-striped table-bordered" id="area-impressao">
                              <thead>
                                <tr>
                                  <th>ANO</th>
                                  <th>MÊS</th>
                                  <th>VALOR</th>
                                </tr>
                              </thead>
                              <tbody>                             
                                <?php foreach ($faturamento as $k => $v) : ?>
                                  <tr>
                                    <td class="width:10%"><?= strtoupper($v['ano']); ?></td>
                                    <td class="width:10%"><?= strtoupper($v['mes']); ?></td>
                                    <td>R$ <?= number_format($v['valor'], 2, ',', '.'); ?></td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                              <?php if ($totalFaturamento['total'] !== NULL) : ?>
                                <tfoot>
                                  <tr>
                                    <td colspan="2"><strong>TOTAL</strong></td>
                                    <td class="bg-warning">
                                      <strong>
                                        R$ <?= number_format($totalFaturamento['total'], 2, ',', '.'); ?>
                                      </strong>
                                    </td>
                                  </tr>
                                </tfoot>
                              <?php endif; ?>
                            </table>
                          <?php endif; ?>
                          <a href="<?= base_url('clientes/ver/') . $id_cliente?>" class="btn btn-danger">VOLTAR</a>
                      </div><!-- /.box-body -->
                  </div><!-- /.box -->
              </div><!-- col-md-12 -->
          </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <script type="text/javascript">
      var base_url = "<?= base_url(); ?>";

      //=======================ATIVAR O MENU ===========================
  $(function() {
    var url = window.location.href;

    // Ativar o link diretamente acessado no menu
    $('ul.nav-sidebar a, ul.nav-treeview a').filter(function() {
        return this.href === url || url.startsWith(this.href);
      }).addClass('active')
      .closest('.nav-treeview') // Ativa o submenu se necessário
      .css({
        'display': 'block'
      })
      .addClass('menu-open')
      .prev('a') // Ativa o menu principal
      .addClass('active');
  });

$(document).ready(function() {
    $('#area-impressao').DataTable({
        dom: 'Bfrtip',
        paging: false,
        searching: false,
        ordering: false,
        info: false,
        language: { url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json' },
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Relatorio_Faturamento - <?= addslashes($dados_cliente["razao"]) ?>',
                footer: true
            },
            {
                extend: 'pdfHtml5',
                title: 'Relatorio_Faturamento - <?= addslashes($dados_cliente["razao"]) ?>',
                footer: true
            },
            {
                extend: 'print',
                title: 'Relatório de Faturamento - <?= addslashes($dados_cliente["razao"]) ?>',
                footer: true
            }
        ]
    });
});
</script>
