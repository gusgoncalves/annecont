<?php
/** @var array $grupos */
?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Clientes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="toast-container" style="position: fixed;top: 20px;right: 20px;z-index: 9999;width: 400px;"></div>
        <div class="card">
          <div class="card-header bg-primary">
            <h3>NOVO USUÁRIO</h3>
          </div>
          <form role="form" action="<?= site_url('usuarios/store/') ?>" class="requires-validation" method="post" novalidate>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="groups">Grupo</label>
                    <select class="form-control" id="groups" name="groups" style="width:100%" required>
                      <option value="">Grupo de Permissões</option>
                      <?php foreach ($grupos as $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                      <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div> <!-- div col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">Usuário</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Usuário" autocomplete="off" value="<?= old('username') ?>" required>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div><!-- div col -->
              </div><!-- div row-->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fname">Nome</label> <span class="text-danger"><b>*</b></span>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Nome" autocomplete="off" value="<?= old('fname') ?>" required>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div><!-- div col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off" value="<?= old('email') ?>">
                  </div>
                </div><!-- div col -->
              </div><!-- div row -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" autocomplete="off" value="<?= old('password') ?>" required>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div><!-- div col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cpassword">Confirme a senha</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirme a senha" autocomplete="off" value="<?= old('cpassword') ?>" required>
                  </div>
                </div><!-- div col -->
              </div><!-- div row -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone" autocomplete="off" data-inputmask='"mask": "(99) 9999-9999"' value="<?= old('phone') ?>" data-mask required>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div><!-- div col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="gender">Sexo</label>
                    <div class="radio">
                      <label for="male">
                        <input type="radio" name="gender" id="male" value="1">
                        Masculino
                      </label>
                      <label for="female">
                        <input type="radio" name="gender" id="female" value="2">
                        Feminino
                      </label>
                    </div>
                  </div>
                </div><!-- div col -->
              </div><!-- div row -->
            </div><!-- card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">SALVAR</button>
              <a href="<?php echo base_url('usuarios/') ?>" class="btn btn-danger">VOLTAR</a>
            </div>
          </form>
        </div><!-- /.card -->
      </div><!-- col-md-12 -->
    </div><!-- /.row -->
  </section><!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script type="text/javascript">
    //======================================================================
    $('[data-mask]').inputmask() //PUXA AS FUNÇÕES DE MÁSCARA DO PLUGIN
  </script>
<?= $this->endSection() ?>