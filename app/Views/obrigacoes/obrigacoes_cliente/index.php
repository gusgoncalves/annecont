<?php 
  /** @var array $obrigacoescli */
  /** @var int $id_cliente */
  /** @var array $combo_obrigacoes*/
?>
  <div class="row mb-3">
    <?php if(hasPermission('criarObrigacao')): ?>
      <div class="col-md-6">
        <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#addModalObrigacaoCliente"><i class="fas fa-plus-square"></i> INSERIR NA FICHA</button>
      </div>
    <?php endif; ?>
    <?php if(count($obrigacoescli) > 0): ?>

      <?php if(hasPermission('modificarObrigacao')): ?>
        <div class="col-md-6">
          <a href="<?= site_url('obrigacoes_cliente/remover/'.$id_cliente) ?>" class="btn btn-lg btn-danger btn-block"><i class="fas fa-minus-square"></i> REMOVER DA FICHA</a>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <br>
  <div id="obrigacoes">
    <table class="table table-striped table-bordered">
      <thead class="bg-primary text-white">
        <tr>
          <th style="text-align:center;">TAREFA</th>
          <th style="text-align:center;">AÇÃO</th>
        </tr>                        
      </thead>
      <tbody>
        <?php foreach($obrigacoescli as $k ) : ?>
          <tr>
            <td style="text-align:center"><?= $k['descricao'];?></td>
            <td style="text-align:center"><button type="button" class="btn btn-success" onclick="obrigacaoFunc(<?=$k['id_obrigacao'];?>,<?=$k['id_cliente'];?>)" data-toggle="modal" title="Realizar essa Obrigação" data-target="#feitoModal"><i class="fa fa-check"></i></button></td>
          </tr>
        <?php endforeach ; ?>
      </tbody>
    </table>
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
          <form role="form" action="<?php echo base_url('clientes/obrigacoesFeito') ?>" method="post" id="obrigacoesForm">
            <div class="modal-body">
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
  <!-- =================================================================================== -->
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