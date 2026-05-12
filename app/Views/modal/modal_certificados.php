<style>
    .hidden {
      display: none;
    }
  </style>
<?php if (in_array('criarCertificado', $user_permission)): ?>
    <!-- cria o modal -->
    <div class="modal fade" role="dialog" id="addModalCertificado">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">NOVO CERTIFICADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?php echo base_url('certificados/create') ?>" class="requires-validation" method="post" id="createFormCertificado" novalidate>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cliente">CLIENTE</label>
                            <?php if (isset($cliente_data)): ?>
                                <!-- Se já estiver na ficha do cliente, mostra um campo fixo -->
                                <input type="text" class="form-control" value="<?php echo $cliente_data['razao']; ?>" readonly>
                                <input type="hidden" name="id_cliente" value="<?php echo $cliente_data['id']; ?>">
                            <?php else: ?>
                                <!-- Se estiver na listagem geral, exibe o combo -->
                                <select class="form-control" style="width:100%" id="id_cliente" name="id_cliente" required>
                                    <?php echo $combo_cliente; ?>
                                </select>
                                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="certificado_descricao">DESCRIÇÃO</label>
                            <select class="form-control" style="width:100%" id="certificado_descricao" name="certificado_descricao" onchange="toggleInputs('insert')" required>
                                <option value="CERTIFICADO">CERTIFICADO</option>
                                <option value="PROCURAÇÃO">PROCURAÇÃO</option>
                            </select>
                            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                        </div>
                        <div class="form-group" id="validade" style="display:none;">
                            <label for="certificado_validade">VALIDADE</label>
                            <input type="date" class="form-control" id="certificado_validade" name="certificado_validade" required>
                            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                        </div>
                        <div class="form-group" id="senha" style="display:none;">
                            <label for="certificado_senha">SENHA</label>
                            <input type="text" class="form-control" id="certificado_senha" name="certificado_senha" placeholder="Digite a senha do Certificado" autocomplete="off">
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
<!-- ============================================================================================================================================================ -->
<?php if (in_array('modificarCertificado', $user_permission)): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModalCertificado">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">ALTERAR CERTIFICADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?php echo base_url('certificados/update') ?>" method="post" id="updateFormCertificado">
                    <div class="modal-body">
                        <div id="messages"></div>
                        <div class="form-group">
                            <?php if (isset($cliente_data)) : ?>
                                <input type="hidden" name="id_cliente" value="<?php echo $cliente_data['id']; ?>">
                            <?php endif; ?>
                            <label for="edit_certificado_descricao">DESCRIÇÃO</label>
                            <select class="form-control" style="width:100%" id="edit_certificado_descricao" name="edit_certificado_descricao" onchange="toggleInputs('edit')" required>
                                <option value="CERTIFICADO">CERTIFICADO</option>
                                <option value="PROCURAÇÃO">PROCURAÇÃO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_certificado_validade" style="display:none;">VALIDADE</label>
                            <input type="date" class="form-control" id="edit_certificado_validade" name="edit_certificado_validade" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_certificado_senha" style="display:none;">SENHA</label>
                            <input type="text" class="form-control" id="edit_certificado_senha" name="edit_certificado_senha" placeholder="Digite a senha do Certificado" autocomplete="off">
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
<!-- ==================================================================================================================================== -->
<?php if (in_array('apagarCertificado', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModalCertificado">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center">APAGAR CERTIFICADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?php echo base_url('certificados/remove') ?>" method="post" id="removeFormCertificado">
                    <div class="modal-body">
                        <input type="hidden" name="id_cliente" id="remove_cliente_id"> <!-- Campo oculto para ID do Cliente -->
                        <input type="hidden" name="id" id="remove_certificado_id"> <!-- Campo oculto para ID do Certificado -->
                        <p>Tem certeza que deseja remover o Certificado?</p>
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
        dropdownParent: $('#addModalCertificado')
    });
    //===========================MOSTRA CAMPOS DO FORM DE CADASTRO =================================
    function toggleInputs(valor) {
        if(valor ==='insert'){
            const descricao = document.getElementById('certificado_descricao');
            const vencimento = document.getElementById('validade');
            const senha = document.getElementById('senha');

            if (!descricao || !vencimento || !senha) return; // Garante que os elementos existem

            if (descricao.value === 'CERTIFICADO') {
                vencimento.style.display = 'block';
                senha.style.display = 'block';
            } else if (descricao.value === 'PROCURAÇÃO') {
                vencimento.style.display = 'block';
                senha.style.display = 'none';
            } else {
                vencimento.style.display = 'none';
                senha.style.display = 'none';
            }
        }else{
            const edit_descricao = document.getElementById('edit_certificado_descricao');
            const edit_vencimento = document.getElementById('edit_certificado_validade');
            const edit_senha = document.getElementById('edit_certificado_senha');

            if (!edit_descricao || !edit_vencimento || !edit_senha) return; // Garante que os elementos existem

            if (edit_descricao.value === 'CERTIFICADO') {
                edit_vencimento.style.display = 'block';
                edit_senha.style.display = 'block';
            } else if (edit_descricao.value === 'PROCURAÇÃO') {
                edit_vencimento.style.display = 'block';
                edit_senha.style.display = 'none';
            } else {
                edit_vencimento.style.display = 'none';
                edit_senha.style.display = 'none';
            }
        }  
    }

    // Garante que os campos sejam configurados corretamente ao abrir o modal
    document.addEventListener('DOMContentLoaded', function() {
        toggleInputs(); // Corrige a exibição ao carregar a página
    });

    //========================CRIAR FORM MODAL ===============================
    $('#addModalCertificado').on('shown.bs.modal', function () {
        toggleInputs('insert');
    });

    //=========ENVIA DADOS DE CRIAR FORM==================
    $('#createFormCertificado').unbind('submit').on('submit', function(e) {
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
                    $("#addModalCertificado").modal('hide');

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
    function editCertificado(id) {
        $.ajax({
            url: base_url + 'certificados/EncontraCertificadoPorID/' + id,
            type: 'post',
            dataType: 'json',
            success: function(response) {
                // Preenche os campos do modal com os dados recebidos
                $("#edit_certificado_descricao").val(response.descricao);
                toggleInputs('edit');
                $("#edit_certificado_validade").val(response.dt_validade);
                $("#edit_certificado_senha").val(response.senha);

                // Configura o formulário de atualização
                $("#updateFormCertificado").unbind('submit').bind('submit', function() {
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
                                $("#editModalCertificado").modal('hide');

                                // Redirecionar para a página do cliente após a edição
                                if (response.redirect) {
                                    setTimeout(function() {
                                        window.location.href = response.redirect; // Redireciona para a URL enviada
                                    }, 1000); // Espera 1 segundo antes de redirecionar
                                }

                                // Resetar o formulário
                                $("#updateFormCertificado .form-group").removeClass('has-error').removeClass('has-success');
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
    function removeCertificado(id_certificado, id_cliente = null) {
        $('#remove_certificado_id').val(id_certificado);
        $('#remove_cliente_id').val(id_cliente || '');
    }

    $(document).ready(function() {
        $('#removeFormCertificado').on('submit', function(e) {
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
                        $('#removeModalCertificado').modal('hide');

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