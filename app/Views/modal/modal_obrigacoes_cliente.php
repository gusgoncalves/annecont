<?php 
  /** @var array $obrigacoescli */
  /** @var int $id_cliente */
  /** @var array $combo_obrigacoes*/
  /** @var float $valorTotal*/
?>
<?php if (hasPermission('criarObrigacao')): ?>
    <!-- =============================== MODAL NOVA OBRIGAÇÃO =============================== -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addModalObrigacaoCliente">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center">INSERIR OBRIGAÇÕES</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form role="form" action="<?= site_url('obrigacoes_cliente/create') ?>" method="post" id="createFormObrigacaoCliente">
            <div class="modal-body">
              <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?= $id_cliente; ?>">
              <div class="form-group">
                <label for="id_obrigacao">OBRIGAÇÕES</label>
                <select class="form-control" id="id_obrigacao" name="id_obrigacao[]" multiple="multiple" required>
                  <?php foreach ($combo_obrigacoes as $o): ?>
                    <option value="<?= $o['id'] ?>">
                      <?= $o['descricao'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"> Selecione ao menos uma obrigação.</div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">SALVAR</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>
    <!-- ===============================MODAL OBRIGAÇÕES FEITAS =================================-->
    <div class="modal fade" tabindex="-1" role="dialog" id="feitoModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">EXECUTAR TAREFA</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?= site_url('obrigacoes_cliente/feito') ?>" method="post" id="obrigacoesForm">
            <div class="modal-body">
                <input type="hidden" name="id" id="id_obr">
                <input type="hidden" name="cliente" id="id_cli">
              <p><b>Tem certeza que deseja realizar esta tarefa?</b></p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">SIM</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   <!-- ===============================MODAL DESFEITO =================================-->
    <div class="modal fade" tabindex="-1" role="dialog" id="desfeitoModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h4 class="modal-title">REFAZER TAREFA</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?= site_url('obrigacoes_cliente/desfeito') ?>" method="post" id="desfeitoForm">
            <div class="modal-body">
                <input type="hidden" name="id_obriga" id="id_obriga">
                <input type="hidden" name="id_clien" id="id_clien">
              <p><b>Tem certeza que deseja refazer esta tarefa?</b></p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">SIM</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--===================MODAL RECEBER ====================== -->
    <?php if (hasPermission('criarReceber')) : ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="addModalCobranca">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">NOVO CRÉDITO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('receber/create') ?>" method="post" class="requires-validation" id="createFormCobranca" novalidate>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?= $id_cliente; ?>">
            </div>
            <div class="form-group">
              <label for="nome">IDENTIFICAÇÃO DA CONTA</label>
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Identificação da conta" required>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="dt_recebimento">DATA RECEBIMENTO</label>
                  <input type="date" class="form-control" id="dt_recebimento" name="dt_recebimento" placeholder="Data da recebimento" value="<?= date('Y-m-d') ?>" required>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="valor">VALOR DA CONTA</label>
                  <input type="number" min="0.00" step="0.01" class="form-control" id="valor" name="valor" value="<?= $valorTotal ?>" required autocomplete="OFF">
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                </div>
              </div>
            </div>
          </div><!-- END modal body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">SALVAR</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
          </div><!--end modal footer -->
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /. end modal -->
<?php endif; ?>
  <script type="text/javascript">
    var base_url = "<?= base_url(); ?>";
    //=================== SELECT2 =====================================
    $('#id_obrigacao').select2({
      width: '100%',
      dropdownParent: $('#addModalObrigacaoCliente'),
      theme: 'classic'
    });
    //=================== CREATE =====================================
    $('#createFormObrigacaoCliente').unbind('submit').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            $("#addModalObrigacaoCliente").modal('hide');
            $('#createFormObrigacaoCliente')[0].reset();
            $('#id_obrigacao').val(null).trigger('change');
            $('#addModalObrigacaoCliente').one('hidden.bs.modal', function () {
                reloadTab('#tab-obrigacoes');
            });
            showToast(response.messages, 'success');
          } else {
              showToast(response.messages, 'error');
          }
        },
        error: function() {
            showToast('Erro ao inserir obrigações.', 'error');
        }
      });
    });
    //=================== LIMPA MODAL =====================================
    $('#addModalObrigacaoCliente').on('hidden.bs.modal', function () {
        $('#createFormObrigacaoCliente')[0].reset();
        $('#id_obrigacao').val(null).trigger('change');
        $('#createFormObrigacaoCliente').removeClass('was-validated');
    });
    //=================== FEITO =====================================
    $('#feitoModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      $('#id_obr').val(button.data('id'));
      $('#id_cli').val(button.data('cliente'));
    });
    //================DESFEITO==============================
     $('#desfeitoModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      $('#id_obriga').val(button.data('id'));
      $('#id_clien').val(button.data('cliente'));
    });
    //=========ENVIA DADOS DE CRIAR FORM==================
  $('#createFormCobranca').unbind('submit').on('submit', function(e) 
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
          $("#addModalCobranca").modal('hide');
          $('#createFormCobranca')[0].reset();
          manageTable.ajax.reload(null, false);
          showToast(response.messages, 'success');
          // Redirecionar corretamente
        } else {
          showToast(response.messages, 'error');
        }
      }
    });
  });
  $('#addModalCobranca').on('hidden.bs.modal', function() {
    // limpa formulário
    $('#createFormCobranca')[0].reset();
    // remove validação bootstrap
    $('#createFormCobranca').removeClass('was-validated');
    // reseta visual dos campos
  });
</script>