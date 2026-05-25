<?php /** @var array $empresa*/ ?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Empresa
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">  
          <div class="card-header bg-primary">
            <h5 class="text-center">DADOS GERAIS DA EMPRESA</h5>
          </div>  
          <form role="form" action="<?php base_url('empresa/update') ?>" method="post">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome_fantasia">NOME FANTASIA</label>
                    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" placeholder="Nome fantasia" value="<?= $empresa[0]['nome_fantasia'] ?>" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="razao">RAZÃO SOCIAL</label>
                    <input type="text" class="form-control" id="razao" name="razao" placeholder="Razão Social" value="<?= $empresa[0]['razao_social'] ?>" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="cnpj">CNPJ</label>
                      <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Digite o CNPJ" value="<?= $empresa[0]['cnpj'] ?>" data-inputmask='"mask": "99.999.999/9999-99"' data-mask required >
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">E-MAIL</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email da empresa" value="<?= $empresa[0]['email'] ?>" autocomplete="off" required >
                      </div>
                  </div>
              </div>                    
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header bg-primary">
                      <h5>DIAS PARA AVISOS NO SISTEMA</h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="empresa_dias_receber">CONTAS RECEBER</label>
                            <input type="number" type="number" min="1" max="100" step="1" class="form-control" id="empresa_dias_receber" name="empresa_dias_receber"  value="<?= $empresa[0]['dias_aviso_receber'] ?>">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="empresa_dias_pagar">CONTAS PAGAR</label>
                            <input type="number" type="number" min="1" max="100" step="1" class="form-control" id="empresa_dias_pagar" name="empresa_dias_pagar"  value="<?= $empresa[0]['dias_aviso_pagar'] ?>">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="empresa_dias_certificado">CERTIFICADOS</label>
                            <input type="number" type="number" min="1" max="100" step="1" class="form-control" id="empresa_dias_certificado" name="empresa_dias_certificado"  value="<?= $empresa[0]['dias_aviso_certificado'] ?>">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="empresa_dias_certidoes">CERTIDÕES</label>
                            <input type="number" type="number" min="1" max="100" step="1" class="form-control" id="empresa_dias_certidoes" name="empresa_dias_certidoes"  value="<?= $empresa[0]['dias_aviso_certidoes'] ?>">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="empresa_dias_logins">LOGINS</label>
                            <input type="number" type="number" min="1" max="100" step="1" class="form-control" id="empresa_dias_logins" name="empresa_dias_logins"  value="<?= $empresa[0]['dias_aviso_logins'] ?>">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="empresa_dias_aniversario">ANIVERSÁRIO</label>
                            <input type="number" type="number" min="1" max="100" step="1" class="form-control" id="empresa_dias_aniversario" name="empresa_dias_aniversario"  value="<?= $empresa[0]['dias_aviso_aniversario'] ?>">
                          </div>
                        </div>
                      </div><!-- div row -->
                    </div><!-- card-body -->
                  </div><!-- CARD -->
                </div>
                </div><!-- div row -->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="endereco">ENDEREÇO</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço da empresa" value="<?= $empresa[0]['endereco'] ?>" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="telefone">TELEFONE</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="<?= $empresa[0]['telefone'] ?>" data-inputmask='"mask": "(99) 9999-9999"' data-mask  autocomplete="off" required >
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="chave_pix">CHAVE PIX</label>
                    <input type="text" class="form-control" id="chave_pix" name="chave_pix" placeholder="Chave Pix" value="<?= $empresa[0]['chave_pix'] ?>" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="informacoes">INFORMAÇÕES ADICIONAIS</label>
                <textarea class="form-control" id="informacoes" name="informacoes">
                  <?= $empresa[0]['informacoes'] ?>
                </textarea>
              </div>
            </div><!-- card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">SALVAR</button>
              <a href="<?= base_url('clientes/') ?>" class="btn btn-danger">FECHAR</a>
            </div><!-- box footer -->
          </form>
        </div><!-- card -->
      </div> <!-- col-md-12 col-xs-12 -->
    </div><!-- /.row -->
  </section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script type="text/javascript">
  //==================EDITOR DE TEXTO==================================
  $("#informacoes").summernote()
  //==========================MASCARA AUTOMÁTICA =======================
  $('[data-mask]').inputmask() //PUXA AS FUNÇÕES DE MÁSCARA
  
  $("#sucesso").fadeTo(2000, 500).slideUp(500, function(){
    $("#sucesso").slideUp(500);
  });
  $("#erro").fadeTo(2000, 500).slideUp(500, function(){
    $("#erro").slideUp(500);
  });
  //==============FUNÇÃO DE ATIVAR MENU ======================
  $(function () {
    var url = window.location;
    // for single sidebar menu
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active');

    // for sidebar menu and treeview
    $('ul.nav-treeview a').filter(function () {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview")
        .css({'display': 'block'})
        .addClass('menu-open').prev('a')
        .addClass('active');
  });
</script>
<?= $this->endSection() ?>

