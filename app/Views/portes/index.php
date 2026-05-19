<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
Portes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header"></section>
<section class="content">
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="card">
        <div class="card-header bg-primary">
          <h5 class="text-center">LISTA DE PORTE </h5>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
          <?php if (hasPermission('modificarEmpresa')): ?>
            <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVO PORTE</button>
            <br />
          <?php endif; ?>
          <table id="manageTable" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>DESCRIÇÃO</th>
                <?php if (hasPermission('modificarEmpresa')): ?>
                  <th class="col-2">AÇÕES</th>
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
<!-- ======================== CRIANDO MODAL DE ADICIONAR PORTE ============================-->
<?php if (hasPermission('modificarEmpresa')): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">NOVO PORTE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('portes/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
          <div class="modal-body">
            <div class="form-group">
              <label for="descricao">DECRICAO</label>
              <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Porte da Empresa" autocomplete="off" required>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">SALVAR</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
<!-- ======================== CRIANDO MODAL DE EDIÇÃO DE CIDADE ============================-->
<?php if (hasPermission('modificarEmpresa')): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">EDITAR PORTE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('portes/edit') ?>" method="post" id="updateForm">
          <div class="modal-body">
            <div id="messages"></div>
            <div class="form-group">
              <label for="edit_descricao">DESCRIÇÃO</label>
              <input type="text" class="form-control" id="edit_descricao" name="edit_descricao" autocomplete="off">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">SALVAR</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
<!-- ======================== CRIANDO MODAL DE APAGAR CIDADE ============================-->
<?php if (hasPermission('modificarEmpresa')): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title text-center">REMOVER PORTE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('portes/delete') ?>" method="post" id="removeForm">
          <div class="modal-body">
            <p>Tem certeza que deseja remover esse porte?</p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">SIM</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript">
  var manageTable;
  var base_url = "<?= base_url(); ?>";

  // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
  manageTable = $('#manageTable').DataTable({
    ajax: base_url + 'portes/busca/', //MONTA A DATA TABLE
    responsive: true,
    autoWidth: false,
    paging: false, //tira a paginação
    searching: true, //tira o input de pesquisa
    ordering: false, //tira a opção de ordenar
    info: false,
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
    },
    columns: [{
        data: 'descricao'
      },
      {
        data: 'acoes'
      },
    ]
  });
  //=========ENVIA DADOS DE CRIAR FORM==================
  $('#createForm').unbind('submit').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(),
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          $("#addModal").modal('hide');
          $('#createForm')[0].reset();
          manageTable.ajax.reload(null, false);
          showToast(response.messages, 'success');
          // Redirecionar corretamente
        } else {
          showToast(response.messages, 'error');
        }
      }
    });
  });
  $('#addModal').on('hidden.bs.modal', function() {
    // limpa formulário
    $('#createForm')[0].reset();

    // remove validação bootstrap
    $('#createForm').removeClass('was-validated');
    // reseta visual dos campos
  });
  //===================================FUNÇÃO DE EDITAR ============================================
  function editPorte(id) {
    $.ajax({
      url: base_url + 'portes/getById/' + id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        console.log(response);
        // pega os dados corretos
        let data = response.data;
        // preenche campos
        $("#edit_descricao").val(data.descricao);

        // abre modal
        $("#editModal").modal('show');
        // submit update
        $("#updateForm")
          .off('submit')
          .on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
              url: form.attr('action') + '/' + id,
              type: form.attr('method'),
              data: form.serialize(),
              dataType: 'json',
              success: function(response) {
                if (response.success) {
                  $("#editModal").modal('hide');
                  $("#updateForm")[0].reset();
                  manageTable.ajax.reload(null, false);
                  showToast(response.messages, 'success');
                } else {
                  showToast(response.messages, 'error');
                }
              },
              error: function() {
                showToast('Erro ao atualizar porte.', 'error');
              }
            });
            return false;
          });
      },
      error: function() {
        showToast('Erro ao buscar porte.', 'error');
      }
    });
  }
  //================================FUNÇÃO REMOVER ===========================================================
  function removePorte(id) {
    $('#removeModal').modal('show');
    // remove submits antigos
    $('#removeForm').off('submit');
    // novo submit
    $('#removeForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            $('#removeModal').modal('hide');
            $('#removeForm')[0].reset();
            manageTable.ajax.reload(null, false);
            showToast(response.messages, 'success');
          } else {
            showToast(response.messages, 'error');
          }
        },
        error: function() {
          showToast('Erro ao remover o porte.', 'error');
        }
      });
    });
  }
</script>
<?= $this->endSection() ?>