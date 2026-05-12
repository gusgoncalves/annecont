  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('assets/img/carregando.gif')?>" alt="Annecont" height="100" width="100">
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-2x"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown  Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-users fa-2x"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?= base_url('usuarios/perfil/') ?>" class="dropdown-item bg-primary">
            <!-- Message Start -->
            <div class="media">
              <img src="<?= base_url('fotos/padrao.png')?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                <?= strtoupper(session('username')); ?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-circle" style="color: #54e316;"></i></span>
                </h3>
                <p class="text-sm">Ver Perfil</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('auth/logout') ?>" class="dropdown-item dropdown-footer bg-secondary"><span><b><i class="fas fa-power-off fa-2x" style="color: #f20202;"></i></b></span></a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  