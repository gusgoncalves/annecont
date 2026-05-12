  <?php 
    $current = service('uri')->getSegment(1);
    $sub = service('uri')->getSegment(2);
    $grupos = [
      'principal' => ['dashboard'],
      'area_cliente' => ['clientes', 'funcionarios', 'socios', 'certificados', 'certidoes', 'obrigacoes', 'logins','faturamento'],
      'financeiro' => ['movimento', 'pagar','receber'],
      'cadastros' => ['tipos_certidao','portes', 'cidades','uf','tipo','bancos'],
      'acessos' => ['usuarios', 'grupos'],
      'empresa' => ['empresa']
    ];
    function isActive($current, $grupo) {
      return in_array($current, $grupo);
    }
  ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url('dashboard')?>" class="brand-link">
      <img src="<?= base_url('assets/adminlte/dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AnneCont - V1.0</span>
    </a>
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- ======================================= PRINCIPAL =============================-->
          <?php if (hasPermission('modificarEmpresa')) : ?>
            <li class="nav-item" id="principalMainMenu"><a href="<?= base_url('dashboard') ?>" class="nav-link <?= isActive($current, $grupos['principal']) ? 'active' : '' ?>"><i class="fas fa-tags"></i><p>&nbsp;&nbsp; PRINCIPAL</p></a></li>
            <div class="dropdown-divider"></div>
          <?php endif; ?>
          <!-- ======================================= CLIENTES =============================-->
          <?php if (hasPermission('verCliente')) : ?>
            <?php $openCliente = isActive($current, $grupos['area_cliente']); ?>
            <li class="nav-item <?= $openCliente ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $openCliente ? 'active' : '' ?>"><i class="fas fa-users" aria-hidden="true"></i><p>&nbsp;&nbsp; ÁREA CLIENTE<i class="fas fa-angle-left right"></i></p></a>
              <ul class="nav nav-treeview" style="<?= $openCliente ? 'display: block;' : '' ?>">
                <?php if (hasPermission('verCliente')) : ?>
                  <li id="clienteMainNav" class="nav-item"><a href="<?= base_url('clientes') ?>" class="nav-link <?= ($current == 'clientes') ? 'active' : '' ?>"><i class="fas fa-user-tie"></i><p>&nbsp;&nbsp; Cliente</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verFuncionario')) : ?>
                  <li class="nav-item" id="funcionarioMainNav"><a href="<?= base_url('funcionarios') ?>" class="nav-link <?= ($current == 'funcionarios') ? 'active' : '' ?>"><i class="fas fa-user-friends"></i><p>&nbsp;&nbsp; Funcionários</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verCliente')) : ?>
                  <li class="nav-item" id="sociosMainNav"><a href="<?= base_url('socios') ?>" class="nav-link <?= ($current == 'socios') ? 'active' : '' ?>"><i class="fas fa-people-arrows" aria-hidden="true"></i><p>&nbsp;&nbsp; Sócios</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verCertificado')) : ?>
                  <li class="nav-item" id="certificadosMainNav"><a href="<?= base_url('certificados') ?>" class="nav-link <?= ($current == 'certificados') ? 'active' : '' ?>"><i class="fas fa-certificate" aria-hidden="true"></i><p>&nbsp;&nbsp; Certificados</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verCertidao')) : ?>
                  <li class="nav-item" id="certidoesMainNav"><a href="<?= base_url('certidoes') ?>" class="nav-link <?= ($current == 'certidoes') ? 'active' : '' ?>"><i class="fas fa-scroll" aria-hidden="true"></i><p>&nbsp;&nbsp; Certidões</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verObrigacao')) : ?>
                  <li class="nav-item" id="obrigacoesMainNav"><a href="<?= base_url('obrigacoes') ?>" class="nav-link <?= ($current == 'obrigacoes') ? 'active' : '' ?>"><i class="fas fa-sitemap" aria-hidden="true"></i><p>&nbsp;&nbsp; Obrigações</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verLogin')) : ?>
                  <li class="nav-item" id="loginsMainNav"><a href="<?= base_url('logins') ?>" class="nav-link <?= ($current == 'logins') ? 'active' : '' ?>"><i class="fas fa-unlock-alt"></i> <p>&nbsp;&nbsp; Logins</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verFaturamento')) : ?>
                  <li class="nav-item" id="faturamentoMainNav"><a href="<?= base_url('faturamento') ?>" class="nav-link <?= ($current == 'faturamento') ? 'active' : '' ?>"><i class="fas fa-hand-holding-usd" aria-hidden="true"></i><p>&nbsp;&nbsp; Faturamento</p></a></li>
                <?php endif; ?>
              </ul>
            </li>
            <div class="dropdown-divider"></div>
          <?php endif; ?>
          <!-- ======================================= FINANCEIRO =============================-->
          <?php if (hasAnyPermission(['verFluxo', 'verPagar', 'verReceber'])) : ?>
            <?php $openFinanceiro = isActive($current, $grupos['financeiro']); ?>
              <li class="nav-item <?= $openFinanceiro ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= $openFinanceiro ? 'active' : '' ?>"><i class="fas fa-balance-scale-right" aria-hidden="true"></i><p>&nbsp;&nbsp; FINANCEIRO<i class="fas fa-angle-left right"></i></p></a>
                <ul class="nav nav-treeview" style="<?= $openFinanceiro ? 'display: block;' : '' ?>">
                  <?php if (hasPermission('verFluxo')) : ?>
                    <li id="movimentacaoMainNav" class="nav-item"><a href="<?= base_url('financeiro/movimento') ?>" class="nav-link <?= ($current == 'movimento') ? 'active' : '' ?>"><i class="fas fa-percent" aria-hidden="true"></i><p>&nbsp;&nbsp; FLUXO DE CAIXA</p></a></li>
                  <?php endif; ?>
                  <?php if (hasPermission('verPagar')) : ?>
                    <li id="pagarMainNav" class="nav-item"><a href="<?= base_url('financeiro/pagar') ?>" class="nav-link <?= ($current == 'pagar') ? 'active' : '' ?>"><i class="fas fa-dollar-sign" aria-hidden="true"></i><p>&nbsp;&nbsp; PAGAR</p></a></li>
                  <?php endif; ?>
                  <?php if (hasPermission('verReceber')) : ?>
                    <li id="receberMainNav" class="nav-item"><a href="<?= base_url('financeiro/receber') ?>" class="nav-link <?= ($current == 'receber') ? 'active' : '' ?>"><i class="fas fa-money-bill-alt" aria-hidden="true"></i><p>&nbsp;&nbsp; RECEBER</p></a></li>
                  <?php endif; ?>
                </ul>
              </li>
            <div class="dropdown-divider"></div>
          <?php endif; ?>
          <!-- ======================================= CADASTROS =============================-->
          <?php if (hasAnyPermission(['verTipoCertidao', 'verPorte', 'verCidade', 'verUF', 'verTipoConta'])) : ?>
            <?php $openCadastros = isActive($current, $grupos['cadastros']); ?>
            <li class="nav-item <?= $openCadastros ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $openCadastros ? 'active' : '' ?>"><i class="fas fa-table" aria-hidden="true"></i><p>&nbsp;&nbsp; CADASTROS<i class="fas fa-angle-left right"></i></p></a>
              <ul class="nav nav-treeview" style="<?= $openCadastros ? 'display: block;' : '' ?>">
              <?php if (hasPermission('verTipoCertidao')) : ?>
                  <li id="tipocertidaoMainNav" class="nav-item"><a href="<?= base_url('certidoes/tipo_certidao') ?>" class="nav-link <?= ($current == 'tipo_certidao') ? 'active' : '' ?>"><i class="fas fa-map-marked-alt" aria-hidden="true"></i><p>&nbsp;&nbsp; Tipo de Certidão</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verPorte')) : ?>
                  <li id="empresaMainNav" class="nav-item"><a href="<?= base_url('portes/') ?>" class="nav-link <?= ($current == 'portes') ? 'active' : '' ?>"><i class="fa fa-map-signs" aria-hidden="true"></i><p>&nbsp;&nbsp;Porte de Empresa</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verUF')) : ?>
                  <li id="estadosMainNav" class="nav-item"><a href="<?= base_url('uf/') ?>" class="nav-link <?= ($current == 'uf') ? 'active' : '' ?>"><i class="fas fa-map-marked-alt" aria-hidden="true"></i><p>&nbsp;&nbsp; UF - Estados</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verCidade')) : ?>
                  <li id="cidadesMainNav" class="nav-item"><a href="<?= base_url('cidades/') ?>" class="nav-link <?= ($current == 'cidades') ? 'active' : '' ?>"><i class="fa fa-map-signs" aria-hidden="true"></i><p>&nbsp;&nbsp; Cidades</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verTipoConta')) : ?>
                  <li id="tipoMainNav" class="nav-item"><a href="<?= base_url('financeiro/tipo') ?>" class="nav-link <?= ($current == 'tipo') ? 'active' : '' ?>"><i class="fas fa-shopping-bag" aria-hidden="true"></i><p>&nbsp;&nbsp; Tipo de Pagamentos</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('modificarEmpresa')) : ?>
                  <li id="tipoMainNav" class="nav-item"><a href="<?= base_url('bancos/') ?>" class="nav-link <?= ($current == 'bancos') ? 'active' : '' ?>"><i class="fas fa-university" aria-hidden="true"></i><p>&nbsp;&nbsp; Caixa</p></a></li>
                <?php endif; ?>
              </ul>
            </li>
            <div class="dropdown-divider"></div>
          <?php endif; ?>
          <!-- ======================================PERMISSÕES ========================================================== -->
          <?php if (hasAnyPermission(['verUser', 'verGrupo'])) : ?>
            <?php $openPermissoes = isActive($current, $grupos['acessos']); ?>
            <li class="nav-item <?= $openPermissoes ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $openPermissoes ? 'active' : '' ?>"><i class="fas fa-key" aria-hidden="true"></i><p>&nbsp;&nbsp; ACESSOS<i class="fas fa-angle-left right"></i></p></a>
              <ul class="nav nav-treeview" style="<?= $openPermissoes ? 'display: block;' : '' ?>">
              <?php if (hasPermission('verUser')) : ?>
                  <li class="nav-item"><a href="<?= base_url('usuarios/') ?>" class="nav-link <?= ($current == 'usuarios') ? 'active' : '' ?>"><i class="fa fa-user-plus" aria-hidden="true"></i><p>&nbsp;&nbsp; USUÁRIOS</p></a></li>
                <?php endif; ?>
                <?php if (hasPermission('verGrupo')) : ?>
                  <li class="nav-item"><a href="<?= base_url('grupos/') ?>" class="nav-link <?= ($current == 'grupos') ? 'active' : '' ?>"><i class="fas fa-users-cog" aria-hidden="true"></i><p>&nbsp;&nbsp; GRUPOS</p></a></li>
                <?php endif; ?>
              </ul>
            </li>
            <div class="dropdown-divider"></div>
          <?php endif; ?>
          <!-- ======================================DADOS DA EMPRESA ========================================================== -->
          <?php if (hasPermission('modificarEmpresa')) : ?>
            <?php $openEmpresa = ($current == 'empresa'); ?>
            <li id="empresaMainNav" class="nav-item <?= ($openEmpresa) ? 'menu-open' : '' ?>"><a href="<?= base_url('empresa/') ?>" class="nav-link <?= ($sub == 'empresa') ? 'active' : '' ?>"><i class="fa fa-building fa-lg" aria-hidden="true"></i><p>&nbsp;&nbsp; DADOS ANNECONT</p></a></li> 
          <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>