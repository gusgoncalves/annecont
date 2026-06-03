<?php
/** @var array $grupos */
?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Grupos
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">LISTA DE GRUPOS </h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <?php if(hasPermission('criarGrupo')): ?>
                <a href="<?php echo base_url('grupos/create') ?>" class="btn btn-lg btn-primary mb-2"><i class="fas fa-plus-square"></i> PERMISSÃO DE ACESSO</a>
                <br />
              <?php endif; ?>
              <table id="groupTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>GRUPO</th>
                  <?php if(hasAnyPermission(['modificarGrupo','apagarGrupo'])): ?>
                    <th class="text-center text-nowrap" width="1%">AÇÕES</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($grupos): ?>                  
                    <?php foreach ($grupos as $v): ?>
                      <tr>
                        <td><?= $v['group_name']; ?></td>
                        <td class="text-center text-nowrap" width="1%">
                          <?php if(hasPermission('modificarGrupo')): ?>
                          <a href="<?= site_url('grupos/edit/'.$v['id']) ?>" class="btn btn-primary" style="font-size:0.55em"><i class="fas fa-edit"></i></a>  
                          <?php endif; ?>
                          <?php if(hasPermission('apagarGrupo')): ?>
                          <button type="button" onclick="removeFunc(<?= $v['id'] ?>)" class="btn btn-danger" data-toggle="modal" data-target="#removeModal" style="font-size:0.55em"><i class="fas fa-trash"></i></button>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </section><!-- /.content -->
    <?php if(hasPermission('apagarGrupo')): ?>
      <!-- remove brand modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title text-center">REMOVER GRUPO</h4>  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
            </div>
            <form role="form" action="<?= site_url('grupos/delete') ?>" method="post" id="removeForm">
              <div class="modal-body">
                <p>Tem certeza que deseja mesmo remover o grupo selecionado?</p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">SIM</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
              </div><!-- End Modal footer -->
            </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>

