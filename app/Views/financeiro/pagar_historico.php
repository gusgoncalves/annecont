<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
Histórico de contas
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">CONTAS PAGAS</h5>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-3">
                <label>Data Inicial</label>
                <input type="date" id="data_inicial" class="form-control">
              </div>
              <div class="col-md-3">
                <label>Data Final</label>
                <input type="date" id="data_final" class="form-control">
              </div>
              <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100" id="filtrar">
                  Filtrar
                </button>
              </div>
            </div>
            <div class="col-md-2 d-flex align-items-end"><label>Últimos 30 dias</label></div>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>DATA VENCIMENTO</th>
                  <th>DATA PAGAMENTO</th>
                  <th>DESCRICAO</th>
                  <th>TIPO</th>
                  <th>BANCO</th>
                  <th>VALOR</th>
                  <th>ACRÉSCIMO</th>
                  <th>DESCONTO</th> 
                  <th>TOTAL</th>
                  <?php if (hasAnyPermission(['modificarPagar', 'apagarPagar'])) : ?>
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
  <?= $this->include('modal/modal_pagar') ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= site_url(); ?>";

    //=================== SELECT 2 =====================================
    $('#tipo').select2({
      width: '100%',
      dropdownParent: $('#addModal')
    });
    $('#id_banco').select2({
      width: '100%',
      dropdownParent: $('#quitarModal'),
      theme: 'classic'
    });

    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $("#manageTable").DataTable({
      responsive: true,
      autoWidth: false,
      deferRender: true,
      processing: true,
      paging: true,//tira a paginação
      searching: true, //tira o input de pesquisa
      ordering: false, //tira a opção de ordenar
      info: false,
      language: {url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',},
      ajax: {
        url: base_url + "pagar/busca_historico",
        type: "POST",
        data: function(d) {
          d.data_inicial = $('#data_inicial').val();
          d.data_final   = $('#data_final').val();
        },
        dataSrc: 'data'
      },
      columns: [
        { data: 'dt_vencimento' },
        { data: 'dt_quitado' },
        { data: 'descricao' },
        { data: 'tipo' },
        { data: 'banco' },
        { data: 'valor_pagar' },
        { data: 'vl_acrescimo' },
        { data: 'vl_desconto' },
        { data: 'total' },
        { data: 'acoes' }
      ],
      columnDefs: [
        {
          targets: [0,1,4,5,6,7,8,9],
          width: "1%",
          className: "text-center text-nowrap"
        }
      ]
    });
    $('#filtrar').on('click', function() {
      let dataInicial = $('#data_inicial').val();
      let dataFinal   = $('#data_final').val();
      if (dataInicial == '' || dataFinal == '') {
        showToast('Selecione o período.', 'error');
        return;
      }
      manageTable.ajax.reload();
    });
  </script>
<?= $this->endSection() ?>