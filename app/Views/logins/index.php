  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-dark">
              <h5 class="text-center">LISTA DE LOGINS</h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <?php if(hasAnyPermission(['criarLogin'])): ?>
                <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModalLogin"><i class="fas fa-plus-square"></i> NOVO LOGIN</button>
              <?php endif; ?>
              <?php if(empty($logins)): ?>
              <div class="alert alert-warning mb-0">
                Nenhum funcionário cadastrado.
              </div>
            <?php else : ?>
              <table id="loginTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr> 
                  <th>DESCRIÇÃO</th>
                  <th>USUÁRIO</th>
                  <th>SENHA</th>
                  <?php if(hasAnyPermission(['modificarLogin','apagarLogin'])): ?>
                  <th class="text-center text-nowrap col-auto">AÇÕES</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($logins as $value) : ?>
                    <tr>
                      <td><?= $value['descricao']; ?></td>
                      <td><?= $value['usuario']; ?></td>
                      <td><?= $value['senha']; ?></td>
                      <td class="text-center text-nowrap col-auto">
                        <?php if(hasPermission('modificarLogin')): ?>
                          <button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editLogin('<?= $value['id'] ?>')"><i class="fas fa-edit"></i></button>
                        <?php endif; ?>
                        <?php if(hasPermission('apagarLogin')): ?>
                          <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeLogin('<?= $value['id']?>')" data-toggle="modal" data-target="#removeModalLogin"><i class="fas fa-trash"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  <?= $this->include('modal/modal_logins') ?>