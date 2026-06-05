<?php /** @var array $socio */ ?>
<?php /** @var int $id_cliente */ ?>

  <?php if(hasPermission('criarCliente')): ?>
    <a href="<?= base_url('socios/create/'.$id_cliente) ?>" class="btn btn-lg btn-success btn-block"><i class="fas fa-plus-square"></i> NOVO SÓCIO </a><br>
  <?php endif; ?>
  <?php if(empty($socio)) : ?>
      <div class="alert alert-warning text-center">
          Nenhum sócio cadastrado.
      </div>
  <?php else : ?>
    <?php foreach($socio as $z) : ?>
      <div class="row mb-3">
        <div class="col-md-6">
          <?php if(hasPermission('modificarCliente')): ?>
            <a href="<?= base_url('socios/edit/'.$z['id']) ?>" class="btn btn-lg btn-primary btn-block"><i class="fas fa-edit"></i> EDITAR SÓCIO </a>
          <?php endif; ?>
        </div>
        <div class="col-md-6">
          <?php if(hasPermission('apagarCliente')): ?>
            <button type="button" class="btn btn-lg btn-danger btn-block" data-toggle="modal" data-id="<?= $z['id'] ?>" data-target="#removeModal"><i class="fas fa-trash"></i> EXCLUIR SÓCIO </button>
          <?php endif; ?>
        </div>
      </div>
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
          <div class="d-flex justify-content-between align-items-center">
              <div>
                  <h5 class="mb-0"><i class="fas fa-user"></i> <?= strtoupper($z['nome']) ?></h5>
              </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card border-left-primary">
                    <div class="card-body">
                        <h6 class="text-muted"><strong>DOCUMENTOS</strong></h6>
                        <p class="mb-1"><strong>CPF:</strong> <?= formatarDocumento($z['cpf']) ?></p>
                        <p class="mb-1"><strong>RG:</strong> <?= $z['rg'] ?: '-' ?></p>
                        <p class="mb-0"><strong>Título:</strong><?= $z['titulo'] ?: '-' ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-left-success">
                    <div class="card-body">
                        <h6 class="text-muted"><strong>CONTATO</strong></h6>
                        <p class="mb-1"><i class="fab fa-whatsapp text-success"></i> <?= $z['whatsapp'] ?: '-' ?></p>
                        <p class="mb-0"><i class="fas fa-envelope text-primary"></i> <?= $z['email'] ?: '-' ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-left-info">
                    <div class="card-body">
                        <h6 class="text-muted"><strong>ENDEREÇO</strong></h6>
                        <p class="mb-0"> <?= !empty($z['endereco']) ? strtoupper($z['endereco']) : '-' ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-left-info">
                    <div class="card-body">
                        <h6 class="text-muted"><strong>NOME DA MÃE</strong></h6>
                        <p class="mb-0"> <?= !empty($z['nome_mae']) ? strtoupper($z['nome_mae']) : '-' ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-light text-white">
                    <div class="card-body text-center">
                        <h6><strong>Data de Nascimento</strong></h6>
                        <h5><?= !empty($z['nascimento']) ? date('d/m/Y', strtotime($z['nascimento'])) : '-' ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-light text-white">
                    <div class="card-body text-center">
                        <h6><strong>Recibo IRPF</strong></h6>
                        <h5><?= $z['recibo'] ?: 'NÃO INFORMADO' ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-light text-white">
                    <div class="card-body text-center">
                        <h6><strong>DECLARA IRPF</strong></h6>
                        <h5><?= $z['declara_ir'] == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      Observações
                  </div>
                  <div class="card-body">
                      <?= !empty($z['observacoes']) ? nl2br($z['observacoes']) : 'Nenhuma observação cadastrada.' ?>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
  <!-- ============================== CRIANDO MODAL DE APAGAR SÓCIOS ==============================-->
  <?php if(hasPermission('apagarCliente')): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title text-center">REMOVER SÓCIO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?= site_url('socios/delete') ?>" method="post" id="removeForm">
            <div class="modal-body">
              <input type="hidden" name="id" id="id_socio_remover">
              <p>Tem certeza que deseja mesmo remover o sócio selecionado?</p>
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
  <script>
    $('#removeModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');

      $('#id_socio_remover').val(id);
    });
  </script>
