<?php /** @var array $cliente */ ?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Área do Clientes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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
                <div class="tab-pane fade"
                    id="tab-funcionarios"
                    role="tabpanel">

                    <div id="conteudo-funcionarios"></div>

                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <!-- ====================================== TAB COM AS INFORMAÇÕES DO CLIENTE ==========================================-->
                    <div class="tab-pane fade show active" id="tab-informacoes" role="tabpanel" aria-labelledby="tab-informacoes-tab">
                      <table class="table table-striped table-bordered">
                        <tr>
                          <th>NOME:</th>
                          <td><?= strtoupper($cliente['fantasia']); ?></td>
                        </tr>
                        <tr>
                          <th>RAZÃO:</th>
                          <td><?= strtoupper($cliente['razao']); ?></td>
                        </tr>
                        <tr>
                          <th>CNPJ:</th>
                          <td><?= $cliente['cnpj']; ?></td>
                        </tr>
                        <tr>
                          <th>ENDEREÇO:</th>
                          <td><?= strtoupper($cliente['endereco']); ?></td>
                        </tr>
                        <tr>
                          <th>CEP:</th>
                          <td><?= strtoupper($cliente['cep']); ?></td>
                        </tr>
                        <tr>
                          <th>CIDADE:</th>
                          <td><?= strtoupper($cidade['nome_cidade']); ?></td>
                        </tr>
                        <tr>
                          <th>WHATSAPP:</th>
                          <td><?= $cliente['whatsapp']; ?></td>
                        </tr>
                        <tr>
                          <th>EMAIL:</th>
                          <td><?= $cliente['email']; ?></td>
                        </tr>
                        <tr>
                          <th>ABERTURA:</th>
                          <td><?= date('d/m/Y', strtotime($cliente['dt_abertura'])); ?></td>
                        </tr>
                        <tr>
                          <th>CADASTRO:</th>
                          <td><?= date('d/m/Y', strtotime($cliente['dt_cadastro'])); ?></td>
                        </tr>
                        <tr>
                          <th>VALOR A PAGAR:</th>
                          <td><?= $cliente['valor']; ?></td>
                        </tr>
                        <tr>
                          <th>OBSERVAÇÕES:</th>
                          <td><?= $cliente['observacoes']; ?></td>
                        </tr>
                      </table>
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
                    <div style="background:red;color:#fff;padding:20px;">
    CHEGUEI NA TAB FUNCIONÁRIOS
</div>
                    <!-- ============================TAB DOS FUNCIONÁRIOS================================== -->
                    <div class="tab-pane fade" id="tab-funcionarios" role="tabpanel" aria-labelledby="tab-funcionarios-tab">
                        <?view('funcionarios/_table', ['id_cliente' => $cliente['id']]) ?>
                    </div>
                    <!-- =======================================TAB DOS SOCIOS===================================== -->
                    <div class="tab-pane fade" id="tab-socios" role="tabpanel" aria-labelledby="tab-socios-tab">
                      <?php if(hasPermission('criarCliente')): ?>
                        <a href="<?php echo base_url('socios/create/'.$cliente['id']) ?>" class="btn btn-success btn-block"><i class="fas fa-plus-square"></i> NOVO SÓCIO</a>
                      <?php endif; ?>
                      </br>
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h5 class="text-center">SÓCIOS</h5>
                        </div>
                        <div class="card-body">
                          <?php foreach($socio_data as $s => $z) : ?>
                          <table class="table table-striped table-bordered">
                            <tr>
                              <th>NOME:</th>
                              <td class="width:10%"><?= empty($z['nome']) ?'sem socio':$z['nome']; ?></td>
                            </tr>
                            <tr>
                              <th>CPF:</th>
                              <td><?= strtoupper(empty($z['cpf']) ?'sem socio':$z['cpf']); ?></td>
                            </tr>
                            <tr>
                              <th>RG:</th>
                              <td><?= empty($z['rg']) ?'sem socio':$z['rg'] ?></td>
                            </tr>
                            <tr>
                              <th>TÍTULO:</th>
                              <td><?= strtoupper(empty($z['titulo'])) ? 'sem socio':$z['titulo'] ?></td>
                            </tr>
                            <tr>
                              <th>WHATSAPP:</th>
                              <td><?= strtoupper(empty($z['whatsapp'])) ?'sem socio':$z['whatsapp'] ?></td>
                            </tr>
                            <tr>
                              <th>ENDEREÇO:</th>
                              <td><?= strtoupper(empty($z['endereco'])) ?'sem socio':$z['endereco'] ?></td>
                            </tr>
                            <tr>
                              <th>RECIBO:</th>
                              <td><?= strtoupper(empty($z['recibo'])) ?'sem socio':$z['recibo'] ?></td>
                            </tr>
                            <tr>
                              <th>EMAIL:</th>
                              <td><?= strtoupper(empty($z['email'])) ?'sem socio':$z['email'] ?></td>
                            </tr>
                            <tr>
                              <th>NASCIMENTO:</th>
                              <td><?= (empty($z['nascimento'])) ?'sem socio':$z['nascimento']?></td>
                            </tr>
                            <tr>
                              <th>NOME DA MÃE:</th>
                              <td><?= strtoupper(empty($z['nome_mae'])) ?'sem socio':$z['nome_mae'] ?></td>
                            </tr>
                            <tr>
                              <th>OBSERVAÇÕES:</th>
                              <td><?= strtoupper(empty($z['observacoes'])) ?'sem socio':$z['observacoes'] ?></td>
                            </tr>
                            </br>
                          </table>
                        <?php endforeach; ?>
                        </div>
                      </div>
                    </div>
                    <!-- ======================================TAB DOS CERTIFICADOS===================================== -->
                    <div class="tab-pane fade" id="tab-certificados" role="tabpanel" aria-labelledby="tab-certificados-tab">
                      <?php if(hasPermission('criarCertificado')): ?>
                        <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#addModalCertificado"><i class="fas fa-plus-square"></i> NOVO CERTIFICADO</button>
                      <?php endif; ?>
                      </br>
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h5 class="text-center">CERTIFICADOS</h5>
                        </div>
                        <div class="card-body">
                          <table class="table table-striped table-bordered">
                              <th>DESCRIÇÃO</th>
                              <th>EXPIRA</th>
                              <th>SENHA</th>
                              <?php foreach($certificado_data as $k => $v ) : ?>
                                <tr>                  
                                  <td class="width:10%"><?= strtoupper(empty($v['descricao'])?'Nao tem':$v['descricao']); ?></td>
                                  <td><?= (empty($v['dt_validade'])? 'Não tem':$v['dt_validade']) ?></td>
                                  <td class="width:10%"><?= empty($v['senha'])?'não tem' :$v['senha'] ?></td>
                                </tr>
                                </a>
                              <?php endforeach; ?>
                            </table>
                        </div>
                      </div>
                    </div>
                    <!--============================TAB DAS CERTIDOES =================================-->
                    <div class="tab-pane fade" id="tab-certidoes" role="tabpanel" aria-labelledby="tab-certidoes-tab">
                      <?php if(hasPermission('criarCertidao')): ?>
                        <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#addModalCertidao"><i class="fas fa-plus-square"></i> NOVA CERTIDÃO</button>
                      <?php endif; ?>
                      </br>
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h5 class="text-center">CERTIDÕES</h5>
                        </div>
                        <div class="card-body">
                          <table class="table table-striped table-bordered">
                            <th>NOME</th>
                            <th>EXPIRA</th>
                            <?php foreach($certidao_data as $k => $v ) : ?>
                              <?php $dt_expira = empty($v['dt_expira']) ? 'nãpo tem ': $v['dt_expira'];?>
                              <tr>
                                <?php foreach($tipo_certidao as $tipo) : ?>                 
                                  <?php //if($tipo['id'] === $v['id_tipo_certidao']) : ?>
                                    <td><?= empty($tipo['nome'])?'não tem': $tipo['nome']; ?></td>
                                  <?php //endif; ?>
                                <?php endforeach; ?>
                                <td><?= empty($dt_expira) ? 'não tem ' : $dt_expira?></td>
                              </tr>
                              </a>
                            <?php endforeach; ?>
                          </table>
                        </div>
                      </div>
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
                      <?php if(hasPermission('criarLogin')): ?>
                        <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalLogins"><i class="fas fa-plus-square"></i> NOVO LOGIN</button>
                      <?php endif; ?>
                      </br>
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h5 class="text-center">LOGINS</h5>
                        </div>
                        <div class="card-body">
                          <table class="table table-striped table-bordered">
                            <th>DESCRIÇÃO</th>
                            <th>USUÁRIO</th>
                            <th>SENHA</th>
                            <?php foreach($login_data as $k => $v ) : ?>
                              <tr>                  
                                <td class="width:10%">login</td>
                                <td>usuario</td>
                                <td>senha</td>
                              </tr>
                              </a>
                            <?php endforeach; ?>
                          </table>
                        </div>
                      </div>
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
<?= view('funcionarios/_scripts', [
    'id_cliente' => $cliente['id']
]) ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script>


</script>
<?= $this->endSection() ?>