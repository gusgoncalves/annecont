<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Criar Grupo
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">GRUPO DE PERMISSÕES DE ACESSO</h3>
              </div>
              <form role="form" action="<?php echo site_url('grupos/store') ?>" method="post" class="requires-validation" novalidate>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="group_name">Nome do Grupo</label>
                        <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Digite o nome do Grupo" autocomplete="off" required>
                        <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                      </div>
                    </div><!-- div col -->
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <label for="permission"><h2>Autorizações como Criar, Modificar, Ver e Apagar afetam as permissões dos campos no decorrer do sistema.</h2></label>
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th></th>
                            <th class="bg-warning"><h2>Posso Ver?</h2> </th>
                            <th class="bg-success"><h2>Posso Criar?</h2></th></th>
                            <th class="bg-primary"><h2>Posso Modificar?</h2></th></th>
                            <th class="bg-danger"><h2>Posso Apagar?</h2></th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><b>Clientes</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verCliente"> <small>Acesso para ver a lista de clientes</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarCliente"> <small>Acesso para criar novos clientes</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarCliente"> <small>Acesso para modificar clientes</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarCliente"> <small>Acesso para remover clientes</small></td>                          
                          </tr>
                          <tr>
                            <td><b>Funcionários</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verFuncionario"> <small>Acesso para ver a lista de funcionários</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarFuncionario"> <small>Acesso para criar novos funcionários</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarFuncionario"> <small>Acesso para modificar funcionários</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarFuncionario"> <small>Acesso para remover funcionários</small></td>
                          </tr>
                          <tr>
                            <td><b>Certificados</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verCertificado"> <small>Acesso para ver a lista de certificados</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarCertificado"> <small>Acesso para criar novos certificados</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarCertificado"> <small>Acesso para modificar certificados</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarCertificado"> <small>Acesso para remover certificados</small></td>
                          </tr>
                          <tr>
                            <td><b>Certidões</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verCertidao"> <small>Acesso para ver a lista de certidões</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarCertidao"> <small>Acesso para criar novos certidões</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarCertidao"> <small>Acesso para modificar certidões</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarCertidao"> <small>Acesso para remover certidões</small></td>
                          </tr>
                          <tr>
                            <td><b>Obrigações</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verObrigacao"> <small>Acesso para ver a lista de obrigações</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarObrigacao"> <small>Acesso para criar novos obrigações</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarObrigacao"> <small>Acesso para modificar obrigações</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarObrigacao"> <small>Acesso para remover obrigações</small></td>
                          </tr>
                          <tr>
                            <td><b>Logins</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verLogin"> <small>Acesso para ver a lista de logins</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarLogin"> <small>Acesso para criar novos logins</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarLogin"> <small>Acesso para modificar logins</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarLogin"> <small>Acesso para apagar logins</small></td>
                          </tr>
                          <tr>
                            <td><b>Faturamento</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verFaturamento"> <small>Acesso para ver a lista de faturamento</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarFaturamento"> <small>Acesso para criar novos faturamento</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarFaturamento"> <small>Acesso para modificar faturamento</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarFaturamento"> <small>Acesso para remover faturamento</small></td>
                          </tr>
                          <tr>
                            <td><b>Fluxo</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verFluxo"> <small>Acesso para ver a lista de fluxo de caixa</small></td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                          </tr>
                          <tr>
                            <td><b>Pagar</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verPagar"> <small>Acesso para ver Pagar</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarPagar"> <small>Acesso para criar Pagar</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarPagar"> <small>Acesso para modificar Pagar</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarPagar"> <small>Acesso para remover Pagar</small></td>
                          </tr>
                          <tr>
                            <td><b>Receber</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verReceber"> <small>Acesso para ver Receber</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarReceber"> <small>Acesso para criar Receber</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarReceber"> <small>Acesso para modificar Receber</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarReceber"> <small>Acesso para remover Receber</small></td>
                          </tr>
                          <tr>
                            <td><b>Tipo de Conta</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verTipoConta"> <small>Acesso para ver Tipos de Conta</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarTipoConta"> <small>Acesso para criar Tipos de Conta</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarTipoConta"> <small>Acesso para modificar Tipos de Conta</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarTipoConta"> <small>Acesso para remover dados Tipos de Conta</small></td>
                          </tr>
                          <tr>
                            <td><b>Tipo de Certidão</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verTipoCertidao"> <small>Acesso para ver Tipo de Certidão</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarTipoCertidao"> <small>Acesso para criar Tipo de Certidão</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarTipoCertidao"> <small>Acesso para modificar Tipo de Certidão</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarTipoCertidao"> <small>Acesso para remover dados Tipo de Certidão</small></td>
                          </tr>
                          <tr>
                            <td><b>Porte Empresa</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verPorte"> <small>Acesso para ver Porte Empresa</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarPorte"> <small>Acesso para criar Porte Empresa</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarPorte"> <small>Acesso para modificar Porte Empresa</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarPorte"> <small>Acesso para remover dados Porte Empresa</small></td>
                          </tr>
                          <tr>
                            <td><b>Movimentação<br><small class="text-danger"> ainda não implementado</small></b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verMovimento" disabled> <small>Acesso para ver a lista de movimentação</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarMovimento" disabled> <small>Acesso para criar novos movimentação</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarMovimento" disabled> <small>Acesso para modificar movimentação</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarMovimento" disabled> <small>Acesso para remover movimentação</small></td>
                          </tr>
                          <tr>
                            <td><b>Estados</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verUF"> <small>Acesso para ver a lista de estados</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarUF"> <small>Acesso para criar novas estados</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarUF"> <small>Acesso para modificar estados</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarUF"> <small>Acesso para remover estados</small></td>
                          </tr>
                          <tr>
                            <td><b>Cidades</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verCidade"> <small>Acesso para ver a lista de cidades</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarCidade"> <small>Acesso para criar novas cidades</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarCidade"> <small>Acesso para modificar cidades</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarCidade"> <small>Acesso para remover cidades</small></td>
                          </tr>
                          <tr>
                            <td><b>Usuários</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verUser"> <small>Acesso para ver a lista de usuários</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarUser"> <small>Acesso para criar novos usuários</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarUser"> <small>Acesso para modificar usuários</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarUser"> <small>Acesso para remover usuários</small></td>
                          </tr>
                          <tr>
                            <td><b>Grupos</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verGrupo"> <small>Acesso para ver a lista de grupos</small></td>
                            <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarGrupo"> <small>Acesso para criar novos grupos</small></td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarGrupo"> <small>Acesso para modificar grupos</small></td>
                            <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarGrupo"> <small>Acesso para remover grupos</small></td>
                          </tr>                      
                          <tr>
                            <td><b>Relatórios</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verRelatorio" disabled> <small>Acesso para ver os relatórios</small></td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                          </tr>
                          <tr>
                            <td><b>Empresa</b></td>
                            <td> - </td>
                            <td> - </td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarEmpresa"> <small>Acesso para modificar empresa</small></td>
                            <td> - </td>
                          </tr>
                          <tr>
                            <td><b>Perfil</b></td>
                            <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verPerfil"> <small>Acesso para ver dados do perfil</small></td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                          </tr>
                          <tr>
                            <td><b>Editar Perfil</b></td>
                            <td> - </td>
                            <td> - </td>
                            <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="updateSetting"> <small>Acesso para modificar dados do perfil</small></td>
                            <td> - </td>
                          </tr>
                        </tbody>
                      </table>                    
                    </div><!-- div form group -->
                  </div><!-- div row -->              
                </div><!-- /.card-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-success">SALVAR</button>
                  <a href="<?php echo base_url('grupos/') ?>" class="btn btn-danger">FECHAR</a>
                </div>
              </form>
            </div><!-- /.card -->
          </div><!-- col-md-12 -->
        </div><!-- /.row -->
      </div><!-- div container fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>   
<?= $this->endSection() ?>

