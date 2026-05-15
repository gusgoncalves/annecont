<?php /** @var array $clientes */ ?>
<style>
    .hidden {
      display: none;
    }
  </style>
<?php if (hasPermission('criarCertificado')): ?>
    <!-- cria o modal -->
    <div class="modal fade" role="dialog" id="addModalCertificado">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">NOVO CERTIFICADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('certificados/create') ?>" class="requires-validation" method="post" id="createFormCertificado" novalidate>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cliente">CLIENTE</label>
                            <?php if (isset($cliente_data)): ?>                                
                                <!-- Se já estiver na ficha do cliente, mostra um campo fixo -->
                                <input type="text" class="form-control" value="<?=$cliente_data['razao']; ?>" readonly>
                                <input type="hidden" name="id_cliente" value="<?= $cliente_data['id']; ?>">
                            <?php else: ?>
                                <!-- Se estiver na listagem geral, exibe o combo -->
                                <select class="form-control" style="width:100%" id="id_cliente" name="id_cliente" required>
                                    <option value="">SELECIONE O CLIENTE</option>
                                    <?php foreach ($clientes as $c): ?>
                                        <option value="<?= $c['id'] ?>"><?= $c['razao'] ?></option>
                                    <?php endforeach; ?>
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
<?php if (hasPermission('modificarCertificado')): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModalCertificado">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">ALTERAR CERTIFICADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?=site_url('certificados/edit') ?>" method="post" id="updateFormCertificado">
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
                        <div class="form-group" id="edit_validade" style="display:none;">
                            <label for="edit_certificado_validade">VALIDADE</label>
                            <input type="date" class="form-control" id="edit_certificado_validade" name="edit_certificado_validade" autocomplete="off">
                        </div>
                        <div class="form-group" id="edit_senha" style="display:none;">
                            <label for="edit_certificado_senha" >SENHA</label>
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
<?php if (hasPermission('apagarCertificado')): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModalCertificado">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center">APAGAR CERTIFICADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('certificados/delete') ?>" method="post" id="removeFormCertificado">
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
            const edit_vencimento = document.getElementById('edit_validade');
            const edit_senha = document.getElementById('edit_senha');

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
        toggleInputs('insert'); // Corrige a exibição ao carregar a página
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
                    $("#addModalCertificado").modal('hide');
                    $('#createFormCertificado')[0].reset();
                    manageTable.ajax.reload(null, false);
                    showToast(response.messages, 'success');
                    // Redirecionar corretamente
                } else {
                   showToast(response.messages, 'error');
                }
            }
        });
    });
    $('#addModalCertificado').on('hidden.bs.modal', function () {
        // limpa formulário
        $('#createFormCertificado')[0].reset();
        // limpa select2
        $('#id_cliente').val('').trigger('change');
        // remove validação bootstrap
        $('#createFormCertificado').removeClass('was-validated');
        // reseta visual dos campos
        toggleInputs('insert');
    });
    //===================================FUNÇÃO DE EDITAR ============================================
    function editCertificado(id) 
    {
        $.ajax({
            url: base_url + 'certificados/getById/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // pega os dados corretos
                let data = response.data;
                let descricao = data.descricao || '';
                // preenche campos
                $("#edit_certificado_descricao").val(descricao.toUpperCase());
                $("#edit_certificado_validade").val(data.dt_validade || '');
                $("#edit_certificado_senha").val(data.senha || '');
                // atualiza visual dos campos
                toggleInputs('edit');
                // abre modal
                $("#editModalCertificado").modal('show');
                // submit update
                $("#updateFormCertificado")
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
                                $("#editModalCertificado").modal('hide');
                                $("#updateFormCertificado")[0].reset();
                                manageTable.ajax.reload(null, false);
                                showToast(response.messages, 'success');
                            } else {
                                showToast(response.messages, 'error');
                            }
                        },
                        error: function() {
                            showToast('Erro ao atualizar certificado.', 'error');
                        }
                    });
                    return false;
                });
            },
            error: function() {
                showToast('Erro ao buscar certificado.', 'error');
            }
        });
    }
    //================================FUNÇÃO REMOVER ===========================================================
    function removeCertificado(id_certificado, id_cliente = null) {
        $('#remove_certificado_id').val(id_certificado);
        $('#remove_cliente_id').val(id_cliente || '');
        $('#removeModalCertificado').modal('show');
    }
    $(document).ready(function() {
        $('#removeFormCertificado')
            .off('submit')
            .on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // fecha modal
                            $('#removeModalCertificado').modal('hide');
                            // limpa form
                            $('#removeFormCertificado')[0].reset();
                            // atualiza tabela
                            manageTable.ajax.reload(null, false);
                            // toast
                            showToast(response.messages, 'success');
                        } else {
                            showToast(response.messages, 'error');
                        }
                    },
                    error: function() {
                        showToast('Erro ao remover certificado.', 'error');
                    }
                });
            });
        });
</script>