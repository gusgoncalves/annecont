<!-- ===============MODAL DE CRIAÇÃO DE RECEBER======================= -->
<?php if (in_array('criarReceber', $user_permission)) : ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="addModalReceber">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">NOVO CRÉDITO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('financeiro/criarReceber') ?>" method="post" id="createFormReceber">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_cliente">CLIENTE</label>
                <?php if (isset($cliente_data)): ?>
                  <!-- Se já estiver na ficha do cliente, mostra um campo fixo -->
                  <input type="text" class="form-control" value="<?php echo $cliente_data['razao']; ?>" readonly>
                  <input type="hidden" name="id_cliente" value="<?php echo $cliente_data['id']; ?>">
                <?php else: ?>
                  <!-- Se estiver na listagem geral, exibe o combo -->
                  <select class="form-control" id="id_cliente" name="id_cliente" required>
                      <?php echo $combo_cliente; ?>
                  </select>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="nome">IDENTIFICAÇÃO DA CONTA</label>
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Identificação da conta" required>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="dt_recebimento">DATA RECEBIMENTO</label>
                  <input type="date" class="form-control" id="dt_recebimento" name="dt_recebimento" placeholder="Data da recebimento" value="<?php echo date('Y-m-d') ?>" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="valor">VALOR DA CONTA</label>
                  <input type="number" min="0.00" step="0.01" class="form-control" id="valor" name="valor" placeholder="Valor" required autocomplete="OFF">
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
<?php if (in_array('modificarReceber', $user_permission)) : ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="editModalReceber">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">EDITAR RECEBIMENTO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('financeiro/editarReceber') ?>" method="post" id="updateFormReceber">
          <div class="modal-body">
            <div class="form-group">
              <?php if (isset($cliente_data)) : ?>
                <input type="hidden" name="id_cliente" value="<?= $cliente_data['id']; ?>">
              <?php endif; ?>
              <label for="editar_nome">IDENTIFICAÇÃO DA CONTA</label>
              <input type="text" class="form-control" id="editar_nome" name="editar_nome" placeholder="Identificação da conta" required>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="editar_dt_recebimento">DATA RECEBIMENTO</label>
                  <input type="date" class="form-control" id="editar_dt_recebimento" name="editar_dt_recebimento" placeholder="Data da entrada" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="editar_valor">VALOR DA CONTA</label>
                  <input type="number" min="0.00" step="0.01" class="form-control" id="editar_valor" name="editar_valor" placeholder="Valor da conta" required autocomplete="OFF">
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
<?php if (in_array('modificarReceber', $user_permission)) : ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="quitarModalReceber">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title text-center">QUITAR CONTA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('financeiro/quitarReceber') ?>" method="post" id="quitarFormReceber">
          <div class="modal-body">
            <p><b>Esse Movimento aparecerá no fluxo de caixa! </b></p>
            <p><h3 class="text-center bg-primary"><b> Valor da conta:  R$ <span id="valorSpan"></span></b></h3></p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dt_baixa">DATA DA BAIXA</label>
                  <input type="date" class="form-control" id="dt_baixa" name="dt_baixa" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id_banco">CONTA A RECEBER</label>
                  <select class="form-control" id="id_banco" name="id_banco">
                    <?php echo $combo_bancos ?>
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
<?php if (in_array('modificarReceber', $user_permission)) : ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="estornarModalReceber">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title text-center">ESTORNAR CONTA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('financeiro/estornarReceber') ?>" method="post" id="estornarFormReceber">
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
<?php if (in_array('apagarReceber', $user_permission)) : ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModalReceber">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-center">REMOVER PAGAMENTO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <form role="form" action="<?php echo base_url('financeiro/removeReceber') ?>" method="post" id="removeFormReceber">
          <div class="modal-body">
            <input type="text" name="cliente_id" id="cliente_id"> <!-- Campo oculto para ID do Cliente -->
            <input type="text" name="receber_id" id="receber_id"> <!-- Campo oculto para ID do Receber -->
            <p>Tem certeza que deseja remover este pagamento?</p>
            <p>ESSE PROCESSO É IRREVERSÍVEL!!</p>
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


  //=======================ATIVAR O MENU ===========================
  $(function() {
    var url = window.location.href;

    // Ativar o link diretamente acessado no menu
    $('ul.nav-sidebar a, ul.nav-treeview a').filter(function() {
        return this.href === url || url.startsWith(this.href);
      }).addClass('active')
      .closest('.nav-treeview') // Ativa o submenu se necessário
      .css({
          'display': 'block'
      })
      .addClass('menu-open')
      .prev('a') // Ativa o menu principal
      .addClass('active');
  });
  //======================================================
  $('#id_cliente').select2({
    width: '100%',
    dropdownParent: $('#addModalReceber'),
    theme: 'classic'
  });
  $('#id_banco').select2({
    width: '100%',
    dropdownParent: $('#quitarModalReceber'),
    theme: 'classic'
  });
  //=========================================================
  $(function() {
        'use strict'
        const forms = document.querySelectorAll('.requires-validation')
        Array.from(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    });

  //=============================FUNÇÃO CRIAR ========================================
  $("#createFormReceber").unbind('submit').on('submit', function() {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function(response) {
                if (response.success === true) {
                    $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">' +
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                        '</div>');
                    $("#sucesso").fadeTo(2000, 500).slideUp(500, function() {
                        $("#sucesso").slideUp(500);
                    });
                    // hide the modal
                    $("#addModalReceber").modal('hide');
                    location.reload();
                    // reset the form
                    $("#createFormReceber")[0].reset();
                    $("#createFormReceber .form-group").removeClass('has-error').removeClass('has-success');
                } else {
                    if (response.messages instanceof Object) {
                        $.each(response.messages, function(index, value) {
                            var id = $("#" + index);
                            id.closest('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success');
                            id.after(value);
                        });
                    } else {
                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                        $("#erro").fadeTo(2000, 500).slideUp(500, function() {
                            $("#erro").slideUp(500);
                        });
                    }
                }
            }
        });
        return false;
    });
  //=============================FUNÇÃO EDITAR ========================================
  function editFuncReceber(id) {
    $.ajax({
      url: base_url + 'financeiro/buscaDadosReceberPorID/' + id,
      type: 'post',
      dataType: 'json',
      success: function(response) {
        $("#editar_nome").val(response.nome);
        $("#editar_dt_recebimento").val(response.dt_recebimento);
        $("#editar_valor").val(response.valor);
        $("#receber_descricao").val(response.observacoes);
        // envia o form de editar 
        $("#updateFormReceber").unbind('submit').bind('submit', function() {
          var form = $(this);
          // remove the text-danger
          $(".text-danger").remove();
          $.ajax({
            url: form.attr('action') + '/' + id,
            type: form.attr('method'),
            data: form.serialize(), // /converte os dados para forma de serviço de servidor
            dataType: 'json',
            success: function(response) {
              console.log(response);
              if (response.success === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">' +
                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                  '</div>');
                $("#sucesso").fadeTo(2000, 500).slideUp(500, function() {
                  $("#sucesso").slideUp(500);
                });
                // esconde o modal
                $("#editModalReceber").modal('hide');
                // Redirecionar para a página do cliente após a edição
                if (response.redirect) {
                  setTimeout(function() {
                      window.location.href = response.redirect; // Redireciona para a URL enviada
                  }, 1000); // Espera 1 segundo antes de redirecionar
                }
                $("#updateFormReceber .form-group").removeClass('has-error').removeClass('has-success');
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">' +
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                  '</div>');
                $("#erro").fadeTo(2000, 500).slideUp(500, function() {
                  $("#erro").slideUp(500);
                });
              }
              
            }
          });
          return false;
        });
      }
    });
  }

  //=========================FUNÇÃO CALCULAR DINAMICAMENTE ===============================
  function calcularNovoValor(baseValor, acrescimo, desconto) {
    baseValor = parseFloat(baseValor) || 0;
    acrescimo = parseFloat(acrescimo) || 0;
    desconto = parseFloat(desconto) || 0;

    var novoValor = baseValor + acrescimo - desconto;
    return novoValor.toFixed(2);
  }
  //=============================FUNÇÃO QUITAR ========================================
  function quitarFuncReceber(id, id_cliente, valor) {
    if (id) {
      $('#valorSpan').text(parseFloat(valor).toFixed(2).replace('.', ','));

      $('#vl_acrescimo, #vl_desconto').on('input', function () {
        var acrescimo = $('#vl_acrescimo').val() || 0;
        var desconto = $('#vl_desconto').val() || 0;
        var novoValor = calcularNovoValor(valor, acrescimo, desconto);
        $('#valorSpan').text(parseFloat(novoValor).toFixed(2).replace('.', ','));
      });

      $("#quitarFormReceber").on('submit', function (event) {
        event.preventDefault();
        var form = $(this);
        var formData = form.serializeArray();
        formData.push({ name: 'quitar_id', value: id });

        $(".text-danger").remove();
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: formData,
          dataType: 'json',
          success: function (response) {
            $("#quitarModalReceber").modal('hide');
            if (response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">' +
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                '</div>');
              $("#sucesso").fadeTo(2000, 500).slideUp(500, function () {
                $("#sucesso").slideUp(500);
              });
            } else {
              $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">' +
                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                '</div>');
              $("#erro").fadeTo(2000, 500).slideUp(500, function () {
                $("#erro").slideUp(500);
              });
            }
            location.reload();
            form[0].reset();
            form.find('.form-group').removeClass('has-error').removeClass('has-success');
            form.find('.text-danger').remove();
          }
        });
        return false;
      });
    }
  }
  //=========================FUNÇÃO ESTORNAR ============================
  function estornarFunc(id) {
    if (id) {
      $("#estornarForm").on('submit', function(event) {
        event.preventDefault(); // Previne o envio padrão do formulário
        var form = $(this);
        $(".text-danger").remove();
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: {
            id_receber: id
          },
          dataType: 'json',
          success: function(response) {
            manageTableQuitado.ajax.reload(null, false);
            manageTableNaoQuitado.ajax.reload(null, false);
            // esconde o modal           
            $("#estornarModal").modal('hide');
            if (response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">' +
                //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                '</div>');
              $("#sucesso").fadeTo(2000, 500).slideUp(500, function() {
                $("#sucesso").slideUp(500);
              });
            } else {
              $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">' +
                //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                '</div>');
              $("#erro").fadeTo(2000, 500).slideUp(500, function() {
                $("#erro").slideUp(500);
              });
            }
            // Recarrega a página após fechar o modal
            location.reload();
            // Limpa o conteúdo do modal
            form[0].reset(); // Reseta todos os campos do formulário
            form.find('.form-group').removeClass('has-error').removeClass('has-success'); // Remove classes de erro e sucesso
            form.find('.text-danger').remove(); // Remove mensagens de erro
          }
        });
        return false;
      });
    }
  }
  // ==============================FUNÇÃO REMOVER ==============================================
  function removeFuncReceber(id_receber, id_cliente = null) {
        $('#receber_id').val(id_receber);
        $('#cliente_id').val(id_cliente || '');
    }

    $(document).ready(function() {
        $('#removeFormReceber').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#removeModalReceber').modal('hide');

                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">' +
                            '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong> ' + response.messages +
                            '</div>');
                        $("#sucesso").fadeTo(2000, 500).slideUp(500, function() {
                            $("#sucesso").slideUp(500);
                        });

                        // Redireciona após um tempo, se houver URL de redirecionamento
                        if (response.redirect) {
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 1000);
                        } else {
                            // Atualiza a página se não houver redirecionamento
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }

                    } else {
                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">' +
                            '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong> ' + response.messages +
                            '</div>');
                        $("#erro").fadeTo(2000, 500).slideUp(500, function() {
                            $("#erro").slideUp(500);
                        });
                    }
                }
            });
        });
    });
</script>