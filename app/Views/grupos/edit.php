<?php
/** @var array $grupo */
?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Editar Grupo
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
              <h5 class="card-title">EDITAR PERMISSÕES DE GRUPO</h5>
            </div>
            <form role="form" action="<?= site_url('grupos/update/' . $grupo['id']) ?>" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="group_name">NOME DO GRUPO</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Digite o nome do grupo" value="<?php echo $grupo['group_name']; ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                <label for="permission"><h2>Autorizações como Criar, Modificar, Ver e Apagar afetam as permissões dos campos no decorrer do sistema.</h2></label>
                  <?php $serialize_permission = unserialize($grupo['permission']); ?>
                  <table class="table table-responsive table-striped table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th class="bg-warning"><h3>Posso Ver?</h3></th>
                        <th class="bg-success"><h3>Posso Criar?</h3></th>
                        <th class="bg-primary"><h3>Posso Modificar?</h3></th>
                        <th class="bg-danger"><h3>Posso Apagar?</h3></th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- ====================CLIENTES ============================ -->
                      <tr>
                        <td><b>Clientes</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verCliente" <?php 
                        if($serialize_permission) {
                          if(in_array('verCliente', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de clientes</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarCliente" <?php 
                        if($serialize_permission) {
                          if(in_array('criarCliente', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos clientes</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarCliente" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarCliente', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar clientes</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarCliente" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarCliente', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover clientes</small></td>
                      </tr>
                      <!-- ====================FUNCIONÁRIOS ============================ -->
                      <tr>
                        <td><b>Funcionários</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verFuncionario" <?php 
                        if($serialize_permission) {
                          if(in_array('verFuncionario', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de funcionários</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarFuncionario" <?php 
                        if($serialize_permission) {
                          if(in_array('criarFuncionario', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos funcionários</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarFuncionario" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarFuncionario', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar funcionários</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarFuncionario" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarFuncionario', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover funcionários</small></td>
                      </tr>
                      <!-- ====================CERTIFICADOS ============================ -->
                      <tr>
                        <td><b>Certificados</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verCertificado" <?php 
                        if($serialize_permission) {
                          if(in_array('verCertificado', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de certificados</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarCertificado" <?php 
                        if($serialize_permission) {
                          if(in_array('criarCertificado', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos certificados</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarCertificado" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarCertificado', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar certificados</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarCertificado" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarCertificado', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover certificados</small></td>
                      </tr>
                      <!-- ====================CERTIDOES ============================ -->
                      <tr>
                        <td><b>Certidões</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verCertidao" <?php 
                        if($serialize_permission) {
                          if(in_array('verCertidao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de certidões</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarCertidao" <?php 
                        if($serialize_permission) {
                          if(in_array('criarCertidao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos certidões</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarCertidao" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarCertidao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar certidões</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarCertidao" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarCertidao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover certidões</small></td>
                      </tr>
                      <!-- ====================OBRIGAÇÕES ============================ -->
                      <tr>
                        <td><b>Obrigações</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verObrigacao" <?php 
                        if($serialize_permission) {
                          if(in_array('verObrigacao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de obrigações</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarObrigacao" <?php 
                        if($serialize_permission) {
                          if(in_array('criarObrigacao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos obrigações</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarObrigacao" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarObrigacao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar obrigações</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarObrigacao" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarObrigacao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover obrigações</small></td>
                      </tr>
                      <!-- ====================LOGINS ============================ -->
                      <tr>
                        <td><b>Logins</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verLogin" <?php 
                        if($serialize_permission) {
                          if(in_array('verLogin', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de logins</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarLogin" <?php 
                        if($serialize_permission) {
                          if(in_array('criarLogin', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos logins</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarLogin" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarLogin', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar logins</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarLogin" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarLogin', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover logins</small></td>
                      </tr>
                      <!-- ====================FATURAMENTO ============================ -->
                      <tr>
                        <td><b>Faturamento</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verFaturamento" <?php 
                        if($serialize_permission) {
                          if(in_array('verFaturamento', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de faturamento</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarFaturamento" <?php 
                        if($serialize_permission) {
                          if(in_array('criarFaturamento', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos faturamento</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarFaturamento" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarFaturamento', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar faturamento</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarFaturamento" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarFaturamento', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover faturamento</small></td>
                      </tr>
                      <!-- ====================FLUXO DE CAIXA ============================ -->
                      <tr>
                        <td><b>Fluxo de Caixa</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verFluxo" <?php 
                        if($serialize_permission) {
                          if(in_array('verFluxo', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a Fluxo de Caixa</small></td>
                        <td> - </td>
                        
                        <td> - </td>
                        
                        <td> - </td>
                      </tr>
                      <!-- ====================PAGAR ============================ -->
                      <tr>
                        <td><b>Contas a Pagar</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verPagar" <?php 
                        if($serialize_permission) {
                          if(in_array('verPagar', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de pagar</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarPagar" <?php 
                        if($serialize_permission) {
                          if(in_array('criarPagar', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novo movimento de pagar</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarPagar" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarPagar', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar pagar</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarPagar" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarPagar', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover pagar</small></td>
                      </tr>
                      <!-- ====================RECEBER ============================ -->
                      <tr>
                        <td><b>Contas a Receber</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verReceber" <?php 
                        if($serialize_permission) {
                          if(in_array('verReceber', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de Receber</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarReceber" <?php 
                        if($serialize_permission) {
                          if(in_array('criarReceber', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novo movimento de Receber</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarReceber" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarReceber', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar Receber</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarReceber" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarReceber', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover receber</small></td>
                      </tr>
                        <!-- ====================TIPO DE CONTA ============================ -->
                        <tr>
                        <td><b>Tipo de Conta</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verTipoConta" <?php 
                        if($serialize_permission) {
                          if(in_array('verTipoConta', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de Tipo de Conta</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarTipoConta" <?php 
                        if($serialize_permission) {
                          if(in_array('criarTipoConta', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novo movimento de Tipo de Conta</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarTipoConta" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarTipoConta', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar Tipo de Conta</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarTipoConta" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarTipoConta', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover Tipo de Conta</small></td>
                      </tr>
                      <!-- ====================TIPO DE CERTIDÃO ============================ -->
                      <tr>
                        <td><b>Tipo de Certidão</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verTipoCertidao" <?php 
                        if($serialize_permission) {
                          if(in_array('verTipoCertidao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de Tipo de Certidao</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarTipoCertidao" <?php 
                        if($serialize_permission) {
                          if(in_array('criarTipoCertidao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novo movimento de Tipo de Certidao</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarTipoCertidao" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarTipoCertidao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar Tipo de Certidao</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarTipoCertidao" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarTipoCertidao', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover Tipo de Certidao</small></td>
                      </tr>
                      <!-- ====================PORTE DE EMPRESA ============================ -->
                      <tr>
                        <td><b>Porte de Empresa</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verPorte" <?php 
                        if($serialize_permission) {
                          if(in_array('verPorte', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de Porte de Empresa</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarPorte" <?php 
                        if($serialize_permission) {
                          if(in_array('criarPorte', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novo movimento de Porte de Empresa</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarPorte" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarPorte', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar Porte de Empresa</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarPorte" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarPorte', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover Porte de Empresa</small></td>
                      </tr>
                      <!-- ====================MOVIMENTAÇÃO ============================ -->
                      <tr>
                        <td><b>Movimentação<br><small class="text-danger"> ainda não implementado</small></b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" disabled value="verMovimento" <?php 
                        if($serialize_permission) {
                          if(in_array('verMovimento', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de movimentação</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" disabled value="criarMovimento" <?php 
                        if($serialize_permission) {
                          if(in_array('criarMovimento', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos movimentação</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" disabled value="modificarMovimento" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarMovimento', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar movimentação</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" disabled value="apagarMovimento" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarMovimento', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover movimentação</small></td>
                      </tr>
                      <!-- ====================ESTADOS ============================ -->
                      <tr>
                        <td><b>Estados</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verUF" <?php 
                        if($serialize_permission) {
                          if(in_array('verUF', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de estados</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarUF" <?php 
                        if($serialize_permission) {
                          if(in_array('criarUF', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos estados</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarUF" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarUF', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar estados</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarUF" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarUF', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para apagar estados</small></td>
                      </tr>
                      <!-- ====================CIDADES ============================ -->
                      <tr>
                        <td><b>Cidades</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verCidade" <?php 
                        if($serialize_permission) {
                          if(in_array('verCidade', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de cidades</small></td>
                        
                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarCidade" <?php 
                        if($serialize_permission) {
                          if(in_array('criarCidade', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novas cidades</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarCidade" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarCidade', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar cidades</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarCidade" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarCidade', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover cidades</small></td>
                      </tr>
                      <!-- ====================USUÁRIOS ============================ -->
                      <tr>
                        <td><b>Usuários</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verUser" <?php 
                        if($serialize_permission) {
                          if(in_array('verUser', $serialize_permission)) { echo "checked"; }   
                        }
                        ?>> <small>Acesso para ver a lista de usuários</small></td>

                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarUser" <?php if($serialize_permission) {
                          if(in_array('criarUser', $serialize_permission)) { echo "checked"; } 
                        } ?> > <small>Acesso para criar novos usuários</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarUser" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarUser', $serialize_permission)) { echo "checked"; } 
                        }
                        ?>> <small>Acesso para modificar usuários</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarUser" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarUser', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover usuários</small></td>
                      </tr>
                      <!-- ====================GRUPOS ============================ -->
                      <tr>
                        <td><b>Grupos</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verGrupo" <?php 
                        if($serialize_permission) {
                          if(in_array('verGrupo', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver a lista de grupos</small></td>

                        <td class="bg-success"><input type="checkbox" name="permission[]" id="permission" value="criarGrupo" <?php 
                        if($serialize_permission) {
                          if(in_array('criarGrupo', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para criar novos grupos</small></td>
                        
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarGrupo" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarGrupo', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar grupos</small></td>
                        
                        <td class="bg-danger"><input type="checkbox" name="permission[]" id="permission" value="apagarGrupo" <?php 
                        if($serialize_permission) {
                          if(in_array('apagarGrupo', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para remover grupos</small></td>
                      </tr>                      
                      <!-- ====================MOVIMENTAÇÃO ============================ -->
                      <tr>
                        <td><b>Relatórios</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verRelatorio" <?php 
                        if($serialize_permission) {
                          if(in_array('verRelatorio', $serialize_permission)) { echo "checked"; }  
                        }
                        ?> disabled> <small>Acesso para ver os relatórios</small></td>
                        
                        <td> - </td>
                        
                        <td> - </td>
                        
                        <td> - </td>
                      </tr>
                      <!-- ====================EMPRESA ============================ -->
                      <tr>
                        <td><b>Empresa</b></td>
                        <td> - </td>
                        <td> - </td>
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="modificarEmpresa" <?php 
                        if($serialize_permission) {
                          if(in_array('modificarEmpresa', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar empresa</small></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td><b>Perfil</b></td>
                        <td class="bg-warning"><input type="checkbox" name="permission[]" id="permission" value="verPerfil" <?php 
                        if($serialize_permission) {
                          if(in_array('verPerfil', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para ver dados do perfil</small></td>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <!-- ====================PERFIL ============================ -->
                      <tr>
                        <td><b>Editar Perfil</b></td>
                        <td> - </td>
                        <td> - </td>
                        <td class="bg-primary"><input type="checkbox" name="permission[]" id="permission" value="updateSetting" <?php 
                        if($serialize_permission) {
                          if(in_array('updateSetting', $serialize_permission)) { echo "checked"; }  
                        }
                        ?>> <small>Acesso para modificar dados do perfil</small></td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">ATUALIZAR</button>
                <a href="<?php echo base_url('grupos/') ?>" class="btn btn-danger">FECHAR</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div><!-- col-md-12 -->
    </div><!-- /.row -->
  </section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script type="text/javascript">
    //===========================validador de campos obrigatórios ===========================
    $(function () {
      'use strict'
      const forms = document.querySelectorAll('.requires-validation')
      Array.from(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
    });
    //===============FUNÇÃO PARA EXIBIR TOAST DE SUCESSO OU ERRO APÓS AÇÃO ============
    function showToast(message, type = 'success') {
      let bg = 'bg-success';
      if (type === 'error') {
        bg = 'bg-danger';
      }
      if (type === 'warning') {
        bg = 'bg-warning';
      }
      let toast = $(`
        <div class="toast ${bg} text-white border-0 mb-3 shadow-lg"
             role="alert"
             style="
                min-width: 400px;
                padding: 10px;
                border-radius: 12px;
                font-size: 1rem;
             ">
            <div class="d-flex align-items-center">
                <div class="toast-body"
                     style="
                        padding: 15px 20px;
                        font-weight: 600;
                        line-height: 1.5;
                     ">
                    ${message}
                </div>
            </div>
        </div>
      `);
      $("#toast-container").append(toast);
      let bsToast = new bootstrap.Toast(toast[0], {
        delay: 6000 // 6 segundos
      });
      bsToast.show();
      toast.on('hidden.bs.toast', function() {
        $(this).remove();
      });
    }
	  //=========================================================
    <?php if (session()->getFlashdata('success')): ?>
      showToast("<?= session()->getFlashdata('success') ?>", "success");
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
      showToast("<?= session()->getFlashdata('errors') ?>", "error");
    <?php endif; ?>
  </script>
<?= $this->endSection() ?>  

