<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Autenticação</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/adminlte/dist/css/adminlte.min.css')?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><i class="fas fa-key"></i><b> LOGIN</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">
       <?php if(session()->getFlashdata('errors')): ?>
          <div class="alert alert-warning" role="alert" id="atencao">
              <?= session()->getFlashdata('errors') ?>
          </div>
        <?php endif; ?>
      </p>
      <form action="<?= base_url('auth/login') ?>" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" id="username" placeholder="Usuário" value="<?= old('username') ?>" autocomplete="off" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <div class="invalid-feedback">Preenchimento Obrigatório!</div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Senha" value="<?= old('password') ?>" autocomplete="off" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="invalid-feedback">Preenchimento Obrigatório!</div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url('assets/adminlte/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/adminlte/dist/js/adminlte.min.js')?>"></script>
</body>
</html>
<script>
  $(function () {
      'use strict'
      const forms = document.querySelectorAll('.requires-validation')
      Array.from(forms).forEach(function (form) 
      {
        form.addEventListener('submit', function (event) {
          if(!form.checkValidity()) 
          {
            event.preventDefault()
            event.stopPropagation()
            // FOCA NO PRIMEIRO CAMPO INVÁLIDO
            let firstInvalid = form.querySelector(':invalid')
            if (firstInvalid) 
            {
              firstInvalid.focus()
              firstInvalid.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
              });
            }
          }
            form.classList.add('was-validated')
        }, false)
      })
    });

  $("#atencao").fadeTo(2000, 500).slideUp(500, function(){
    $("#atencao").slideUp(500);
  });
  $("#erro").fadeTo(2000, 500).slideUp(500, function(){
    $("#erro").slideUp(500);
  });
</script>
