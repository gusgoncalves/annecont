<?php if (hasPermission('criarTipoCertidao')): ?>
	<div class="modal fade" role="dialog" id="addModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h4 class="modal-title text-center">NOVO TIPO DE CERTIDÃO</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form role="form" action="<?= site_url('tipo_certidao/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
					<div class="modal-body">
						<div class="form-group">
							<label for="tipo_certidao_nome">NOME</label>
							<input type="text" class="form-control" id="tipo_certidao_nome" name="tipo_certidao_nome" placeholder="Digite o nome do tipo" autocomplete="off" required>
							<div class="invalid-feedback">Preenchimento Obrigatório!</div>
						</div>
						<div class="form-group">
							<label for="tipo_certidao_descricao">DESCRIÇÃO</label>
							<input type="text" class="form-control" id="tipo_certidao_descricao" name="tipo_certidao_descricao" placeholder="Digite alguma informação" autocomplete="off">
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

<?php if (hasPermission('modificarTipoCertidao')): ?>
	<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h4 class="modal-title text-center">ALTERAR TIPO DE CERTIDÃO</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form role="form" action="<?= site_url('tipo_certidao/edit') ?>" method="post" id="updateForm">
					<div class="modal-body">
						<div id="messages"></div>
						<div class="form-group">
							<label for="edit_tipo_certidao_nome">NOME</label>
							<input type="text" class="form-control" id="edit_tipo_certidao_nome" name="edit_tipo_certidao_nome" placeholder="Digite o nome" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="edit_tipo_certidao_descricao">DESCRIÇÃO</label>
							<input type="text" class="form-control" id="edit_tipo_certidao_descricao" name="edit_tipo_certidao_descricao" placeholder="Digite alguma informação" autocomplete="off">
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

<?php if (hasPermission('apagarTipoCertidao')): ?>
	<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title text-center">APAGAR TIPO DE CERTIDÃO</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form role="form" action="<?= site_url('tipo_certidao/delete') ?>" method="post" id="removeForm">
					<div class="modal-body">
						<p>Tem certeza que deseja remover o tipo de certidão?</p>
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
<script>
  var manageTable;
  var base_url = "<?= base_url(); ?>";
      //========================================ENVIA DADOS DE CRIAR FORM===================================
		$('#createForm').unbind('submit').on('submit', function(e) 
		{
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
		function editTipoCertidao(id) 
		{
			$.ajax({
				url: base_url + 'tipo_certidao/getById/' + id,
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					$("#edit_tipo_certidao_nome").val(response.data.nome);
					$("#edit_tipo_certidao_descricao").val(response.data.descricao);
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
		function removeTipoCertidao(id) 
		{
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
						showToast('Erro ao remover o tipo de certidão.', 'error');
					}
				});
			});
		}
</script>