<?php /** @var array $clientes */
 /** @var array $tipos */ ?>
<!-- ===============================MODAL PARA NOVAS CERTIDÕES ===================== -->
<?php if (hasPermission('criarCertidao')): ?>
  <!-- create brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="addModalCertidao">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">NOVA CERTIDÃO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('certidoes/create') ?>" class="requires-validation" method="post" id="createFormCertidao" novalidate>
          <div class="modal-body">
            <div class="form-group">
              <label for="id_cliente">CLIENTE</label>
              <?php if (isset($cliente_data)): ?>
                <!-- Se já estiver na ficha do cliente, mostra um campo fixo -->
                <input type="text" class="form-control" value="<?= $cliente_data['razao']; ?>" readonly>
                <input type="hidden" name="id_cliente" value="<?= $cliente_data['id']; ?>">
              <?php else: ?>
                <!-- Se estiver na listagem geral, exibe o combo -->
                <select class="form-control" id="id_cliente" name="id_cliente" required>
                  <option value="">SELECIONE O CLIENTE</option>
                      <?php foreach ($clientes as $c): ?>
                          <option value="<?= $c['id'] ?>"><?= $c['razao'] ?></option>
                      <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="id_tipo_certidao">CERTIDÃO</label>
              <select class="form-control" id="id_tipo_certidao" name="id_tipo_certidao" required>
                <option value="">SELECIONE O TIPO</option>
                <?php foreach ($tipos as $t): ?>
                    <option value="<?= $t['id'] ?>"><?= $t['nome'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="form-group">
              <label for="certidao_descricao">DESCRIÇÃO</label>
              <input type="text" class="form-control" id="certidao_descricao" name="certidao_descricao" placeholder="Descreva a Certidão" autocomplete="off" required>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="form-group">
              <label for="certidao_expira">DATA QUE EXPIRA</label>
              <input type="date" class="form-control" id="certidao_expira" name="certidao_expira" autocomplete="off" required>
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
<!-- ======================================================================================== -->
<?php if (hasPermission('modificarCertidao')): ?>
  <!-- edit brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="editModalCertidao">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">ALTERAR CERTIDÕES</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= base_url('certidoes/edit') ?>" method="post" id="updateFormCertidao">
          <div class="modal-body">
            <div id="messages"></div>
            <div class="form-group">
              <?php if (isset($cliente_data)) : ?>
                <input type="hidden" name="id_cliente" value="<?php echo $cliente_data['id']; ?>">
              <?php endif; ?>
              <label for="edit_tipo_certidao">CERTIDÃO</label>
              <select class="form-control" id="edit_tipo_certidao" name="edit_tipo_certidao" required>
                 <option value="">SELECIONE O TIPO</option>
                <?php foreach ($tipos as $t): ?>
                    <option value="<?= $t['id'] ?>"><?= $t['nome'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="form-group">
              <label for="edit_certidao_descricao">DESCRIÇÃO DA CERTIDÃO</label>
              <input type="text" class="form-control" id="edit_certidao_descricao" name="edit_certidao_descricao" placeholder="Digite o nome da certidão" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="edit_certidao_expira">DATA QUE EXPIRA</label>
              <input type="date" class="form-control" id="edit_certidao_expira" name="edit_certidao_expira" autocomplete="off">
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
<!-- =================================================================================================================== -->
<?php if (hasPermission('apagarCertidao')): ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModalCertidao">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title text-center">APAGAR CERTIDÃO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('certidoes/delete') ?>" method="post" id="removeFormCertidao">
          <div class="modal-body">
            <input type="hidden" name="certidao_cliente_id" id="certidao_cliente_id"> <!-- Campo oculto para ID do Cliente -->
            <input type="hidden" name="certidao_id" id="certidao_id"> <!-- Campo oculto para ID do Certificado -->
            <p>Tem certeza que deseja remover a Certidão?</p>
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
<!-- ========================================================================================================================================= -->
<script type="text/javascript">
  var manageTable;
  var base_url = "<?= base_url(); ?>";

  //=================== SELECT 2 =====================================
  $('#id_cliente').select2({
    width: '100%',
    dropdownParent: $('#addModalCertidao')
  });
  $('#id_tipo_certidao').select2({
    width: '100%',
    dropdownParent: $('#addModalCertidao')
  });
  $('#edit_tipo_certidao').select2({
    width: '100%',
    dropdownParent: $('#editModalCertidao')
  });
  //=========ENVIA DADOS DE CRIAR FORM==================
  $('#createFormCertidao').unbind('submit').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  $("#addModalCertidao").modal('hide');
                  $('#createFormCertidao')[0].reset();
                  manageTable.ajax.reload(null, false);
                  showToast(response.messages, 'success');
                  // Redirecionar corretamente
              } else {
                  showToast(response.messages, 'error');
              }
          }
      });
  });
  $('#addModalCertidao').on('hidden.bs.modal', function () {
      // limpa formulário
      $('#createFormCertidao')[0].reset();
      // limpa select2
      $('#id_cliente').val('').trigger('change');
      // remove validação bootstrap
      $('#createFormCertidao').removeClass('was-validated');
      // reseta visual dos campos
  });
  //===================================FUNÇÃO DE EDITAR ============================================
  function editCertidao(id) 
  {
    $.ajax({
      url: base_url + 'certidoes/getById/' + id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        console.log(response);
        // pega os dados corretos
        let data = response.data;
        let descricao = data.descricao || '';
        // preenche campos
        $("#edit_tipo_certidao").val(data.id_tipo_certidao).trigger('change');
        $("#edit_certidao_descricao").val(data.descricao);
        $("#edit_certidao_expira").val(data.dt_expira);      
        // abre modal
        $("#editModalCertidao").modal('show');
        // submit update
        $("#updateFormCertidao")
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
                  $("#editModalCertidao").modal('hide');
                  $("#updateFormCertidao")[0].reset();
                  manageTable.ajax.reload(null, false);
                  showToast(response.messages, 'success');
              } else {
                  showToast(response.messages, 'error');
              }
            },
            error: function() {
                showToast('Erro ao atualizar certidao.', 'error');
            }
          });
          return false;
        });
      },
      error: function() {
          showToast('Erro ao buscar certidao.', 'error');
      }
    });
  }
  //================================FUNÇÃO REMOVER ===========================================================
  function removeCertidao(id) {
		$('#removeModalCertidao').modal('show');
		// remove submits antigos
		$('#removeFormCertidao').off('submit');
		// novo submit
		$('#removeFormCertidao').on('submit', function(e) {
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
						$('#removeModalCertidao').modal('hide');
						$('#removeFormCertidao')[0].reset();
						manageTable.ajax.reload(null, false);
						showToast(response.messages, 'success');
					} else {
						showToast(response.messages, 'error');
					}
				},
				error: function() {
					showToast('Erro ao remover a certidão.', 'error');
				}
			});
		});
	}
</script>