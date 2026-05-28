<?php /** @var int $id_cliente */ ?>
<?php if(hasPermission('criarLogin')): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="addModalLogin">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">CADASTRO DE LOGINS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('logins/create') ?>" class="requires-validation" method="post" id="createFormLogin" novalidate>
          <div class="modal-body">
            <input type="hidden" name="id_cliente" value="<?= $id_cliente; ?>">
            <div class="form-group">
              <label for="descricao">DESCRIÇÃO</label>
              <input type="text" class="form-control" id="descricao_login" name="descricao_login" placeholder="Descrição do Login"  required>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="form-group">
              <label for="usuario">USUÁRIO</label>
              <input type="text" class="form-control" id="usuario_login" name="usuario_login" required>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="form-group">
              <label for="senha">SENHA</label>
              <input type="text" class="form-control" id="senha_login" name="senha_login" placeholder="Senha do Login">
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
<!-- =================================================================================== -->
<?php if(hasPermission('modificarLogin')): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="editModalLogin">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">ALTERAR LOGIN</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('logins/edit') ?>" method="post" id="updateFormLogin">
          <div class="modal-body">
            <div id="messages"></div>
            <div class="form-group">
              <input type="hidden" name="id_cliente" value="<?= $id_cliente; ?>">
              <label for="descricao">DESCRIÇÃO</label>
              <input type="text" class="form-control" id="edit_descricao_login" name="edit_descricao_login" placeholder="Descrição do Login" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="usuario">USUÁRIO</label>
              <input type="text" class="form-control" id="edit_usuario_login" name="edit_usuario_login" placeholder="Usuário do Login" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="senha">SENHA</label>
              <input type="text" class="form-control" id="edit_senha_login" name="edit_senha_login" placeholder="Senha do Login" autocomplete="off">
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
<?php if(hasPermission('apagarLogin')): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModalLogin">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title text-center">APAGAR LOGINS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?=site_url('logins/delete') ?>" method="post" id="removeFormLogin">
          <div class="modal-body">
            <input type="hidden" name="id_login_cliente" id="id_login_cliente"> <!-- Campo oculto para ID do Cliente -->
            <input type="hidden" name="id_login" id="id_login"> <!-- Campo oculto para ID do Certificado -->
            <p>Tem certeza que deseja remover o login?</p>
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
  $('#createFormLogin').unbind('submit').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  $("#addModalLogin").modal('hide');
                  $('#createFormLogin')[0].reset();
                  $('#addModalLogin').one('hidden.bs.modal', function () {
                    reloadTab('#tab-logins');
                  });
                  showToast(response.messages, 'success');
                  // Redirecionar corretamente
              } else {
                  showToast(response.messages, 'error');
              }
          }
      });
  });
  $('#addModalLogin').on('hidden.bs.modal', function () {
      // limpa formulário
      $('#createFormLogin')[0].reset();
      // limpa select2
      $('#id_cliente').val('').trigger('change');
      // remove validação bootstrap
      $('#createFormLogin').removeClass('was-validated');
      // reseta visual dos campos
  });
  //===================================FUNÇÃO DE EDITAR ============================================
  function editLogin(id) 
  {
    $.ajax({
      url: base_url + 'logins/getById/' + id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        // pega os dados corretos
        let data = response.data;
        let descricao = data.descricao || '';
        // preenche campos
        $("#edit_descricao_login").val(data.descricao);
        $("#edit_usuario_login").val(data.usuario);
        $("#edit_senha_login").val(data.senha);      
        // abre modal
        $("#editModalLogin").modal('show');
        // submit update
        $("#updateFormLogin")
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
                  $("#editModalLogin").modal('hide');
                  $("#updateFormLogin")[0].reset();
                  $('#editModalLogin').one('hidden.bs.modal', function () {
                    reloadTab('#tab-logins');
                  });
                  showToast(response.messages, 'success');
              } else {
                  showToast(response.messages, 'error');
              }
            },
            error: function() {
                showToast('Erro ao atualizar login.', 'error');
            }
          });
          return false;
        });
      },
      error: function() {
          showToast('Erro ao buscar login.', 'error');
      }
    });
  }
  //================================FUNÇÃO REMOVER ===========================================================
  function removeLogin(id) 
  {
		$('#removeModalLogin').modal('show');
		// remove submits antigos
		$('#removeFormLogin').off('submit');
		// novo submit
		$('#removeFormLogin').on('submit', function(e) {
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
						$('#removeModalLogin').modal('hide');
						$('#removeFormLogin')[0].reset();
						$('#removeModalLogin').one('hidden.bs.modal', function () {
              reloadTab('#tab-logins');
            });
						showToast(response.messages, 'success');
					} else {
						showToast(response.messages, 'error');
					}
				},
				error: function() {
					showToast('Erro ao remover o login.', 'error');
				}
			});
		});
	}
</script>