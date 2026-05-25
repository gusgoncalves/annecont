<?php /** @var array $clientes */
    /** @var array $estados */
?>
<?php if (hasPermission('criarCidade')): ?>
    <!-- create brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">NOVA CIDADE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('cidades/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome_cidade">NOME DA CIDADE</label>
                                    <input type="text" class="form-control" id="nome_cidade" name="nome_cidade" maxlength="100" required>
                                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sigla_uf">UF</label>
                                    <select class="form-control" id="sigla_uf" name="sigla_uf" required>
                                        <option value="">ESTADO</option>
                                        <?php foreach ($estados as $e): ?>
                                            <option value="<?= $e['id'] ?>"><?= $e['uf'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
<!-- ======================================MODIFICAR MODAL DE CIDADES ==================================== -->
<?php if (hasPermission('modificarCidade')): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">Alterar Cidade</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('cidades/edit') ?>" method="post" id="updateForm">
                    <div class="modal-body">
                        <div id="messages"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_cidade">CIDADE</label>
                                    <input type="text" class="form-control" id="edit_cidade" name="edit_cidade" maxlength="100" required>
                                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_sigla_uf">SIGLA</label>
                                    <select class="form-control" id="edit_sigla_uf" name="edit_sigla_uf" required>
                                        <option value="">ESTADO</option>
                                        <?php foreach ($estados as $e): ?>
                                            <option value="<?= $e['id'] ?>"><?= $e['uf'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
<?php if (hasPermission('apagarCidade')): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center">APAGAR CIDADE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('cidades/delete') ?>" method="post" id="removeForm">
                    <div class="modal-body">
                        <input type="hidden" name="cidade_id" id="cidade_id"> <!-- Campo oculto para ID da Cidade -->
                        <p>Tem certeza que deseja remover a cidade?</p>
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
    function editCidade(id) 
    {
        $.ajax({
        url: base_url + 'cidades/getById/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // pega os dados corretos
            let data = response.data;
            // preenche campos
            $("#edit_cidade").val(data.nome_cidade);
            $("#edit_sigla_uf").val(data.id_uf);
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
                    showToast('Erro ao atualizar cidade.', 'error');
                }
            });
            return false;
            });
        },
        error: function() {
            showToast('Erro ao buscar cidade.', 'error');
        }
        });
    }
    //================================FUNÇÃO REMOVER ===========================================================
    function removeCidade(id) 
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
                    showToast('Erro ao remover a cidade.', 'error');
                }
            });
        });
    }
</script>