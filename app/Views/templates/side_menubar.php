<?php
$currentController = service('uri')->getSegment(1);
$currentMethod     = service('uri')->getSegment(2);
  
  $currentRoute = $currentController;
  if (!empty($currentMethod)){
    $currentRoute .= '/' . $currentMethod;
  } 

  $grupos = [
    'principal'     => ['dashboard'],

    'area_cliente'  => [
      'clientes',
      'funcionarios',
      'socios',
      'certificados',
      'certidoes',
      'logins',
      'faturamento'
    ],

    'financeiro'    => [
      'movimento',
      'pagar',
      'receber',
      'cobranca'
    ],

    'historicos' => [
      'pagar',
      'receber'
    ],

    'cadastros'     => [
      'tipo_certidao',
      'obrigacoes',
      'portes',
      'cidades',
      'uf',
      'tipo_conta',
      'bancos'
    ],

    'acessos'       => [
      'usuarios',
      'grupos'
    ],

    'empresa'       => [
      'empresa'
    ]
  ];

  function navGroupActive($controller, $grupo)
  {
      return in_array($controller, $grupo);
  }

  function navItemActive($route, $target)
  {
      return $route === $target ? 'active' : '';
  }

  function isActive($controller, $grupo)
  {
      return in_array($controller, $grupo);
  }

  function navActive($currentRoute, $route)
  {
      return $currentRoute === $route ? 'active' : '';
  }
?>
  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= site_url('dashboard') ?>" class="brand-link">
    <img src="<?= site_url('assets/adminlte/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"> AnneCont - V1.0 </span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- ================================= PRINCIPAL ================================ -->
        <?php if (hasPermission('modificarEmpresa')) : ?>
          <li class="nav-item" id="principalMainMenu">
            <a href="<?= site_url('dashboard') ?>" class="nav-link <?= navActive($currentController, 'dashboard') ?>"><i class="fas fa-tags"></i><p>&nbsp;&nbsp; PRINCIPAL</p></a>
          </li>
          <div class="dropdown-divider"></div>
        <?php endif; ?>
          <!-- ================================= CLIENTES ================================ -->
        <?php if (hasPermission('verCliente')) : ?>
          <?php $openCliente = isActive($currentController, $grupos['area_cliente']); ?>
          <li class="nav-item <?= $openCliente ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= $openCliente ? 'active' : '' ?>"><i class="fas fa-users"></i><p>&nbsp;&nbsp; ÁREA CLIENTE<i class="fas fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview" style="<?= $openCliente ? 'display:block;' : '' ?>">
              <?php if (hasPermission('verCliente')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('clientes') ?>" class="nav-link <?= navActive($currentController, 'clientes') ?>"><i class="fas fa-user-tie"></i><p>&nbsp;&nbsp; Cliente</p></a>
                </li>
              <?php endif; ?>   
              <?php if (session('id')==32) : ?>
                <?php if (hasPermission('verFuncionario')) : ?>
                  <li class="nav-item">
                    <a href="<?= site_url('funcionarios') ?>" class="nav-link <?= navActive($currentController, 'funcionarios') ?>"><i class="fas fa-user-friends"></i><p>&nbsp;&nbsp; Funcionários</p></a>
                  </li>
                <?php endif; ?>
                <?php if (hasPermission('verCliente')) : ?>
                  <li class="nav-item">
                    <a href="<?= site_url('socios') ?>" class="nav-link <?= navActive($currentRoute, 'socios') ?>"><i class="fas fa-people-arrows"></i><p>&nbsp;&nbsp; Sócios</p></a>
                  </li>
                <?php endif; ?>
                <?php if (hasPermission('verCertificado')) : ?>
                  <li class="nav-item">
                    <a href="<?= site_url('certificados') ?>" class="nav-link <?= navActive($currentController, 'certificados') ?>"><i class="fas fa-certificate"></i><p>&nbsp;&nbsp; Certificados</p></a>
                  </li>
                <?php endif; ?>
                <?php if (hasPermission('verCertidao')) : ?>
                  <li class="nav-item">
                    <a href="<?= site_url('certidoes') ?>" class="nav-link <?= navActive($currentController, 'certidoes') ?>"><i class="fas fa-scroll"></i><p>&nbsp;&nbsp; Certidões</p></a>
                  </li>
                <?php endif; ?> 
                <?php if (hasPermission('verObrigacao')) : ?>
                  <li class="nav-item">
                    <a href="<?= site_url('obrigacoes') ?>" class="nav-link <?= navActive($currentController, 'obrigacoes') ?>"><i class="fas fa-sitemap"></i><p>&nbsp;&nbsp; Obrigações</p></a>
                  </li>
                <?php endif; ?>
                <?php if (hasPermission('verLogin')) : ?>
                  <li class="nav-item">
                    <a href="<?= site_url('logins') ?>" class="nav-link <?= navActive($currentController, 'logins') ?>"><i class="fas fa-unlock-alt"></i><p>&nbsp;&nbsp; Logins</p></a>
                  </li>
                <?php endif; ?>
                <?php if (hasPermission('verFaturamento')) : ?>
                  <li class="nav-item">
                    <a href="<?= site_url('faturamento') ?>" class="nav-link <?= navActive($currentController, 'faturamento') ?>"><i class="fas fa-hand-holding-usd"></i><p>&nbsp;&nbsp; Faturamento</p></a>
                  </li>
                <?php endif; ?>
              <?php endif; ?>
            </ul>
          </li>
          <div class="dropdown-divider"></div>
        <?php endif; ?>
          <!-- ================================= FINANCEIRO ================================ -->
        <?php if (hasAnyPermission(['verFluxo', 'verPagar', 'verReceber'])) : ?>
          <?php $openFinanceiro = navGroupActive($currentController, $grupos['financeiro']); ?>
          <li class="nav-item <?= $openFinanceiro ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= $openFinanceiro ? 'active' : '' ?>"><i class="fas fa-balance-scale-right"></i><p>&nbsp;&nbsp; FINANCEIRO<i class="fas fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview" style="<?= $openFinanceiro ? 'display:block;' : '' ?>">
              <?php if (hasPermission('verFluxo')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('movimento') ?>" class="nav-link <?= navActive($currentRoute, 'movimento') ?>"><i class="fas fa-percent"></i><p>&nbsp;&nbsp; Fluxo de Caixa</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verPagar')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('pagar') ?>" class="nav-link <?= navActive($currentRoute, 'pagar') ?>"><i class="fas fa-dollar-sign"></i><p>&nbsp;&nbsp; Pagar</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verReceber')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('receber') ?>" class="nav-link <?= navActive($currentRoute, 'receber') ?>"><i class="fas fa-money-bill-alt"></i><p>&nbsp;&nbsp; Receber</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verReceber')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('cobranca') ?>" class="nav-link <?= navActive($currentRoute, 'cobranca') ?>"><i class="fas fa-file-invoice-dollar"></i><p>&nbsp;&nbsp; Cobrança</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verPagar')) : ?>
                <?php $openHistorico = in_array($currentRoute, ['pagar/historico','receber/historico']); ?>
                <li class="nav-item <?= $openHistorico ? 'menu-open' : '' ?>">
                  <a href="#" class="nav-link <?= $openHistorico ? 'active' : '' ?>"><i class="fas fa-money-bill-wave"></i><p>&nbsp;&nbsp; HISTÓRICO<i class="fas fa-angle-left right"></i></p></a>
                  <ul class="nav nav-treeview" style="<?= $openHistorico ? 'display:block;' : '' ?>">
                    <li class="nav-item">
                      <a href="<?= site_url('pagar/historico') ?>" class="nav-link <?= navItemActive($currentRoute, 'pagar/historico') ?>"><i class="fas fa-minus-circle"></i><p>&nbsp;&nbsp; Pagas</p></a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= site_url('receber/historico') ?>" class="nav-link <?= navItemActive($currentRoute, 'receber/historico') ?>"><i class="fas fa-check-circle"></i><p>&nbsp;&nbsp; Recebidas</p></a>
                    </li>
                  </ul>
                </li> 
              <?php endif; ?>
            </ul>
          </li>
          <div class="dropdown-divider"></div>
        <?php endif; ?>
          <!-- ================================= CADASTROS ================================ -->
        <?php if (hasAnyPermission(['verTipoCertidao', 'verPorte', 'verCidade', 'verUF', 'verTipoConta', 'verObrigacao'])) : ?>
          <?php $openCadastros = isActive($currentController, $grupos['cadastros']); ?>
          <li class="nav-item <?= $openCadastros ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= $openCadastros ? 'active' : '' ?>"><i class="fas fa-table"></i><p>&nbsp;&nbsp; CADASTROS<i class="fas fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview" style="<?= $openCadastros ? 'display:block;' : '' ?>">
              <?php if (hasPermission('verTipoCertidao')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('tipo_certidao') ?>" class="nav-link <?= navActive($currentController, 'tipo_certidao') ?>"><i class="fas fa-map-marked-alt"></i><p>&nbsp;&nbsp; Tipo de Certidão</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verPorte')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('portes') ?>" class="nav-link <?= navActive($currentController, 'portes') ?>"><i class="fa fa-map-signs"></i><p>&nbsp;&nbsp; Porte de Empresa</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verUF')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('uf') ?>" class="nav-link <?= navActive($currentController, 'uf') ?>"><i class="fas fa-map-marked-alt"></i><p>&nbsp;&nbsp; UF - Estados</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verCidade')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('cidades') ?>" class="nav-link <?= navActive($currentController, 'cidades') ?>"><i class="fa fa-map-signs"></i><p>&nbsp;&nbsp; Cidades</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verObrigacao')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('obrigacoes') ?>" class="nav-link <?= navActive($currentController, 'obrigacoes') ?>"><i class="fas fa-sitemap"></i><p>&nbsp;&nbsp; Obrigações</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verTipoConta')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('tipo_conta') ?>" class="nav-link <?= navActive($currentController, 'tipo_conta') ?>"><i class="fas fa-shopping-bag"></i><p>&nbsp;&nbsp; Tipo de Pagamentos</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('modificarEmpresa')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('bancos') ?>" class="nav-link <?= navActive($currentController, 'bancos') ?>"><i class="fas fa-university"></i><p>&nbsp;&nbsp; Caixa</p></a>
                </li>
              <?php endif; ?>
           </ul>
          </li>
          <div class="dropdown-divider"></div>
        <?php endif; ?>
          <!-- ================================= ACESSOS ================================ -->
        <?php if (hasAnyPermission(['verUser', 'verGrupo'])) : ?>
          <?php $openPermissoes = isActive($currentController, $grupos['acessos']); ?>
          <li class="nav-item <?= $openPermissoes ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= $openPermissoes ? 'active' : '' ?>"><i class="fas fa-key"></i><p>&nbsp;&nbsp; ACESSOS<i class="fas fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview" style="<?= $openPermissoes ? 'display:block;' : '' ?>">
              <?php if (hasPermission('verUser')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('usuarios') ?>" class="nav-link <?= navActive($currentController, 'usuarios') ?>"><i class="fa fa-user-plus"></i><p>&nbsp;&nbsp; Usuários</p></a>
                </li>
              <?php endif; ?>
              <?php if (hasPermission('verGrupo')) : ?>
                <li class="nav-item">
                  <a href="<?= site_url('grupos') ?>" class="nav-link <?= navActive($currentController, 'grupos') ?>"><i class="fas fa-users-cog"></i><p>&nbsp;&nbsp; Grupos</p></a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
          <div class="dropdown-divider"></div>
        <?php endif; ?>
          <!-- ================================= EMPRESA ================================ -->
        <?php if (hasPermission('modificarEmpresa')) : ?>
          <li class="nav-item">
            <a href="<?= site_url('empresa') ?>" class="nav-link <?= navActive($currentController, 'empresa') ?>"><i class="fa fa-building fa-lg"></i><p>&nbsp;&nbsp; DADOS ANNECONT</p></a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</aside>