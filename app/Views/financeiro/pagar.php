  <style>
    /*Estilizador da tab para ficar grande na tela */
    .nav-tabs .nav-item {
      flex: 1;
      text-align: center;
    }

    .tab-content {
      margin-top: 20px;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div id="messages"></div>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <?php if (in_array('criarPagar', $user_permission)) : ?>
            <button class="btn btn-lg btn-warning mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVO PAGAMENTO</button>
            <br />
          <?php endif; ?>
          <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">CONTAS A PAGAR</h5>
            </div><!-- /.card-header --></br>
            <!-- ======================================NOVO =============================================== -->
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="card card-primary card-tabs">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="contasPagar" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="pagar-tab" data-toggle="pill" href="#pagar" role="tab" aria-controls="pagar" aria-selected="true"><span class="font-weight-bold">PARA PAGAR</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pago-tab" data-toggle="pill" href="#pago" role="tab" aria-controls="pago" aria-selected="false"><span class="font-weight-bold">PAGO</span></a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="contasPagarContent">
                      <div class="tab-pane fade show active" id="pagar" role="tabpanel" aria-labelledby="pagar-tab">
                        <table id="manageTableNaoQuitado" class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th>DATA</th>
                              <th>DESCRICAO</th>
                              <th>TIPO</th>
                              <th>VALOR</th>
                              <th>SITUAÇÃO</th>
                              <?php if (in_array('modificarPagar', $user_permission) || in_array('apagarPagar', $user_permission)) : ?>
                                <th class="col-2">AÇOES</th>
                              <?php endif; ?>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane fade" id="pago" role="tabpanel" aria-labelledby="pago-tab">
                        <table id="manageTableQuitado" class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th>DATA</th>
                              <th>DESCRICAO</th>
                              <th>TIPO</th>
                              <th>VALOR</th>
                              <th>SITUAÇÃO</th>
                              <?php if (in_array('modificarPagar', $user_permission) || in_array('apagarPagar', $user_permission)) : ?>
                                <th class="col-2">AÇOES</th>
                              <?php endif; ?>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div><!-- /.card -->
                </div>
              </div>
            </div>
            <!-- =================================================NOVO =================================== -->
          </div><!-- /.card -->
        </div><!-- col-md-12 -->
      </div><!-- div row -->
    </section>
  </div>
  <!-- ===============MODAL DE CRIAÇÃO DE PAGAR======================= -->
  <?php if (in_array('criarPagar', $user_permission)) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-center">NOVO PAGAMENTO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?php echo base_url('financeiro/criarpagar') ?>" method="post" id="createForm">
            <div class="modal-body">
              <div class="form-group">
                <label for="tipo">TIPO</label>
                <select class="form-control" style="width:100%" id="tipo" name="tipo">
                  <option value=""></option>
                  <?php foreach ($tipo_conta as $k => $v) : ?>
                    <option value="<?php echo $v['id'] ?>"><?php echo $v['nome'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="nome">IDENTIFICAÇÃO DA CONTA</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Identificação da conta" required>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="dt_vencimento">DATA VENCIMENTO</label>
                    <input type="date" class="form-control" id="dt_vencimento" name="dt_vencimento" placeholder="Data da vencimento" value="<?php echo date('Y-m-d') ?>" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="valor">VALOR DA CONTA</label>
                    <input type="number" min="0.00" step="0.01" class="form-control" id="valor" name="valor" placeholder="Valor" required autocomplete="OFF">
                  </div>
                </div><!-- fim da col-sm-6 -->
              </div>
              <!-- ================================CAMPO RECORRENTE ======================= -->
              <div class="form-group">
                <input type="checkbox" id="recorrente">
                <label for="checkbox">&nbsp; Valor Recorrente?</label>
              </div>
              <div class="col-sm-4">
                <div id="parcelas" style="display:none">
                  <label for="qtd">Parcelas </label>
                  <input type="number" id="quantidade" name="parcelas" class="form-control">
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

  <!-- ================== MODAL DE EDIÇÃO DE PAGAR ======================= -->
  <?php if (in_array('modificarPagar', $user_permission)) : ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-center">EDITAR PAGAMENTO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?php echo base_url('financeiro/editarpagar') ?>" method="post" id="updateForm">
            <div class="modal-body">
              <div class="form-group">
                <label for="editar_tipo">TIPO</label>
                <select class="form-control" id="editar_tipo" style="width:100%" name="editar_tipo">
                  <option value=""></option>
                  <?php foreach ($tipo_conta as $k => $v) : ?>
                    <option value="<?php echo $v['id'] ?>"><?php echo $v['nome'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="editar_nome">IDENTIFICAÇÃO DA CONTA</label>
                <input type="text" class="form-control" id="editar_nome" name="editar_nome" placeholder="Identificação da conta" required>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="editar_dt_vencimento">DATA VENCIMENTO</label>
                    <input type="date" class="form-control" id="editar_dt_vencimento" name="editar_dt_vencimento" placeholder="Data da entrada" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="editar_valor">VALOR DA CONTA</label>
                    <input type="number" min="0.00" step="0.01" class="form-control" id="editar_valor" name="editar_valor" placeholder="Valor da conta" required autocomplete="OFF">
                  </div>
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
 <!-- ================ QUITAR OS DADOS DE UMA CONTA A PAGAR =============================================== -->
<?php if (in_array('modificarPagar', $user_permission)) : ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="quitarModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title text-center">QUITAR CONTA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('financeiro/quitarPagar') ?>" method="post" id="quitarForm">
          <div class="modal-body">
            <p><b>Esse Movimento aparecerá no fluxo de caixa! </b></p>
            <p><h3 class="text-center bg-primary"><b> Valor da conta:  R$ <span id="valorSpan"></span></b></h3></p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dt_baixa">DATA DO PAGAMENTO</label>
                  <input type="date" class="form-control" id="dt_baixa" name="dt_baixa" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id_banco">CONTA A PAGAR</label>
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
  <!-- ================ESTORNAR OS DADOS DE UMA CONTA A PAGAR =============================================== -->
  <?php if (in_array('modificarPagar', $user_permission)) : ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="estornarModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title text-center">ESTORNAR CONTA</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>

          <form role="form" action="<?php echo base_url('financeiro/estornarPagar') ?>" method="post" id="estornarForm">
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
  <!-- ================== MODAL DE APAGAR PAGAR ======================= -->
  <?php if (in_array('apagarPagar', $user_permission)) : ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title text-center">REMOVER PAGAMENTO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?php echo base_url('financeiro/removePagar') ?>" method="post" id="removeForm">
            <div class="modal-body">
              <p>Tem certeza que deseja remover este pagamento?</p>
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
    var manageTableQuitado;
    var manageTableNaoQuitado;
    var base_url = "<?php echo base_url(); ?>";

    //=================== SELECT 2 =====================================
    $('#tipo').select2({
      width: '100%',
      dropdownParent: $('#addModal')
    });
    $('#id_banco').select2({
      width: '100%',
      dropdownParent: $('#quitarModal'),
      theme: 'classic'
    });


   //=======================ATIVAR O MENU ===========================
$(function () {
    var url = window.location.href;

    // Ativar o link diretamente acessado no menu
    $('ul.nav-sidebar a, ul.nav-treeview a').filter(function () {
        return this.href === url || url.startsWith(this.href);
    }).addClass('active')
    .closest('.nav-treeview') // Ativa o submenu se necessário
    .css({'display': 'block'})
    .addClass('menu-open')
    .prev('a') // Ativa o menu principal
    .addClass('active');
});
    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTableNaoQuitado = $("#manageTableNaoQuitado").DataTable({
      'ajax': base_url + "financeiro/buscaDadosPagarNaoQuitado",
      'responsive': true,
      'autoWidth': false,
      'paging': false, //tira a paginação
      'searching': true, //tira o input de pesquisa
      'ordering': false, //tira a opção de ordenar
      'info': false,
      'language': {
        url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
      },
      'buttons': ["print"] //"colvis" é uma opção para ver as colunas e escolher 
    });
    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTableQuitado = $("#manageTableQuitado").DataTable({
      ajax: base_url + "financeiro/buscaDadosPagarQuitado",
      'responsive': true,
      'autoWidth': false,
      'paging': false, //tira a paginação
      'searching': true, //tira o input de pesquisa
      'ordering': false, //tira a opção de ordenar
      'info': false,
      'language': {
        url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
      },
      'buttons': ["print"] //"colvis" é uma opção para ver as colunas e escolher 
    });


    //===========================Envia o form criado=======================================
    $("#createForm").unbind('submit').on('submit', function() {
      var form = $(this);
      $(".text-danger").remove();
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(), //converte para linguagem do servidor
        dataType: 'json',
        success: function(response) {
          manageTableNaoQuitado.ajax.reload(null, false);
          if (response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">' +
              //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
              '</div>');
            $("#sucesso").fadeTo(2000, 500).slideUp(500, function() {
              $("#sucesso").slideUp(500);
            });

            // esconde o modal
            $("#addModal").modal('hide');

            //reseta o form
            $("#createForm")[0].reset();
            $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

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
                //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
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
    function editFunc(id) {
      $.ajax({
        url: base_url + 'financeiro/buscaDadosPagarPorID/' + id,
        type: 'post',
        dataType: 'json',
        success: function(response) {
          $("#editar_tipo").val(response.id_tipo);
          $("#editar_nome").val(response.nome);
          $("#editar_dt_vencimento").val(response.dt_vencimento);
          $("#editar_valor").val(response.valor_pagar);

          // envia o form de editar 
          $("#updateForm").unbind('submit').bind('submit', function() {
            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
              url: form.attr('action') + '/' + id,
              type: form.attr('method'),
              data: form.serialize(), // /converte os dados para forma de serviço de servidor
              dataType: 'json',
              success: function(response) {

                manageTableNaoQuitado.ajax.reload(null, false);

                if (response.success === true) {
                  $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">' +
                    //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                    '</div>');
                  $("#sucesso").fadeTo(2000, 500).slideUp(500, function() {
                    $("#sucesso").slideUp(500);
                  });


                  // esconde o modal
                  $("#editModal").modal('hide');
                  // reseta o modal 
                  $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

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
                      //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                      '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                      '</div>');
                    $("#erro").fadeTo(2000, 500).slideUp(500, function() {
                      $("#erro").slideUp(500);
                       // Recarrega a página após fechar o modal
                      location.reload();
                    });
                  }
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
      var novoValor = parseFloat(baseValor) + parseFloat(acrescimo) - parseFloat(desconto);
      return novoValor.toFixed(2);
    }

    //=============================FUNÇÃO QUITAR ========================================
  function quitarFunc(id) {
    if (id) {
      // Definir o valor do a ser pago como campo
      var valor = $('button[onclick="quitarFunc(' + id + ')"]').data('valor');
      $('#valorSpan').text(valor);

      //===NOVA IMPLEMENTAÇÃO==
      // Configurar eventos de input para recalcular o valor
      $('#vl_acrescimo, #vl_desconto').on('input', function() {
            var acrescimo = $('#vl_acrescimo').val() || 0;
            var desconto = $('#vl_desconto').val() || 0;
            var novoValor = calcularNovoValor(valor, acrescimo, desconto);
            $('#valorSpan').text(novoValor);
        });


      $("#quitarForm").on('submit', function(event) {
        event.preventDefault(); // Previne o envio padrão do formulário
        var form = $(this);
        var formData = form.serializeArray();

        // Adiciona o ID manualmente ao objeto formData
        formData.push({ name: 'quitar_id', value: id });

        $(".text-danger").remove();
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: formData, // Envia todos os dados do formulário + quitar_id
          dataType: 'json',
          success: function(response) {

            manageTableNaoQuitado.ajax.reload(null, false);
            // esconde o modal
            $("#quitarModal").modal('hide');

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
                // Recarrega a página após fechar o modal
                location.reload();
              });
            }
          }
        });
        return false;
      });
    }
  }
    //=========================FUNÇÃO ESTORNAR ============================
    function estornarFunc(id) {
      if (id) {
        $("#estornarForm").on('submit', function() {

          var form = $(this);

          $(".text-danger").remove();
          $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: {
              id_pagar: id
            },
            dataType: 'json',
            success: function(response) {

              manageTableQuitado.ajax.reload(null, false);
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
            }
          });
          return false;
        });
      }
    }
    // ==============================FUNÇÃO REMOVER ==============================================
    function removeFunc(id) {
      if (id) {
        $("#removeForm").on('submit', function() {

          var form = $(this);

          $(".text-danger").remove();
          $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: {
              pagar_id: id
            },
            dataType: 'json',
            success: function(response) {

              manageTableQuitado.ajax.reload(null, false);
              manageTableNaoQuitado.ajax.reload(null, false);
              // esconde o modal
              $("#removeModal").modal('hide');

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
            }
          });

          return false;
        });
      }
    }
    //==============================FUNÇÃO PARCELAS RECORRENTES ===================================
    $(document).ready(function() {
      $('#recorrente').change(function() {
        if ($(this).is(":checked")) {
          $('#parcelas').show();
        } else {
          $('#parcelas').hide();
        }
      });
    });
  </script>