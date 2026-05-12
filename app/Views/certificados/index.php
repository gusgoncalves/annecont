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
          <?php if (in_array('criarCertificado', $user_permission)): ?>
            <button class="btn btn-lg btn-warning mb-2" data-toggle="modal" data-target="#addModalCertificado"><i class="fas fa-plus-square"></i> NOVO CERTIFICADO</button>
            <br />
          <?php endif; ?>
          <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">LISTA DE CERTIFICADOS</h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="manageTable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>CLIENTE</th>
                    <th>DESCRIÇÃO</th>
                    <th>VALIDADE</th>
                    <th>SENHA</th>
                    <th>SITUAÇÃO</th>
                    <?php if (in_array('modificarCertificado', $user_permission) || in_array('apagarCertificado', $user_permission)): ?>
                      <th class="col-2">AÇÕES</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                  <!-- AQUI DENTRO VAI O CONTEÚDO DA DATATABLE -->
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </section> <!-- /.content -->
  </div><!-- /.content-wrapper -->


  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= base_url(); ?>";

    //=======================ATIVAR O MENU NOVO===========================
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

    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $('#manageTable').DataTable({
      'ajax': base_url + 'certificados/recebeDadosCertificado',
      'responsive': true,
      //lengthChange: true, //mostrar resultados por etapas
      'autoWidth': false,
      //'dom': 'Bfrtip',
      'paging': true, //tira a paginação
      'pageLength': 25, // Define para exibir 50 itens por página
      'searching': true, //tira o input de pesquisa
      'ordering': true, //tira a opção de ordenar
      'info': false,
      'language': {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
      },
      'buttons': ["print"] //"colvis" é uma opção para ver as colunas e escolher 
    });
  </script>