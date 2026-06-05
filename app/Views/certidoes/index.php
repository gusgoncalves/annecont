  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-dark">
              <h5 class="text-center">LISTA DE CERTIDÕES</h5>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <?php if(hasPermission('criarCertidao')): ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModalCertidao"><i class="fas fa-plus-square"></i> NOVA CERTIDÃO</button>
              <br />
            <?php endif; ?>
            <?php if(empty($certidoes)): ?>
              <div class="alert alert-warning mb-0">
                Nenhum certificado cadastrado.
              </div>
            <?php else : ?>
              <table id="certidaoTable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>TIPO</th>
                    <th>EXPIRA</th>
                    <th>VALIDADE</th>
                    <?php if(hasAnyPermission(['modificarCertidao','apagarCertidao'])): ?>
                    <th class="text-center text-nowrap col-auto">AÇÕES</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($certidoes as $k => $value) : ?>
                    <tr>
                      <td><?= $value['nome'] ?></td>
                      <td><?= date('d/m/Y', strtotime($value['dt_expira'])) ?></td>
                      <td><?= $value['descricao'] ?></td>
                      <td class="text-center text-nowrap col-auto">
                        <?php if(hasPermission('modificarCertidao')): ?>
                          <button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editCertidao('<?= $value['id']?>')"><i class="fas fa-edit"></i></button>
                        <?php endif; ?>
                        <?php if(hasPermission('apagarCertidao')): ?>
                          <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeCertidao('<?= $value['id']?>')" data-toggle="modal" data-target="#removeModalCertidao"><i class="fas fa-trash"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach ; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div><!-- /.card-body -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </section>    <!-- /.content -->
  <?= $this->include('modal/modal_certidoes') ?>
