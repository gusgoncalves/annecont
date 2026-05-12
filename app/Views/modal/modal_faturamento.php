<?php if (in_array('criarFaturamento', $user_permission)): ?>
    <!-- create brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addModalFaturamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">NOVO FATURAMENTO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?php echo base_url('faturamento/create') ?>" class="requires-validation" method="post" id="createFormFaturamento" novalidate>
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
                            <label for="faturamento_mes">MÊS</label>
                            <select class="form-control" id="mes" name="mes" required>
                                <?php echo $combo_meses; ?>
                            </select>
                            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="faturamento_ano">ANO</label>
                                    <input type="text" class="form-control" id="faturamento_ano" name="faturamento_ano" maxlength="4" pattern="[0-9]{4}" value="<?= date('Y'); ?>" required>
                                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="faturamento_valor">VALOR</label>
                                    <input type="number" class="form-control" id="faturamento_valor" name="faturamento_valor" step="0.01" autocomplete="off" required>
                                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
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
<!-- ======================================MODIFICAR MODAL DE FATURAMENTO ==================================== -->
<?php if (in_array('modificarFaturamento', $user_permission)): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModalFaturamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">Alterar Faturamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?php echo base_url('faturamento/update') ?>" method="post" id="updateFormFaturamento">
                    <div class="modal-body">
                        <div id="messages"></div>
                        <div class="form-group">
                            <?php if (isset($cliente_data)) : ?>
                                <input type="hidden" name="id_cliente" value="<?php echo $cliente_data['id']; ?>">
                            <?php endif; ?>
                            <label for="edit_faturamento_mes">MÊS</label>
                            <select class="form-control" id="edit_faturamento_mes" name="edit_faturamento_mes">
                                <?php echo $combo_meses; ?>
                            </select>
                            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_faturamento_ano">ANO</label>
                                    <input type="text" class="form-control" id="edit_faturamento_ano" name="edit_faturamento_ano" maxlength="4" pattern="[0-9]{4}" required>
                                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_faturamento_valor">VALOR</label>
                                    <input type="number" class="form-control" id="edit_faturamento_valor" name="edit_faturamento_valor" step="0.01" min="0" autocomplete="off" required>
                                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
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
<!-- ============================================================================================ -->
<?php if (in_array('apagarFaturamento', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModalFaturamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center">APAGAR FATURAMENTO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?php echo base_url('faturamento/remove') ?>" method="post" id="removeFormFaturamento">
                    <div class="modal-body">
                        <input type="hidden" name="faturamento_cliente_id" id="faturamento_cliente_id"> <!-- Campo oculto para ID do Cliente -->
                        <input type="hidden" name="faturamento_id" id="faturamento_id"> <!-- Campo oculto para ID do Certificado -->
                        <p>Tem certeza que deseja remover o faturamento?</p>
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
        dropdownParent: $('#addModalFaturamento')
    });

    //=========ENVIA DADOS DE CRIAR FORM==================
    $("#createFormFaturamento").unbind('submit').on('submit', function() {
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
                    $("#addModalFaturamento").modal('hide');
                    location.reload();
                    // reset the form
                    $("#createFormFaturamento")[0].reset();
                    $("#createFormFaturamento .form-group").removeClass('has-error').removeClass('has-success');
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
    function editFaturamento(id) {
        $.ajax({
            url: base_url + 'faturamento/EncontraFaturamentoPorID/' + id,
            type: 'post',
            dataType: 'json',
            success: function(response) {
                $("#edit_faturamento_mes").val(response.id_mes);
                $("#edit_faturamento_ano").val(response.ano);
                $("#edit_faturamento_valor").val(response.valor);
                // submit the edit from 
                $("#updateFormFaturamento").unbind('submit').bind('submit', function() {
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
                                $("#editModalFaturamento").modal('hide');

                                // Redirecionar para a página do cliente após a edição
                                if (response.redirect) {
                                    setTimeout(function() {
                                        window.location.href = response.redirect; // Redireciona para a URL enviada
                                    }, 1000); // Espera 1 segundo antes de redirecionar
                                }

                                $("#updateFormFaturamento .form-group").removeClass('has-error').removeClass('has-success');
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
    function removeFaturamento(id_faturamento, id_cliente = null) {
        $('#faturamento_id').val(id_faturamento);
        $('#faturamento_cliente_id').val(id_cliente || '');
    }

    $(document).ready(function() {
        $('#removeFormFaturamento').on('submit', function(e) {
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
                        $('#removeModalFaturamento').modal('hide');

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