<?php 
  /** @var array $obrigacoescli */
  /** @var array $obrigacoes_feito */
  /** @var int $id_cliente */
?>
<?php 
  echo "Aqui verifica se tem no cliente <br>";
  echo "<pre>";
  print_r($obrigacoescli);
  echo "</pre>";
  echo "<br>";
  echo "Aqui verifica se tem no realizada <br>";
  echo "<pre>";
  print_r($obrigacoes_feito);
  echo "</pre>";
?>
  <?php if(hasPermission('criarObrigacao')): ?>
      <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#addModalObrigacaoCliente"><i class="fas fa-plus-square"></i> INSERIR OBRIGAÇÕES</button>
  <?php endif; ?>
  <?php if(hasPermission('modificarObrigacao')): ?>
    <a href="<?= site_url('obrigacoes_cliente/remover/'.$id_cliente) ?>" class="btn btn-lg btn-danger btn-block"><i class="fas fa-minus-square"></i> REMOVER OBRIGAÇÕES</a>
  <?php endif; ?>
<div id="obrigacoes">
  <table class="table table-striped table-bordered">
    <th style="text-align:center;">TAREFA</th>
    <th style="text-align:center;">AÇÃO</th>                        
    <?php if (!empty($obrigacoes_cobrada['id_cliente']) && $obrigacoes_cobrada['id_cliente'] = $id_cliente){?>
      <tr class="success">                          
        <td colspan="2" width="50%" style="text-align:center;">OBRIGAÇOES PARA PROCESSO DE COBRANÇA</td>
      </tr>
    <?php }else { ?>
      <?php foreach($obrigacoescli as $k ) : ?>
        <!-- ============= SE A OBRIGAÇÃO ESTIVER COM O STATUS FEITO NO BANCO COM NUMERO 2 -->
        <?php if($k['feito']==2){ ?>
          <tr class="success">                          
            <td width="50%" style="text-align:center;text-decoration: line-through;"><?= $k['descricao'];?></td>
            <td width="40%" style="text-align:center;text-decoration: line-through;">Feito em <?= date('d/m/Y',strtotime($k['dt_ultimo']));?></td>
          </tr> 
        <?php }else{ ?>
          <!-- =================== SE NÃO ESTIVER FEITO MOSTRA APENAS AS OBRIGAÇÕES E O BOTÃO -->
          <tr>
            <td style="text-align:center"><?= $k['descricao'];?></td>
            <td style="text-align:center"><button type="button" class="btn btn-success" onclick="obrigacaoFunc(<?=$k['id_obrigacao'];?>,<?=$k['id_cliente'];?>)" data-toggle="modal" title="Realizar essa Obrigação" data-target="#feitoModal"><i class="fa fa-check"></i></button></td>
          </tr>
        <?php } ?>
      <?php endforeach ; ?>
    <?php } ?>
  </table>
  <?php if(!empty($k['dt_ultimo'])){ ?>
    <h3>Finalizado em: <?= date('d/m/Y',strtotime($k['dt_ultimo']));?></h3>
    <?php } ?>
  <!-- ==================VERIFICA SE O CLIENTE NÃO ESTÁ EM PROCESSO DE FINALIZAÇÃO=================== -->
    <a href="<?php echo base_url('clientes/cobrar/'.$id_cliente) ?>" class="btn btn-success"><i class="fas fa-plus-money"></i> COBRAR</a>
  
</div>
<div id="acoes">
  <br>
  
</div>
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
