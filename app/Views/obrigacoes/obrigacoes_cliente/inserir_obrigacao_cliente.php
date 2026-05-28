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
            <input
              type="hidden"
              class="form-control"
              id="id_cliente"
              name="id_cliente"
              value="<?= $id_cliente; ?>">
            <div class="form-group">
              <label for="id_obrigacao">OBRIGAÇÕES</label>
              <select
                class="form-control"
                id="id_obrigacao"
                name="id_obrigacao[]"
                multiple="multiple"
                required>
                <?php foreach ($obrigacao as $o): ?>
                  <option value="<?= $o['id'] ?>">
                    <?= $o['descricao'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">
                Selecione ao menos uma obrigação.
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">
              SALVAR
            </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              FECHAR
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- =================================================================================== -->
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

</script>
