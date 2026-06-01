<?php /** @var array $cliente */ ?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Área do Clientes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="container-fluid">
      <div class="row"> 
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="text-center">ÁREA DO CLIENTE</h3>
            </div>
            <div class="card-body">
              <div class="card card-pills">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-pills" id="custom-tabs-one-tab" role="tablist">
                    <?php if (hasPermission("verCliente")) : ?>
                      <li class="nav-item">
                        <a class="nav-link active" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-informacoes-tab" data-toggle="pill" href="#tab-informacoes" role="tab" aria-controls="tab-informacoes" aria-selected="true">Informações</a>
                      </li>
                    <?php endif; ?>
                    <?php if (hasPermission("verObrigacao")) : ?>
                      <li class="nav-item">
                        <a class="nav-link" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-obrigacoes-tab" data-toggle="pill" href="#tab-obrigacoes" role="tab" aria-controls="tab-obrigacoes" aria-selected="false">Obrigações</a>
                      </li>
                    <?php endif; ?>
                    <?php if (hasPermission("verFuncionario")) : ?>
                      <li class="nav-item">
                        <a class="nav-link" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-funcionarios-tab" data-toggle="pill" href="#tab-funcionarios" role="tab" aria-controls="tab-funcionarios" aria-selected="false">Funcionários</a>
                      </li>
                    <?php endif; ?>
                    <?php if (hasPermission("verCliente")) : ?>
                      <li class="nav-item">
                        <a class="nav-link" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-socios-tab" data-toggle="pill" href="#tab-socios" role="tab" aria-controls="tab-socios" aria-selected="false">Sócios</a>
                      </li>
                    <?php endif; ?>
                    <?php if (hasPermission("verCertificado")) : ?>
                      <li class="nav-item">
                        <a class="nav-link" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-certificados-tab" data-toggle="pill" href="#tab-certificados" role="tab" aria-controls="tab-certificados" aria-selected="false">Certificados</a>
                      </li>
                    <?php endif; ?>
                    <?php if (hasPermission("verCertidao")) : ?>
                      <li class="nav-item">
                        <a class="nav-link" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-certidoes-tab" data-toggle="pill" href="#tab-certidoes" role="tab" aria-controls="tab-certidoes" aria-selected="false">Certidões</a>
                      </li>
                    <?php endif; ?>
                    <?php if (hasPermission("verFaturamento")) : ?>
                      <li class="nav-item">
                        <a class="nav-link" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-faturamento-tab" data-toggle="pill" href="#tab-faturamento" role="tab" aria-controls="tab-faturamento" aria-selected="false">Faturamento</a>
                      </li>
                    <?php endif; ?>
                    <?php if (hasPermission("verLogin")) : ?>
                      <li class="nav-item">
                        <a class="nav-link" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-logins-tab" data-toggle="pill" href="#tab-logins" role="tab" aria-controls="tab-logins" aria-selected="false">Logins</a>
                      </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link bg-danger" onclick="history.go(-1);" style="border: 1px solid #dee2e6; border-radius:0.25em" id="tab-logins-tab" data-toggle="pill" href="#tab-voltar" role="tab" aria-controls="tab-logins" aria-selected="false">Voltar</a>
                      </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <!-- ====================================== TAB COM AS INFORMAÇÕES DO CLIENTE ==========================================-->
                    <div class="tab-pane fade show active" id="tab-informacoes" role="tabpanel" aria-labelledby="tab-informacoes-tab">
                      <div id="info-dados"></div>
                    </div>
                    <!-- ========================== TAB COM AS INFORMAÇÕES DAS OBRIGAÇÕES ==========================================-->
                    <div class="tab-pane fade" id="tab-obrigacoes" role="tabpanel" aria-labelledby="tab-obrigacoes-tab">
                      <div id="conteudo-obrigacoes"></div>
                    </div>
                    <!-- ============================TAB DOS FUNCIONÁRIOS================================== -->
                    <div class="tab-pane fade" id="tab-funcionarios" role="tabpanel" aria-labelledby="tab-funcionarios-tab">
                      <div id="conteudo-funcionarios"></div>
                    </div>
                    <!-- =======================================TAB DOS SOCIOS===================================== -->
                    <div class="tab-pane fade" id="tab-socios" role="tabpanel" aria-labelledby="tab-socios-tab">
                      <div id="conteudo-socios"></div>
                    </div>
                    <!-- ======================================TAB DOS CERTIFICADOS===================================== -->
                    <div class="tab-pane fade" id="tab-certificados" role="tabpanel" aria-labelledby="tab-certificados-tab">
                      <div id="conteudo-certificados"></div>
                    </div>
                    <!--============================TAB DAS CERTIDOES =================================-->
                    <div class="tab-pane fade" id="tab-certidoes" role="tabpanel" aria-labelledby="tab-certidoes-tab">
                      <div id="conteudo-certidoes"></div>
                    </div>
                    <!-- ==========================TAB DOS FATURAMENTOS ===================================== -->
                    <div class="tab-pane fade" id="tab-faturamento" role="tabpanel" aria-labelledby="tab-faturamento-tab">
                      <div id="conteudo-faturamento"></div>
                    </div>
                    <!--============================TAB DOS LOGINS ============================== -->
                    <div class="tab-pane fade" id="tab-logins" role="tabpanel" aria-labelledby="tab-logins-tab">
                      <div id="conteudo-logins"></div>
                    </div>
                  </div>
                </div>
              </div><!-- /.card -->
            </div> <!-- FIM DA PANEL BODY -->
          </div><!-- /.PANEL PRIMARY -->
        </div> <!-- /.COL MD 12 -->
      </div><!-- row -->
    </div><!-- /.content-fluid -->
  </section> <!-- /.content -->
</div><!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script>
    $(document).ready(function(){
      // ==========================================
      // CONFIGURAÇÃO DAS TABS DINÂMICAS
      // ==========================================
      const tabs = {
          '#tab-informacoes': {
              div: '#info-dados',
              url: '<?= site_url('clientes/abaClientes/'.$cliente['id']) ?>'
          },
          '#tab-obrigacoes': {
              div: '#conteudo-obrigacoes',
              url: '<?= site_url('obrigacoes_cliente/abaObrigacoesCliente/'.$cliente['id']) ?>'
          },
          '#tab-funcionarios': {
              div: '#conteudo-funcionarios',
              url: '<?= site_url('funcionarios/abaFuncionarios/'.$cliente['id']) ?>'
          },
          '#tab-socios': {
              div: '#conteudo-socios',
              url: '<?= site_url('socios/abaSocios/'.$cliente['id']) ?>'
          },
          '#tab-certificados': {
              div: '#conteudo-certificados',
              url: '<?= site_url('certificados/abaCertificados/'.$cliente['id']) ?>'
          },
          '#tab-certidoes': {
              div: '#conteudo-certidoes',
              url: '<?= site_url('certidoes/abaCertidoes/'.$cliente['id']) ?>'
          },
          '#tab-faturamento': {
              div: '#conteudo-faturamento',
              url: '<?= site_url('faturamento/abaFaturamento/'.$cliente['id']) ?>'
          },
          '#tab-logins': {
              div: '#conteudo-logins',
              url: '<?= site_url('logins/abaLogins/'.$cliente['id']) ?>'
          },
          '#tab-financeiro': {
              div: '#conteudo-financeiro',
              url: '<?= site_url('receber/abaFinanceiro/'.$cliente['id']) ?>'
          }
      };
      // ==========================================
      // FUNÇÃO DE LOAD
      // ==========================================
      window.carregarTab = function(tabId, force = false) {
        if(tabs[tabId]) {
          let tab = tabs[tabId];
          if(force || !$(tab.div).hasClass('loaded')) {
            $(tab.div).html('<div class="text-center p-3">'+'<i class="fas fa-spinner fa-spin"></i> Carregando...' +'</div>');
            $(tab.div).load(tab.url, function() {
                $(tab.div).addClass('loaded');
            });
          }
        }
      }
      //===========================================
      // DAR LOAD NAS TABS
      //===========================================
      window.reloadTab = function(tabId)
      {
        if(tabs[tabId]) {
          let tab = tabs[tabId];
          $(tab.div).removeClass('loaded');
          carregarTab(tabId, true);
        }
      }
      // ==========================================
      // CARREGA PRIMEIRA ABA
      // ==========================================
      carregarTab('#tab-informacoes');
      // ==========================================
      // EVENTO DAS TABS
      // ==========================================
      $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        let target = $(e.target).attr("href");
        // TAB VOLTAR
        if(target == '#tab-voltar') {
            window.location.href = '<?= site_url('clientes') ?>';
            return;
        }
        carregarTab(target);
        // SALVA TAB ATIVA
        localStorage.setItem(
            'clienteTab_<?= $cliente['id'] ?>',
            target
        );
      });
      // ==========================================
      // RESTAURA TAB APÓS REFRESH
      // ==========================================
      let ultimaTab = localStorage.getItem(
          'clienteTab_<?= $cliente['id'] ?>'
      );
      if(ultimaTab && tabs[ultimaTab]) {
        $('#custom-tabs-one-tab a[href="' + ultimaTab + '"]').tab('show');
        carregarTab(ultimaTab);
      }
    });
  </script>
<?= $this->endSection() ?>