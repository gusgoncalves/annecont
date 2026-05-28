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
                    <!-- ====================================== TAB COM AS INFORMAÇÕES DAS OBRIGAÇÕES ==========================================-->
                    <div class="tab-pane fade" id="tab-obrigacoes" role="tabpanel" aria-labelledby="tab-obrigacoes-tab">
                      <div id="obrigacoes">
                        <table class="table table-striped table-bordered">
                          <th style="text-align:center;">TAREFA</th>
                          <th style="text-align:center;">AÇÃO</th>                        
                          <?php if (!empty($obrigacoes_cobrada['id_cliente']) && $obrigacoes_cobrada['id_cliente'] = $cliente['id']){?>
                            <tr class="success">                          
                              <td colspan="2" width="50%" style="text-align:center;">OBRIGAÇOES PARA PROCESSO DE COBRANÇA</td>
                            </tr>
                          <?php }else { ?>
                            <?php foreach($obrigacoes_data as $k ) : ?>
                              <!-- ============= SE A OBRIGAÇÃO ESTIVER COM O STATUS FEITO NO BANCO COM NUMERO 2 -->
                              <?php if($k['feito']==2){ ?>
                                <tr class="success">                          
                                  <td width="50%" style="text-align:center;text-decoration: line-through;"><?= $k['descricao'];?></td>
                                  <td width="40%" style="text-align:center;text-decoration: line-through;">Feito em <?= date('d/m/Y',strtotime($k['dt_ultimo']));?></td>
                                </tr> 
                              <?php }else{ ?>
                                <!-- =================== SE NÃO ESTIVER FEITO MOSTRA APENAS AS OBRIGAÇÕES E O BOTÃO -->
                                <tr>
                                  <td style="text-align:center"><?= $k['descricao'];?></td>
                                  <td style="text-align:center"><button type="button" class="btn btn-success" onclick="obrigacaoFunc(<?=$k['id_obrigacao'];?>,<?=$k['id_cliente'];?>)" data-toggle="modal" title="Realizar essa Obrigação" data-target="#feitoModal"><i class="fa fa-check"></i></button></td>
                                </tr>
                              <?php } ?>
                            <?php endforeach ; ?>
                          <?php } ?>
                        </table>
                        <?php if(!empty($k['dt_ultimo'])){ ?>
                          <h3>Finalizado em: <?= date('d/m/Y',strtotime($k['dt_ultimo']));?></h3>
                          <?php } ?>
                        <!-- ==================VERIFICA SE O CLIENTE NÃO ESTÁ EM PROCESSO DE FINALIZAÇÃO=================== -->
                        <?php if (empty($obrigacoes_cobrada['id_cliente'])){?>
                          <!-- ========================VERIFICA SE TODAS AS TAREFAS DO CLIENTE FORAM FEITAS E CRIA O BOTÃO FINALIZAR====================== -->
                          <?php if($obrigacoes_feito['realizado'] ==0 && !empty($k['id_cliente'])) :?>
                            <a href="<?php echo base_url('clientes/finalizarObrigacoes/'.$cliente['id']) ?>" class="btn btn-success"><i class="fas fa-plus-money"></i> FINALIZAR</a>
                          <?php endif ?>
                        <!-- ================CASO O CLIENTE JA TENHA O PROCESSO DE COBRANÇA ATIVO, HABILITA O BOTÃO COBRAR ======================= -->
                        <?php }else {?>
                          <a href="<?php echo base_url('clientes/cobrar/'.$cliente['id']) ?>" class="btn btn-success"><i class="fas fa-plus-money"></i> COBRAR</a>
                        <?php } ?>
                      </div>
                      <div id="acoes">
                        <br>
                        <?php if(hasPermission('criarObrigacao')): ?>
                          <a href="<?php echo base_url('obrigacoes/inserir_obrigacao_cliente/'.$cliente['id']) ?>" class="btn btn-lg btn-success btn-block"><i class="fas fa-plus-square"></i> INSERIR OBRIGAÇÕES</a>
                        <?php endif; ?>
                        <?php if(hasPermission('modificarObrigacao')): ?>
                          <a href="<?php echo base_url('obrigacoes/remover_obrigacao_cliente/'.$cliente['id']) ?>" class="btn btn-lg btn-danger btn-block"><i class="fas fa-minus-square"></i> REMOVER OBRIGAÇÕES</a>
                        <?php endif; ?>
                      </div>
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
                      <?php if(hasPermission('criarFaturamento')): ?>
                        <button class="btn btn-block btn-success" data-toggle="modal" data-target="#addModalFaturamento"><i class="fas fa-plus-square"></i> NOVO FATURAMENTO</button>
                      <?php endif; ?>
                      </br>
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h5 class="text-center">FATURAMENTO</h5>
                        </div>
                        <div class="card-body">
                          <table class="table table-striped table-bordered">
                            <th>ANO</th>
                            <th>MÊS</th>
                            <th>VALOR</th>
                            <?php foreach($faturamento_data as $k => $v ) : ?>
                              <tr>
                                <td class="width:10%"><?= empty($v['ano'])?'não tem' : $v['ano']; ?></td>                  
                                <td class="width:10%"><?= empty($v['mes'])?'não tme':$v['mes']; ?></td>
                                <td>R$ <?= empty($v['valor'])?'nao tem ':$v['valor']?></td>
                              </tr>
                            <?php endforeach; ?>
                              <tr colspan="1">
                                <td></td>
                                <td></td>
                                <?php //if($total_faturamento['valor'] !== NULL) : ?>
                                  <td class="bg-warning"><b><h3>R$ 1000</h3></b></td>
                                <?php //endif; ?>
                              </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <!--============================TAB DOS LOGINS ============================== -->
                    <div class="tab-pane fade" id="tab-logins" role="tabpanel" aria-labelledby="tab-logins-tab">
          
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
<!-- ===============================MODAL OBRIGAÇÕES FEITAS =================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="feitoModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title">EXECUTAR TAREFA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('clientes/obrigacoesFeito') ?>" method="post" id="obrigacoesForm">
        <div class="modal-body">
          <p><b>Tem certeza que deseja realizar esta tarefa?</b></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">SIM</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ==================================MODAL DE ADICIONAR FATURAMENTO============================================================= -->
<?php if(hasPermission('criarFaturamento')): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="addModalFaturamento">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">NOVO FATURAMENTO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('faturamento/create/'.$cliente['id']) ?>" class="requires-validation" method="post" id="createForm" novalidate>
        <div class="modal-body">
          <div class="form-group">
            <label for="mes">MÊS</label>
            <select class="form-control" id="mes" name="mes" required>
              <?php foreach($combo_meses as $m):?>
                <option value="">SELECIONE O MÊS</option>
                <option value="<?= $m['id']?>"><?= $m['nome'] ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="faturamento_ano">ANO</label>
                <input type="text" class="form-control" id="faturamento_ano" name="faturamento_ano"  maxlength="4" pattern="[0-9]{4}" value="<?=date('Y');?>" required>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="faturamento_valor">VALOR</label>
                <input type="number" class="form-control" id="faturamento_valor" name="faturamento_valor" step="0.01" autocomplete="off" required>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">SALVAR</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>
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
              url: '<?= site_url('obrigacoes/abaObrigacoes/'.$cliente['id']) ?>'
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
            $(tab.div).html(
              '<div class="text-center p-3">' +
              '<i class="fas fa-spinner fa-spin"></i> Carregando...' +
              '</div>'
            );
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