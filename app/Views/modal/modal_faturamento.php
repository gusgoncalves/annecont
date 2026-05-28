<?php /** @var int $id_cliente */
    /** @var array $meses */
?>
<?php if (hasPermission('criarFaturamento')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="addModalFaturamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">NOVO FATURAMENTO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('faturamento/create') ?>" class="requires-validation" method="post" id="createFormFaturamento" novalidate>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                            <label for="faturamento_mes">MÊS</label>
                            <select class="form-control" id="mes" name="mes" required>
                                <option value="">SELECIONE O MÊS</option>
                                    <?php foreach ($meses as $m): ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option>
                                    <?php endforeach; ?>
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
<?php if (hasPermission('modificarFaturamento')): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModalFaturamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">Alterar Faturamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('faturamento/edit') ?>" method="post" id="updateFormFaturamento">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_faturamento_mes">MÊS</label>
                            <select class="form-control" id="edit_faturamento_mes" name="edit_faturamento_mes">
                                <option value="">SELECIONE O MÊS</option>
                                    <?php foreach ($meses as $m): ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option>
                                    <?php endforeach; ?>
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
<?php if (hasPermission('apagarFaturamento')): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModalFaturamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center">APAGAR FATURAMENTO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" action="<?= site_url('faturamento/delete') ?>" method="post" id="removeFormFaturamento">
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
    //=========ENVIA DADOS DE CRIAR FORM==================
    $('#createFormFaturamento').unbind('submit').on('submit', function(e) 
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
                    $("#addModalFaturamento").modal('hide');
                    $('#createFormFaturamento')[0].reset();
                    $('#addModalFaturamento').one('hidden.bs.modal', function () {
                        reloadTab('#tab-faturamento');
                    });
                    showToast(response.messages, 'success');
                    // Redirecionar corretamente
                } else {
                    showToast(response.messages, 'error');
                }
            }
        });
    });
    $('#addModalFaturamento').on('hidden.bs.modal', function () {
        // limpa formulário
        $('#createFormFaturamento')[0].reset();
        // limpa select2
        $('#id_cliente').val('').trigger('change');
        // remove validação bootstrap
        $('#createFormFaturamento').removeClass('was-validated');
        // reseta visual dos campos
    });
    //===================================FUNÇÃO DE EDITAR ============================================
    function editFaturamento(id) 
    {
        $.ajax({
        url: base_url + 'faturamento/getById/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // pega os dados corretos
            let data = response.data;
            let descricao = data.ano || '';
            // preenche campos
            $("#edit_faturamento_mes").val(data.id_mes).trigger('change');
            $("#edit_faturamento_ano").val(data.ano);
            $("#edit_faturamento_valor").val(data.valor);      
            // abre modal
            $("#editModalFaturamento").modal('show');
            // submit update
            $("#updateFormFaturamento")
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
                    $("#editModalFaturamento").modal('hide');
                    $("#updateFormFaturamento")[0].reset();
                    $('#editModalFaturamento').one('hidden.bs.modal', function () {
                        reloadTab('#tab-faturamento');
                    });
                    showToast(response.messages, 'success');
                } else {
                    showToast(response.messages, 'error');
                }
                },
                error: function() {
                    showToast('Erro ao atualizar faturamento.', 'error');
                }
            });
            return false;
            });
        },
        error: function() {
            showToast('Erro ao buscar faturamento.', 'error');
        }
        });
    }
    //================================FUNÇÃO REMOVER ===========================================================
    function removeFaturamento(id) 
    {
        $('#removeModalFaturamento').modal('show');
        // remove submits antigos
        $('#removeFormFaturamento').off('submit');
        // novo submit
        $('#removeFormFaturamento').on('submit', function(e) {
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
                        $('#removeModalFaturamento').modal('hide');
                        $('#removeFormFaturamento')[0].reset();
                        $('#removeModalFaturamento').one('hidden.bs.modal', function () {
                            reloadTab('#tab-faturamento');
                    });
                        showToast(response.messages, 'success');
                    } else {
                        showToast(response.messages, 'error');
                    }
                },
                error: function() {
                    showToast('Erro ao remover o faturamento.', 'error');
                }
            });
        });
    }
</script>