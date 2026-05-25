<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  TIPOS DE PAGAMENTO
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">TIPOS DE PAGAMENTO</h5>
          </div>
          <div class="card-body">
            <?php if(hasPermission('criarTipoConta')): ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVO TIPO DE CONTA</button>            
            <?php endif; ?>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>NOME</th>
                  <th>TIPO</th>
                  <?php if(hasAnyPermission(['modificarTipoConta','apagarTipoConta'])): ?>
                  <th class="col-2">AÇÕES</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- col-md-12 -->
    </div><!-- /.row -->
  </section>
  <?= $this->include('modal/modal_tipo_conta') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= site_url(); ?>";
    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $("#manageTable").DataTable({
      ajax: base_url + 'tipo_conta/busca',
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
        { data: 'nome' },
        { data: 'tipo' },
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