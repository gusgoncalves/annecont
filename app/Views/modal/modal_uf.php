<?php /** @var array $clientes */
    /** @var array $meses */
?>
<?php if (hasPermission('criarUF')): ?>
    <!-- create brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">NOVO ESTADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('uf/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome_uf">ESTADO</label>
                                    <input type="text" class="form-control" id="nome_uf" name="nome_uf" maxlength="100" required>
                                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sigla_uf">SIGLA</label>
                                    <input type="text" class="form-control" id="sigla_uf" name="sigla_uf" maxlength="2" required>
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
<?php if (hasPermission('modificarUF')): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">Alterar Faturamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('uf/edit') ?>" method="post" id="updateForm">
                    <div class="modal-body">
                        <div id="messages"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_uf">ESTADO</label>
                                    <input type="text" class="form-control" id="edit_uf" name="edit_uf" maxlength="100" required>
                                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_sigla_uf">SIGLA</label>
                                    <input type="text" class="form-control" id="edit_sigla_uf" name="edit_sigla_uf" maxlength="2" required>
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
<?php if (hasPermission('apagarUF')): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center">APAGAR ESTADO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('uf/delete') ?>" method="post" id="removeForm">
                    <div class="modal-body">
                        <input type="hidden" name="uf_id" id="uf_id"> <!-- Campo oculto para ID do Certificado -->
                        <p>Tem certeza que deseja remover o estado?</p>
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
    //=========ENVIA DADOS DE CRIAR FORM==================
    $('#createForm').unbind('submit').on('submit', function(e) {
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
    $('#addModal').on('hidden.bs.modal', function () {
        // limpa formulário
        $('#createForm')[0].reset();
        // remove validação bootstrap
        $('#createForm').removeClass('was-validated');
        // reseta visual dos campos
    });
    //===================================FUNÇÃO DE EDITAR ============================================
    function editUF(id) 
    {
        $.ajax({
        url: base_url + 'uf/getById/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // pega os dados corretos
            let data = response.data;
            // preenche campos
            $("#edit_uf").val(data.nome);
            $("#edit_sigla_uf").val(data.uf);
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
                    showToast('Erro ao atualizar estado.', 'error');
                }
            });
            return false;
            });
        },
        error: function() {
            showToast('Erro ao buscar estado.', 'error');
        }
        });
    }
    //================================FUNÇÃO REMOVER ===========================================================
    function removeUF(id) 
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
                    showToast('Erro ao remover o estado.', 'error');
                }
            });
        });
    }
</script>