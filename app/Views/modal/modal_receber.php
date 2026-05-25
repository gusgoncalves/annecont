<?php /** @var array $clientes */
 /** @var array $bancos */ ?>
  <!-- ===============MODAL DE CRIAÇÃO DE RECEBER======================= -->
<?php if (hasPermission('criarReceber')) : ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">NOVO CRÉDITO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('receber/create') ?>" method="post" class="requires-validation" id="createForm" novalidate>
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
                    <?php foreach ($clientes as $c) : ?>
                        <option value="<?= $c['id'] ?>"><?= $c['razao'] ?></option>
                      <?php endforeach ?>
                  </select>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                <?php endif; ?>
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
                  <input type="date" class="form-control" id="dt_recebimento" name="dt_recebimento" placeholder="Data da recebimento" value="<?php echo date('Y-m-d') ?>" required>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="valor">VALOR DA CONTA</label>
                  <input type="number" min="0.00" step="0.01" class="form-control" id="valor" name="valor" placeholder="Valor" required autocomplete="OFF">
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
  <!-- ================== MODAL DE EDIÇÃO DE RECEBER ======================= -->
<?php if (hasPermission('modificarReceber')) : ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">EDITAR RECEBIMENTO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('receber/edit') ?>" class="requires-validation" method="post" id="updateForm" novalidate>
          <div class="modal-body">
            <div class="form-group">
              <?php if (isset($cliente_data)) : ?>
                <input type="hidden" name="id_cliente" value="<?= $cliente_data['id']; ?>">
              <?php endif; ?>
              <label for="editar_nome">IDENTIFICAÇÃO DA CONTA</label>
              <input type="text" class="form-control" id="editar_nome" name="editar_nome" placeholder="Identificação da conta" required>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="editar_dt_recebimento">DATA RECEBIMENTO</label>
                  <input type="date" class="form-control" id="editar_dt_recebimento" name="editar_dt_recebimento" placeholder="Data da entrada" required>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="editar_valor">VALOR DA CONTA</label>
                  <input type="number" min="0.00" step="0.01" class="form-control" id="editar_valor" name="editar_valor" placeholder="Valor da conta" required autocomplete="OFF">
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="receber_descricao">INFORMAÇÕES</label>
              <input type="text" class="form-control" id="receber_descricao" name="receber_descricao" placeholder="Descrição para cobrança">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">SALVAR</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
          </div><!-- end modal footer -->
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
  <!-- ================ QUITAR OS DADOS DE UMA CONTA A RECEBER =============================================== -->
<?php if (hasPermission('modificarReceber')) : ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="quitarModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title text-center">QUITAR CONTA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= site_url('receber/quitar') ?>" method="post" class="requires-validation" id="quitarForm" novalidate>
          <div class="modal-body">
            <p><b>Esse Movimento aparecerá no fluxo de caixa! </b></p>
            <p><h3 class="text-center bg-primary"><b> Valor da conta:  R$ <span id="valorSpan"></span></b></h3></p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dt_baixa">DATA DO PAGAMENTO</label>
                  <input type="date" class="form-control" id="dt_baixa" name="dt_baixa" required>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id_banco">BANCO A RECEBER</label>
                  <select class="form-control" id="id_banco" name="id_banco">
                    <?php foreach ($bancos as $b) : ?>
                      <option value="">ESCOLHA UM BANCO </option>
                        <option value="<?= $b['id'] ?>"><?= $b['descricao'] ?></option>
                      <?php endforeach ?>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="vl_acrescimo">ACRÉSCIMO</label>
                  <input type="number" min="0.00" step="0.01" class="form-control" id="vl_acrescimo" name="vl_acrescimo" placeholder="Valor do acrescimo" autocomplete="OFF">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="vl_desconto">DESCONTO</label>
                  <input type="number" min="0.00" step="0.01" class="form-control" id="vl_desconto" name="vl_desconto" placeholder="Valor do desconto" autocomplete="OFF">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">BAIXAR</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">VOLTAR</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
  <!-- ================ESTORNAR OS DADOS DE UMA CONTA A RECEBER =============================================== -->
<?php if (hasPermission('modificarReceber')) : ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="estornarModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title text-center">ESTORNAR CONTA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('receber/estornar') ?>" method="post" id="estornarForm">
          <div class="modal-body">

            <p><b>ESSA OPÇÃO FAZ COM QUE A CONTA RETORNE PARA O STATUS <b>ABERTO</b>?</b></p>
            <p><b>Tem certeza que deseja executar essa operação? </b></p>

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
  <!-- ================ APAGAR OS DADOS DE UMA CONTA A RECEBER =============================================== -->
<?php if (hasPermission('apagarReceber')) : ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-center">REMOVER PAGAMENTO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <form role="form" action="<?php echo base_url('receber/delete') ?>" method="post" id="removeForm">
          <div class="modal-body">
            <p><b>Tem certeza que deseja remover esta conta?</b></p>
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

<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";

  //======================================================
  $('#id_cliente').select2({
    width: '100%',
    dropdownParent: $('#addModal'),
    theme: 'classic'
  });
  $('#id_banco').select2({
    width: '100%',
    dropdownParent: $('#quitarModal'),
    theme: 'classic'
  });
  //=========ENVIA DADOS DE CRIAR FORM==================
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
  $('#addModal').on('hidden.bs.modal', function() {
    // limpa formulário
    $('#createForm')[0].reset();
    // remove validação bootstrap
    $('#createForm').removeClass('was-validated');
    // reseta visual dos campos
  });
  //=============================FUNÇÃO EDITAR ========================================
  function editFunc(id) 
  {
    $.ajax({
     url: base_url + 'receber/getById/' + id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        let data = response.data;
        $("#editar_nome").val(data.nome);
        $("#editar_dt_recebimento").val(data.dt_recebimento);
        $("#editar_valor").val(data.valor);
        $("#receber_descricao").val(data.observacoes);
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
                showToast('Erro ao atualizar o Pagamento.', 'error');
              }
            });
            return false;
          });
      },
      error: function() {
        showToast('Erro ao buscar o Pagamento.', 'error');
      }
    });
  }
  //=========================FUNÇÃO CALCULAR DINAMICAMENTE ===============================
  function calcularNovoValor(baseValor, acrescimo, desconto) {

    baseValor = parseFloat(baseValor) || 0;
    acrescimo = parseFloat(acrescimo) || 0;
    desconto = parseFloat(desconto) || 0;

    let novoValor = baseValor + acrescimo - desconto;

    return novoValor.toLocaleString('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  }
  //=============================FUNÇÃO QUITAR ========================================
  function quitarFunc(id, valorBase) 
  {
    $('#valorSpan').text(
      parseFloat(valorBase).toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })
    );
    // recalcula dinamicamente
    $('#vl_acrescimo, #vl_desconto')
    .off('input')
    .on('input', function() {
      let acrescimo = $('#vl_acrescimo').val();
      let desconto = $('#vl_desconto').val();
      let novoValor = calcularNovoValor(valorBase, acrescimo, desconto);
      $('#valorSpan').text(novoValor);
    });
    // abre modal
    $("#quitarModal").modal('show');
    // submit
    $("#quitarForm")
    .off('submit')
    .on('submit', function(e) {
      e.preventDefault();
      let form = $(this);
      let formData = form.serializeArray();
      // adiciona ID manualmente
      formData.push({
        name: 'quitar_id',
        value: id
      });
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: formData,
        dataType: 'json',
        success: function(response){
          if (response.success) {
            $("#quitarModal").modal('hide');
            $("#quitarForm")[0].reset();
            manageTable.ajax.reload(null, false);
            showToast(response.messages, 'success');
          } else {
            showToast(response.messages, 'error');
          }
        },
        error: function() {
          showToast('Erro ao quitar a conta.', 'error');
        }
      });
      return false;
    });
  }
  $('#quitarModal').on('hidden.bs.modal', function() {
    // limpa formulário
    $('#quitarForm')[0].reset();
    // limpa valor exibido
    $('#valorSpan').text('0,00');
    // remove eventos antigos
    $('#vl_acrescimo, #vl_desconto').off('input');
    $('#quitarForm').off('submit');
  });
  //=========================FUNÇÃO ESTORNAR ============================
  function estornarFunc(id) 
  {
    // abre modal
    $("#estornarModal").modal('show');
    // submit
    $("#estornarForm")
      .off('submit')
      .on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: {
            id_receber: id
          },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              $("#estornarModal").modal('hide');
              $("#estornarForm")[0].reset();
              manageTable.ajax.reload(null, false);
              showToast(response.messages, 'success');
            } else {
              showToast(response.messages, 'error');
            }
          },
          error: function() {
            showToast('Erro ao estornar a conta.', 'error');
          }
        });
        return false;
      });
  }
  // limpa modal ao fechar
  $('#estornarModal').on('hidden.bs.modal', function() {
    $('#estornarForm')[0].reset();
    $('#estornarForm').off('submit');
  });
  // ==============================FUNÇÃO REMOVER ==============================================
  function removeFunc(id) 
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
                showToast('Erro ao remover o Conta.', 'error');
            }
        });
    });
  }  
</script>