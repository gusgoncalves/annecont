<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Cidades
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTA DE CIDADES</h5>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <?php if(hasPermission('criarCidade')): ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVA CIDADE</button>
            <?php endif; ?>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>NOME</th>
                <th>SIGLA</th>
                <?php if(hasAnyPermission(['modificarCidade', 'apagarCidade'])): ?>
                <th class="text-center text-nowrap">AÇÕES</th>
                <?php endif; ?>
              </tr>
              </thead>
              <tbody>
              <!-- AQUI DENTRO VAI O CONTEÚDO DA DATATABLE -->
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- col-md-12 -->
    </div><!-- /.row -->
  </section><!-- /.content -->
  <?= $this->include('modal/modal_cidade') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= base_url(); ?>";
    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $('#manageTable').DataTable({
      ajax: base_url + '/cidades/busca/',//MONTA A DATA TABLE
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
        { data: 'nome_cidade' },
        { data: 'UF' },
        { data: 'acoes' },
      ],
      columnDefs: [
        {
          targets: [1,2],
          width: "10%",
          className: "text-center text-nowrap"
        }
      ]
    });
  </script>
<?= $this->endSection() ?>