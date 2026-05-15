<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Certificados
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">LISTA DE CERTIFICADOS</h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <?php if (hasPermission('criarCertificado')): ?>
                <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModalCertificado"><i class="fas fa-plus-square"></i> NOVO CERTIFICADO</button>
              <?php endif; ?>
              <table id="manageTable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>CLIENTE</th>
                    <th>DESCRIÇÃO</th>
                    <th>VALIDADE</th>
                    <th>SENHA</th>
                    <th>SITUAÇÃO</th>
                    <?php if (hasAnyPermission(['modificarCertificado','apagarCertificado'])): ?>
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
  <?= $this->include('modal/modal_certificados') ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>

  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= base_url(); ?>";
    
    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $('#manageTable').DataTable({
      ajax: base_url + 'certificados/busca/',//MONTA A DATA TABLE
      responsive: true,
      autoWidth: false,
      paging: true,//tira a paginação
      searching: true, //tira o input de pesquisa
      ordering: false, //tira a opção de ordenar
      info: false,
      language: {url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',},
       columns: [
        { data: 'cliente',
          render: function (data, type, row) {
              return `<b>${data}</b>`;
            }
        },
        { data: 'descricao' },
        { data: 'dt_validade' },
        { data: 'senha' },
        { data: 'ativo' },
        { data: 'acoes' },
      ]
    });
  </script>
<?= $this->endSection() ?>