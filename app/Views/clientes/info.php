<section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-dark">
              <h5 class="text-center">INFORMAÇÕES</h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <?php if(hasAnyPermission(['criarCliente'])): ?>
                <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModalInfo"><i class="fas fa-plus-square"></i> NOVA MENSAGEM</button>
              <?php endif; ?>
              <?php if(!empty($info)): ?>
                <?php foreach($info as $value): ?>
                  <div class="card mb-3 border-left-primary">
                    <div class="card-header">
                        <strong><?= esc($value['usuario']) ?></strong>

                        <span class="float-right">
                            <?= date('d/m/Y H:i', strtotime($value['dt_inclusao'])) ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <?= nl2br(esc($value['descricao'])) ?>
                    </div>

                    <?php if(hasAnyPermission(['modificarCliente','apagarCliente'])): ?>
                      <div class="card-footer text-right">
                          <?php if(hasPermission('apagarCliente')): ?>
                              <button type="button" class="btn btn-danger btn-sm" onclick="removeInfo('<?= $value['id'] ?>')" data-toggle="modal" data-target="#removeModalInfo"><i class="fas fa-trash"></i></button>
                          <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  <?= $this->include('modal/modal_info') ?>