<?php
/** @var array $tipos */
/** @var array $bancos */
?>
<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
Contas a Receber
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">CONTAS A RECEBER</h5>
          </div>
          <div class="card-body">
            <?php if (hasPermission('criarReceber')) : ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVA COBRANÇA</button>
            <?php endif; ?>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>CLIENTE</th>
                  <th>DESCRICAO</th>
                  <th>VENCIMENTO</th>
                  <th>VALOR</th>
                  <th>SITUAÇÃO</th>
                  <?php if (hasAnyPermission(['modificarReceber', 'apagarReceber'])) : ?>
                    <th class="col-2">AÇOES</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div><!-- /.card -->
      </div><!-- div col -->
    </div><!-- div row -->
  </section>
<?= $this->include('modal/modal_receber') ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= site_url(); ?>";
    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $("#manageTable").DataTable({
      ajax: base_url + "receber/busca",
      responsive: true,
      autoWidth: false,
      deferRender: true,
      processing: true,
      paging: true,//tira a paginação
      searching: true, //tira o input de pesquisa
      ordering: false, //tira a opção de ordenar
      info: false,
      language: {url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',},
      rowCallback: function(row, data) {
        $(row).addClass(data.classe_linha);
      },
      columns: [
        { data: 'cliente',
          render: function (data, type, row) {
              return `<b>${data}</b>`;
            }
        },
        {data: 'descricao'},
        {data: 'vencimento'},
        { data : 'valor',
            render: function (data, type, row) {
              if (row.dt_estorno != null && row.dt_estorno != '') {
                return `${data} <span class="badge badge-primary ml-1">Houve Estorno</span>`;
              }
              return data;
            } 
          },
        {data: 'situacao'},
        {data: 'acoes'},
      ],
      columnDefs: [
        {
          targets: [2,3,4,5],
          width: "1%",
          className: "text-center text-nowrap"
        }
      ]    
    });
  </script>
<?= $this->endSection() ?>