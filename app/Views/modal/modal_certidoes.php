<!-- ===============================MODAL PARA NOVAS CERTIDÕES ===================== -->
<?php if (in_array('criarCertidao', $user_permission)): ?>
  <!-- create brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="addModalCertidao">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">NOVA CERTIDÃO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('certidoes/create') ?>" class="requires-validation" method="post" id="createModalCertidao" novalidate>
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
                  <?= $combo_cliente; ?>
                </select>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="id_tipo_certidao">CERTIDÃO</label>
              <select class="form-control" id="id_tipo_certidao" name="id_tipo_certidao" required>
                <?= $combo_certidao; ?>
              </select>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="form-group">
              <label for="certidao_descricao">DESCRIÇÃO</label>
              <input type="text" class="form-control" id="certidao_descricao" name="certidao_descricao" placeholder="Descreva a Certidão" autocomplete="off" required>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="form-group">
              <label for="certidao_expira">DATA QUE EXPIRA</label>
              <input type="date" class="form-control" id="certidao_expira" name="certidao_expira" autocomplete="off" required>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
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
<!-- ======================================================================================== -->
<?php if (in_array('modificarCertidao', $user_permission)): ?>
  <!-- edit brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="editModalCertidao">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">ALTERAR CERTIDÕES</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?= base_url('certidoes/update') ?>" method="post" id="updateFormCertidao">
          <div class="modal-body">
            <div id="messages"></div>
            <div class="form-group">
              <?php if (isset($cliente_data)) : ?>
                <input type="hidden" name="id_cliente" value="<?php echo $cliente_data['id']; ?>">
              <?php endif; ?>
              <label for="edit_tipo_certidao">CERTIDÃO</label>
              <select class="form-control" id="edit_tipo_certidao" name="edit_tipo_certidao" required>
                <?= $combo_certidao; ?>
              </select>
              <div class="invalid-feedback">Preenchimento Obrigatório!</div>
            </div>
            <div class="form-group">
              <label for="edit_certidao_descricao">DESCRIÇÃO DA CERTIDÃO</label>
              <input type="text" class="form-control" id="edit_certidao_descricao" name="edit_certidao_descricao" placeholder="Digite o nome da certidão" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="edit_certidao_expira">DATA QUE EXPIRA</label>
              <input type="date" class="form-control" id="edit_certidao_expira" name="edit_certidao_expira" autocomplete="off">
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
<!-- =================================================================================================================== -->
<?php if (in_array('apagarCertidao', $user_permission)): ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModalCertidao">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title text-center">APAGAR CERTIDÃO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('certidoes/remove') ?>" method="post" id="removeFormCertidao">
          <div class="modal-body">
            <input type="hidden" name="certidao_cliente_id" id="certidao_cliente_id"> <!-- Campo oculto para ID do Cliente -->
            <input type="hidden" name="certidao_id" id="certidao_id"> <!-- Campo oculto para ID do Certificado -->
            <p>Tem certeza que deseja remover a Certidão?</p>
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
<!-- ========================================================================================================================================= -->
<script type="text/javascript">
  var manageTable;
  var base_url = "<?= base_url(); ?>";

  //==============================FUNÇÃO PARA VERIFICAR VALIDAÇÃO DE FORMULÁRIO ==========================
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
  //=================== SELECT 2 =====================================
  $('#id_cliente').select2({
    width: '100%',
    dropdownParent: $('#addModalCertidao')
  });
  $('#id_tipo_certidao').select2({
    width: '100%',
    dropdownParent: $('#addModalCertidao')
  });
  $('#edit_tipo_certidao').select2({
    width: '100%',
    dropdownParent: $('#editModalCertidao')
  });

  //=========ENVIA DADOS DE CRIAR FORM==================
  $('#createModalCertidao').unbind('submit').on('submit', function(e) {
    e.preventDefault();

    var form = $(this);
    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(),
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
            '</div>');

          // Fechar o modal
          $("#addModalCertidao").modal('hide');

          // Redirecionar corretamente
          if (response.redirect) {
            setTimeout(function() {
              window.location.href = response.redirect;
            }, 1000); // Pequeno delay para evitar conflitos
          } else {
            location.reload(); // Apenas recarrega se não houver redirecionamento
          }
        } else {
          $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
            '</div>');
        }
      }
    });
  });
  //===================================FUNÇÃO DE EDITAR ============================================
  function editCertidao(id) {
    $.ajax({
      url: base_url + 'certidoes/EncontraCertidaoPorID/' + id,
      type: 'post',
      dataType: 'json',
      success: function(response) {
        // Preenche os campos do modal com os dados recebidos
        $("#edit_tipo_certidao").val(response.id_tipo);
        $("#edit_certidao_descricao").val(response.descricao);
        $("#edit_certidao_expira").val(response.dt_expira);

        // Configura o formulário de atualização
        $("#updateFormCertidao").unbind('submit').bind('submit', function() {
          var form = $(this);
          $.ajax({
            url: form.attr('action') + '/' + id, // Garante que a URL está correta
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
              // Se a operação foi bem-sucedida
              if (response.success) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">' +
                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                  '</div>');
                $("#sucesso").fadeTo(2000, 500).slideUp(500, function() {
                  $("#sucesso").slideUp(500);
                });

                // Fechar o modal
                $("#editModalCertidao").modal('hide');

                // Redirecionar para a página do cliente após a edição
                if (response.redirect) {
                  setTimeout(function() {
                    window.location.href = response.redirect; // Redireciona para a URL enviada
                  }, 1000); // Espera 1 segundo antes de redirecionar
                }

                // Resetar o formulário
                $("#updateFormCertidao .form-group").removeClass('has-error').removeClass('has-success');
              } else {
                // Exibe a mensagem de erro
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


  //================================FUNÇÃO REMOVER ===========================================================
  function removeCertidao(id_certidao, id_cliente = null) {
    $('#certidao_id').val(id_certidao);
    $('#certidao_cliente_id').val(id_cliente || '');
  }

  $(document).ready(function() {
    $('#removeFormCertidao').on('submit', function(e) {
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
            $('#removeModalCertidao').modal('hide');

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