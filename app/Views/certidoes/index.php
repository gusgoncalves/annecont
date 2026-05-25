<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Certidões
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">LISTA DE CERTIDÕES</h5>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <?php if(hasPermission('criarCertidao')): ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModalCertidao"><i class="fas fa-plus-square"></i> NOVA CERTIDÃO</button>
              <br />
            <?php endif; ?>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>CLIENTE</th>
                  <th>CERTIDAO</th>
                  <th>EXPIRA</th>
                  <?php if(hasAnyPermission(['modificarCertidao','apagarCertidao'])): ?>
                  <th class="col-2">AÇÕES</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <!-- AQUI DENTRO VAI O CONTEÚDO DA DATATABLE -->
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </section>    <!-- /.content -->
  <?= $this->include('modal/modal_certidoes') ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= base_url(); ?>";

    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $('#manageTable').DataTable({
      ajax: base_url + 'certidoes/busca/',//MONTA A DATA TABLE
      responsive: true,
      autoWidth: false,
      deferRender: true,
      processing: true,
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
        { data: 'tipo' },
        { data: 'dt_expira' },
        { data: 'acoes' },
      ],
      columnDefs: [
        {
          targets: 3,
          width: "1%",
          className: "text-center text-nowrap"
        }
      ]
    });
  </script>
<?= $this->endSection() ?>