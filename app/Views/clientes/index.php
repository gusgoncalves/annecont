<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Clientes
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTA DE CLIENTES ATIVOS</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php if(hasPermission('criarCliente')): ?>
              <a href="<?php echo base_url('clientes/create') ?>" class="btn btn-lg btn-primary mb-2"><i class="fas fa-plus-square"></i> NOVO CLIENTE</a>
            <?php endif; ?>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th class="text-center">DEPENDENCIAS</th>
                <th>RAZÃO SOCIAL</th>
                <th>CNPJ / CPF</th>
                <th>WHATSAPP</th>
                <?php if(hasAnyPermission(['verCliente', 'modificarCliente', 'apagarCliente'])): ?>
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
    </div> <!-- /.row -->
  </section><!-- /.content -->
  <!-- ============================== CRIANDO MODAL DE APAGAR DE CLIENTE ==============================-->
  <?php if(hasPermission('apagarCliente')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title text-center">REMOVER CLIENTE</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
          </div>
          <form role="form" action="<?= base_url('clientes/delete') ?>" method="post" id="removeForm">
            <div class="modal-body">
              <p>Tem certeza que deseja mesmo remover o cliente selecionado?</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">SIM</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
            </div><!-- end Modal footer -->
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= site_url(); ?>";
      // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
      manageTable = $("#manageTable").DataTable({
        ajax: base_url + "clientes/busca/",
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
          { data: 'icone' },
          { data : 'razao',
            render: function (data, type, row) {
              if(row.ativo == 2) {
                return `${data} <span class="badge bg-danger ms-1">INATIVO</span>`;
              }
              return data;
            } 
          },
          { data: 'cnpj' },
          { data: 'whatsapp' },
          { data: 'acoes' }
        ],
        columnDefs: [
        {
          targets: [0,4],
          width: "5%",
          className: "text-center text-nowrap"
        }
      ],
        createdRow: function (row, data, dataIndex) {
          if (data.ativo == 2) {
            $(row).addClass('table-secondary');
          }
        }
      });
  </script>
<?= $this->endSection() ?>
