 <?php if(hasPermission('criarTipoConta')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center">TIPO DE PAGAMENTO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?= site_url('tipo_conta/create') ?>" method="post" class="requires-validation" id="createForm" novalidate>
            <div class="modal-body">
              <div class="form-group">
                <label for="nome">NOME</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do tipo da conta" autocomplete="off" required>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              </div>
              <div class="form-group">
                <label for="tipo">CATEGORIA</label>&nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tipo" id="pagar" value="0">&nbsp;&nbsp;&nbsp;
                      PAGAR
                  </label class="form-check-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tipo" id="receber" value="1">&nbsp;&nbsp;&nbsp;
                      RECEBER
                  </label>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
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
  
  <?php if(hasPermission('modificarTipoConta')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center">EDITAR CATEGORIA</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?= site_url('tipo_conta/edit') ?>" method="post" class="requires-validation" id="updateForm" novalidate>
            <div class="modal-body">
              <div class="form-group">
                <label for="edit_nome">NOME</label>
                <input type="text" class="form-control" id="edit_nome" name="edit_nome" placeholder="Nome do tipo da conta" autocomplete="off" required>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              </div>
              <div class="form-group">
                <label for="gender">TIPO DA CATEGORIA</label>&nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="edit_tipo" id="edit_pagar" value="0">&nbsp;&nbsp;&nbsp;
                        PAGAR
                  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="edit_tipo" id="edit_receber" value="1">&nbsp;&nbsp;&nbsp;
                        RECEBER
                  </label>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                </div>
              </div><!--div dorm group --> 
            </div><!--Div modal body -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">SALVAR</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <?php endif; ?>

  <?php if(hasPermission('apagarTipoConta')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title text-center">REMOVER CATEGORIA</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?= site_url('tipo_conta/delete') ?>" method="post" id="removeForm">
            <div class="modal-body">
              <p>Tem certeza que deseja remover esta categoria?</p>
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
    var base_url = "<?= site_url(); ?>";

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
    $('#addModal').on('hidden.bs.modal', function () {
        // limpa formulário
        $('#createForm')[0].reset();
        // remove validação bootstrap
        $('#createForm').removeClass('was-validated');
        // reseta visual dos campos
    });
    //===================================FUNÇÃO DE EDITAR ============================================
    function editTipo(id) 
    {
      $.ajax({
      url: base_url + 'tipo_conta/getById/' + id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
          console.log(response);
          // pega os dados corretos
          let data = response.data;
          // preenche campos
          $("#edit_nome").val(data.nome);
          $('input[name="edit_tipo"][value="' + data.tipo + '"]').prop('checked', true);
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
                  showToast('Erro ao atualizar tipo de conta.', 'error');
              }
          });
          return false;
          });
      },
      error: function() {
          showToast('Erro ao buscar tipo de conta.', 'error');
      }
      });
    }
    //================================FUNÇÃO REMOVER ===========================================================
    function removeTipo(id) 
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
                    showToast('Erro ao remover a Tipo de Conta.', 'error');
                }
            });
        });
    } 
  </script>