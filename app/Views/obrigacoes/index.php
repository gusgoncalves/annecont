  <?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Obrigações
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTA DE OBRIGAÇÕES</h5>
          </div>
          <div class="card-body">
            <?php if(hasPermission('criarObrigacao')): ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVA OBRIGAÇÃO</button>
              <br />
            <?php endif; ?>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>DESCRIÇÃO</th>
                <th>VALOR</th>
                <th>DATA INÍCIO</th>
                <th>DATA FIM</th>
                <th>STATUS</th>
                <?php if(hasAnyPermission(['modificarObrigacao','apagarObrigacao'])): ?>
                <th class="col-2">AÇÕES</th>
                <?php endif; ?>
              </tr>
              </thead>
              <tbody>
              <!-- AQUI DENTRO VAI O CONTEÚDO DA DATATABLE -->
              </tbody>
            </table>
          </div><!-- /.card body-->
        </div><!-- card -->
      </div><!-- col-md-12 -->
    </div><!-- row -->
  </section><!-- /.content -->

  <?php if(hasPermission('criarObrigacao')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center">NOVA OBRIGAÇÃO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?=site_url('obrigacoes/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="obrigacao_descricao">DESCRIÇÃO</label>
                    <input type="text" class="form-control" id="obrigacao_descricao" name="obrigacao_descricao" placeholder="Descrição da Obrigação" autocomplete="off" required>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="valor">VALOR</label>
                    <input type="number" min="0.00" step="0.01" class="form-control" id="valor" name="valor" placeholder="valor" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dt_inicio">DATA INÍCIO</label>
                    <input type="date" class="form-control" id="dt_inicio" name="dt_inicio">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dt_fim">DATA FIM</label>
                    <input type="date" class="form-control" id="dt_fim" name="dt_fim">
                  </div>
                </div>
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

  <?php if(hasPermission('modificarObrigacao')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center">EDITAR OBRIGAÇÃO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?=site_url('obrigacoes/edit') ?>" method="post" id="updateForm">
            <div class="modal-body">
              <div id="messages"></div>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="edit_obrigacao_descricao">DESCRIÇÃO</label>
                    <input type="text" class="form-control" id="edit_obrigacao_descricao" name="edit_obrigacao_descricao" placeholder="Descrição da Obrigação" autocomplete="off" required>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="edit_valor">VALOR</label>
                    <input type="number" min="0.00" step="0.01" class="form-control" id="edit_valor" name="edit_valor" placeholder="edit_valor" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_dt_inicio">DATA INÍCIO</label>
                    <input type="date" class="form-control" id="edit_dt_inicio" name="edit_dt_inicio">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_dt_fim">DATA FIM</label>
                    <input type="date" class="form-control" id="edit_dt_fim" name="edit_dt_fim">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="edit_obrigacao_ativo">ATIVO</label>
                <select class="form-control" id="edit_obrigacao_ativo" name="edit_obrigacao_ativo">
                  <option value="1">ATIVO</option>
                  <option value="0">INATIVO</option>
                </select>
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

  <?php if(hasPermission('apagarObrigacao')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title text-center">REMOVER OBRIGACAO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?= site_url('obrigacoes/delete') ?>" method="post" id="removeForm">
            <div class="modal-body">
              <p>Tem certeza que deseja remover essa obrigação?</p>
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
      ajax: base_url + 'obrigacoes/busca/',
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
        { data: 'descricao'},
        { data: 'valor' },
        { data: 'dt_inicio' },
        { data: 'dt_fim' },
        { data: 'ativo' },
        { data: 'acoes' },
      ],
      columnDefs: [
        {
          targets: 5,
          width: "1%",
          className: "text-center text-nowrap"
        }
      ]
    });
    //========================================ENVIA DADOS DE CRIAR FORM===================================
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
    //===============LIMPA O MODAL ===============================
    $('#addModal').on('hidden.bs.modal', function () 
    {
      $('#createForm')[0].reset();
      $('#createForm').removeClass('was-validated');
    });
    //===================================FUNÇÃO DE EDITAR ============================================
    function editObrigacao(id) {
      $.ajax({
        url: base_url + 'obrigacoes/getById/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          $("#edit_obrigacao_descricao").val(response.data.descricao);
          $("#edit_valor").val(response.data.valor);
          $("#edit_dt_inicio").val(response.data.dt_inicio);
          $("#edit_dt_fim").val(response.data.dt_fim);
          $("#edit_obrigacao_ativo").val(response.data.ativo);
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
                  showToast('Erro ao atualizar tipo de certidão.', 'error');
                }
              });
              return false;
            });
        },
        error: function() {

          showToast('Erro ao buscar tipo de certidão.', 'error');
        }
      });
    }
    //================================FUNÇÃO REMOVER ===========================================================
    //================================FUNÇÃO REMOVER ===========================================================
  function removeObrigacao(id) {
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
					showToast('Erro ao remover a obrigação.', 'error');
				}
			});
		});
	}
  </script>
<?= $this->endSection() ?>