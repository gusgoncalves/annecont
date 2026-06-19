<?php /** @var array $cliente */ ?>
<?php if(hasPermission('criarCliente')): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="addModalInfo">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">CADASTRO DE INFORMAÇÕES</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('clientes/addInfo') ?>" class="requires-validation" method="post" id="createFormInfo" novalidate>
          <div class="modal-body">
            <input type="hidden" name="id_cliente" value="<?= $cliente['id']; ?>">
            <div class="form-group">
              <label for="descricao">DESCRIÇÃO</label>
              <textarea class="form-control" id="descricao_info" name="descricao_info" rows="5" placeholder="Descreva o atendimento"></textarea>
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
<!-- ====================================================================================== -->
<?php if(hasPermission('apagarCliente')): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModalInfo">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title text-center">APAGAR INFORMAÇÕES</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?=site_url('clientes/deleteInfo') ?>" method="post" id="removeFormInfo">
          <div class="modal-body">
            <input type="hidden" name="id_cliente" id="id_cliente"> <!-- Campo oculto para ID do Cliente -->
            <input type="hidden" name="id_info" id="id_info"> <!-- Campo oculto para ID do Certificado -->
            <p>Tem certeza que deseja remover essa informação?</p>
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
<!-- =========================================================================================== -->
<script type="text/javascript">
    var base_url = "<?= base_url(); ?>";

     //=========ENVIA DADOS DE CRIAR FORM==================
  $('#createFormInfo').unbind('submit').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  $("#addModalInfo").modal('hide');
                  $('#createFormInfo')[0].reset();
                  $('#addModalInfo').one('hidden.bs.modal', function () {
                    reloadTab('#tab-info');
                  });
                  showToast(response.messages, 'success');
                  // Redirecionar corretamente
              } else {
                  showToast(response.messages, 'error');
              }
          }
      });
  });
  $('#addModalInfo').on('hidden.bs.modal', function () {
      // limpa formulário
      $('#createFormInfo')[0].reset();
      // limpa select2
      $('#id_cliente').val('').trigger('change');
      // remove validação bootstrap
      $('#createFormInfo').removeClass('was-validated');
      // reseta visual dos campos
  });
  //================================FUNÇÃO REMOVER ===========================================================
  function removeInfo(id) 
  {
		$('#removeModalInfo').modal('show');
		// remove submits antigos
		$('#removeFormInfo').off('submit');
		// novo submit
		$('#removeFormInfo').on('submit', function(e) {
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
						$('#removeModalInfo').modal('hide');
						$('#removeFormInfo')[0].reset();
						$('#removeModalInfo').one('hidden.bs.modal', function () {
              reloadTab('#tab-info');
            });
						showToast(response.messages, 'success');
					} else {
						showToast(response.messages, 'error');
					}
				},
				error: function() {
					showToast('Erro ao remover a informação.', 'error');
				}
			});
		});
	}
</script>