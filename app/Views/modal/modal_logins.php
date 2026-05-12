
<?php if(in_array('criarLogin', $user_permission)): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="addModalLogin">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">CADASTRO DE LOGINS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('logins/create') ?>" class="requires-validation" method="post" id="createFormLogin" novalidate>
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
                  <?php echo $combo_cliente?>
                  </select>
                  <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              <?php endif; ?>
            </div>
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
              <input type="text" class="form-control" id="senha_login" name="senha_login" placeholder="Senha do Login" required>
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
<!-- =================================================================================== -->
<?php if(in_array('modificarLogin', $user_permission)): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="editModaLogin">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-center">ALTERAR LOGIN</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('logins/update') ?>" method="post" id="updateFormLogin">
          <div class="modal-body">
            <div id="messages"></div>
            <div class="form-group">
              <?php if (isset($cliente_data)) : ?>
                <input type="hidden" name="id_cliente" value="<?= $cliente_data['id']; ?>">
              <?php endif; ?>
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
<?php if(in_array('apagarLogin', $user_permission)): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModalLogin">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title text-center">APAGAR LOGINS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form role="form" action="<?php echo base_url('logins/remove') ?>" method="post" id="removeFormLogin">
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
        dropdownParent: $('#addModalLogin')
    });

    //=========ENVIA DADOS DE CRIAR FORM==================
    $("#createFormLogin").unbind('submit').on('submit', function() {
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
                    $("#addModalLogin").modal('hide');
                    location.reload();
                    // reset the form
                    $("#createFormLogin")[0].reset();
                    $("#createFormLogin .form-group").removeClass('has-error').removeClass('has-success');
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
    //===================================FUNÇÃO DE EDITAR ============================================
    function editFuncLogin(id) {
        $.ajax({
            url: base_url + 'logins/EncontraLoginsPorID/' + id,
            type: 'post',
            dataType: 'json',
            success: function(response) {
                $("#edit_descricao_login").val(response.descricao);
                $("#edit_usuario_login").val(response.usuario);
                $("#edit_senha_login").val(response.senha);
                // submit the edit from 
                $("#updateFormLogin").unbind('submit').bind('submit', function() {
                    var form = $(this);
                    $(".text-danger").remove();
                    $.ajax({
                        url: form.attr('action') + '/' + id,
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
                                $("#editModalLogin").modal('hide');

                                // Redirecionar para a página do cliente após a edição
                                if (response.redirect) {
                                    setTimeout(function() {
                                        window.location.href = response.redirect; // Redireciona para a URL enviada
                                    }, 1000); // Espera 1 segundo antes de redirecionar
                                }

                                $("#updateFormLogin .form-group").removeClass('has-error').removeClass('has-success');
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
    //================================FUNÇÃO REMOVER ===========================================================
    function removeFuncLogin(id_login, id_cliente =  null) {
        $('#id_login').val(id_login);
        $('#id_login_cliente').val(id_cliente);
    }

    $(document).ready(function() {
        $('#removeFormLogin').on('submit', function(e) {
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
                        $('#removeModalLogin').modal('hide');

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