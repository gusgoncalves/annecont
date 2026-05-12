<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">


        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert" id="sucesso">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif ($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert" id="erro">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Por favor atualize as informações</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('usuarios/configurar') ?>" method="post">
            <div class="box-body">

              <?php echo validation_errors(); ?>


              <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Usuário" value="<?php echo $user_data['username'] ?>" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user_data['email'] ?>" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="fname">Nome</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Nome" value="<?php echo $user_data['firstname'] ?>" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone" value="<?php echo $user_data['phone'] ?>" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="gender">Sexo</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="gender" id="male" value="1" <?php if ($user_data['gender'] == 1) {
                                                                            echo "checked";
                                                                          } ?>>
                    Masculino
                  </label>
                  <label>
                    <input type="radio" name="gender" id="female" value="2" <?php if ($user_data['gender'] == 2) {
                                                                              echo "checked";
                                                                            } ?>>
                    Feminino
                  </label>
                </div>
              </div>

              <div class="form-group">
                <div class="alert alert-info alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Deixe a senha em branco se você não quiser trocar.
                </div>
              </div>

              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha" data-toggle="tooltip" data-placement="top" title="A senha deve ter no mínimo 5 letras ou números" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="cpassword">Confirme a senha</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirme a senha" data-toggle="tooltip" data-placement="top" title="A senha deve ser exatamente igual a digitada acima" autocomplete="off">
              </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Salvar</button>
              <a href="<?php echo base_url('usuarios/perfil') ?>" class="btn btn-danger">Voltar</a>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>

    </div>
    <!-- /.row -->


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  //=======================ATIVAR O MENU ===========================
  $(function() {
    var url = window.location.href;

    // Ativar o link diretamente acessado no menu
    $('ul.nav-sidebar a, ul.nav-treeview a').filter(function() {
        return this.href === url || url.startsWith(this.href);
      }).addClass('active')
      .closest('.nav-treeview') // Ativa o submenu se necessário
      .css({
        'display': 'block'
      })
      .addClass('menu-open')
      .prev('a') // Ativa o menu principal
      .addClass('active');
  });
  $(document).ready(function() {
    $("#settingMainNav").addClass('active');
  });
  $("#sucesso").fadeTo(2000, 500).slideUp(500, function() {
    $("#sucesso").slideUp(500);
  });
  $("#erro").fadeTo(4000, 500).slideUp(500, function() {
    $("#erro").slideUp(500);
  });
</script>