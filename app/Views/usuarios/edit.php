<?php
/** @var array $usuario */
/** @var array $grupos */
/** @var array $user_group */
?>
<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Edição de Usuários
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="toast-container" style="position: fixed;top: 20px;right: 20px;z-index: 9999;width: 400px;"></div>
        <div class="card">
              <div class="card-header bg-primary">
                <h3>EDITAR USUÁRIO</h3>
              </div>
              <form role="form" action="<?= site_url('usuarios/update/' . $usuario['id']) ?>" method="post">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="groups">Grupo</label>
                        <select class="form-control" style="width:100%" id="groups" name="groups">
                          <option value="">Escolha um grupo</option>
                          <?php foreach ($grupos as $v): ?>
                            <option value="<?= $v['id'] ?>" <?= ($user_group['group_id'] == $v['id'] ? 'selected' : '') ?> ><?= $v['group_name'] ?></option> 
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div><!-- div col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="username">Usuário</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Usuário" value="<?= $usuario['username'] ?>" autocomplete="off">
                      </div>
                    </div><!-- div col -->
                  </div><!-- div row -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">Nome</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Nome" value="<?= $usuario['firstname'] ?>" autocomplete="off">
                      </div>
                    </div><!-- div col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $usuario['email'] ?>" autocomplete="off">
                      </div>       
                    </div><!-- div col -->
                  </div><!-- div row -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone" value="<?= $usuario['phone'] ?>" maxlength="11" data-toggle="tooltip" autocomplete="off">
                      </div>
                    </div><!-- div col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="gender">Sexo</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="gender" id="male" value="1" <?= ($usuario['gender'] == 1) ? 'checked' : '' ?>>
                            Masculino
                          </label>
                          <label>
                            <input type="radio" name="gender" id="female" value="2" <?= ($usuario['gender'] == 2) ? 'checked' : '' ?>>
                            Feminino
                          </label>
                        </div><!-- div radio -->
                      </div><!-- div form -->
                    </div><!-- div col -->
                  </div><!-- div row -->
                  <div clas="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Deixe a senha em branco se você não quiser trocar-la.
                        </div>
                      </div>
                    </div><!-- div col -->
                  </div><!-- div row -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha" autocomplete="off">
                      </div>
                    </div><!-- div col-->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="cpassword">Confirme a senha</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirme a senha" autocomplete="off">
                      </div>
                    </div><!-- div col -->
                  </div><!-- div row -->
                </div><!-- card body-->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Salvar</button>
                  <a href="<?php echo base_url('usuarios/') ?>" class="btn btn-danger">Fechar</a>
                </div>
              </form>
            </div><!-- /.card -->
          </div><!-- col-md-12 -->
        </div><!-- /.row -->
      </div><!-- content fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script type="text/javascript">
    //=================================================================
    $('[data-mask]').inputmask() //PUXA AS FUNÇÕES DE MÁSCARA

    $('#groups').select2({
    width: '100%',
    theme: 'classic'
  });
  </script>
<?= $this->endSection() ?>