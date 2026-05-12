<style>
  /*Estilizador da tab para ficar grande na tela */
  .nav-tabs .nav-item {
    flex: 1;
    text-align: center;
  }

  .tab-content {
    margin-top: 20px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="messages"></div>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <?php if (in_array('criarReceber', $user_permission)) : ?>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-lg btn-warning mb-2" data-toggle="modal" data-target="#addModalReceber"><i class="fas fa-plus-square"></i> NOVA ENTRADA</button>
            </div>
          </div>
        <?php endif; ?>
        <br>
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">CONTAS A RECEBER</h5>
          </div>
          <!-- /.card-header -->
        </div><!-- /.card-header --></br>
        <!-- ======================================NOVO =============================================== -->
        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="contasReceber" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="receber-tab" data-toggle="pill" href="#receber" role="tab" aria-controls="receber" aria-selected="true"><span class="font-weight-bold">PARA RECEBER</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="recebido-tab" data-toggle="pill" href="#recebido" role="tab" aria-controls="recebido" aria-selected="false"><span class="font-weight-bold">RECEBIDO</span></a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="contasReceberContent">
                  <div class="tab-pane fade show active" id="receber" role="tabpanel" aria-labelledby="receber-tab">
                    <table id="manageTableNaoQuitado" class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>DATA</th>
                          <th>CLIENTE</th>
                          <th>DESCRICAO</th>
                          <th>VALOR</th>
                          <th>SITUAÇÃO</th>
                          <?php if (in_array('modificarReceber', $user_permission) || in_array('apagarReceber', $user_permission)) : ?>
                            <th class="col-2">AÇOES</th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="recebido" role="tabpanel" aria-labelledby="recebido-tab">
                    <table id="manageTableQuitado" class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>VENCIMENTO</th>
                          <th>CLIENTE</th>
                          <th>DESCRICAO</th>
                          <th>PAGAMENTO</th>
                          <th>CONTA</th>
                          <th>PAGO</th>
                          <th>BANCO</th>
                          <th>SITUAÇÃO</th>
                          <?php if (in_array('modificarReceber', $user_permission) || in_array('apagarReceber', $user_permission)) : ?>
                            <th class="col-2">AÇOES</th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div><!-- /.card -->
            </div>
          </div>
        </div>
        <!-- =================================================NOVO =================================== -->
      </div><!-- /.card -->
    </div><!-- col-md-12 -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">
  var manageTableNaoQuitado;
  var manageTableQuitado;
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
  // ===============================DATA TABLE COM RESPOSNIVE E FUNÇÕES ======================
  manageTableNaoQuitado = $("#manageTableNaoQuitado").DataTable({
    'ajax': base_url + "financeiro/buscaDadosReceberNaoQuitado",
    'responsive': true,
    //lengthChange: true, //mostrar resultados por etapas
    'autoWidth': false,
    //'dom': 'Bfrtip',
    'paging': true, //tira a paginação
    'searching': true, //tira o input de pesquisa
    'ordering': false, //tira a opção de ordenar
    'info': false,
    'language': {
        url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
      },
    'buttons': ["print"],
  });
  // ===============================DATA TABLE COM RESPOSNIVE E FUNÇÕES ======================
  manageTableQuitado = $("#manageTableQuitado").DataTable({
    'ajax': base_url + "financeiro/buscaDadosReceberQuitado",
    'responsive': true,
    //lengthChange: true, //mostrar resultados por etapas
    'autoWidth': false,
    //'dom': 'Bfrtip',
    'paging': true, //tira a paginação
    'searching': true, //tira o input de pesquisa
    'ordering': false, //tira a opção de ordenar
    'info': false,
    'language': {
        url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
      },
    'buttons': ["print"] //"colvis" é uma opção para ver as colunas e escolher 
  }); 
  
</script>