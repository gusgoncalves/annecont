<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div id="messages"></div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header bg-primary">
              <h3>CADASTRO DE SÓCIO</h3>
            </div>
            <form role="form" action="" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <?php if(empty($cliente_data['id'])): ?>
                      <div class="form-group">
                        <label for="id_cliente">CLIENTE</label>
                        <select class="form-control form-select-lg" id="id_cliente" style="width:100%" name="id_cliente">
                          <?php echo $combo_cliente?>
                        </select>
                      </div>
                    <?php else: ?>
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="id_cliente" value="<?= $cliente_data['id'] ;?>">
                      </div>
                      <div class="form-group">
                        <label for="cliente_nome">CLIENTE</label>
                        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" value="<?=$cliente_data['fantasia'];?>" readonly>
                      </div>
                    <?php endif; ?>
                  </div><!-- col -->           
                </div><!-- row -->
                <div class="row">
                  <div class="col-md-12">              
                    <div class="form-group">
                      <label for="socio_nome">NOME COMPLETO</label>
                      <input type="text" class="form-control" id="socio_nome" name="socio_nome" placeholder="Nome completo do Sócio" maxlength="50" autocomplete="off" required>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_cpf">CPF</label>
                      <input type="text" class="form-control" id="socio_cpf" name="socio_cpf" placeholder="CPF do Sócio" maxlength="50" autocomplete="off" data-inputmask='"mask": "999.999.999-99"' data-mask required >
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_rg">RG</label>
                      <input type="text" class="form-control" id="socio_rg" name="socio_rg" placeholder="RG do Sócio" maxlength="50" autocomplete="off" >
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_titulo">TÍTULO DE ELEITOR</label>
                      <input type="text" class="form-control" id="socio_titulo" name="socio_titulo" placeholder="Título do Sócio" maxlength="50" autocomplete="off" >
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_whats">DDD + WHATSAPP</label>
                      <input type="text" class="form-control" id="socio_whats" name="socio_whats" placeholder="Whatsapp " autocomplete="off" data-inputmask='"mask": "(99) 9999-9999"' data-mask >
                    </div>
                  </div><!-- col-->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_nascimento">DATA NASCIMENTO</label>
                      <input type="date" class="form-control" id="socio_nascimento" name="socio_nascimento" autocomplete="off">
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_mae">NOME DA MÃE</label>
                      <input type="text" class="form-control" id="socio_mae" name="socio_mae" placeholder="Nome da Mãe" autocomplete="off">
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_endereco">ENDEREÇO COMPLETO</label>
                      <input type="text" class="form-control" id="socio_endereco" name="socio_endereco" placeholder="Endereço do Sócio" autocomplete="off">
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_recibo">RECIBO DO IMPOSTO</label>
                      <input type="text" class="form-control" id="socio_recibo" name="socio_recibo" placeholder="Recibo do Imposto de Renda" autocomplete="off">
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">               
                    <div class="form-group">
                      <label for="socio_email">EMAIL</label>
                      <input type="email" class="form-control" id="socio_email" name="socio_email" placeholder="Email do Sócio" autocomplete="OFF"/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="socio_observacoes">INFORMAÇÕES</label>
                      <textarea type="text" class="form-control" id="socio_observacoes" name="socio_observacoes" placeholder="Descreva o informações importantes do Sócio" autocomplete="off">
                      <?php echo $this->input->post('socio_observacoes') ?>
                      </textarea>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
              </div><!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">SALVAR</button>
                <?php if(isset($cliente_data['id'])): ?>
                  <a href="<?php echo base_url('clientes/ver/'.$cliente_data['id']) ?>" class="btn btn-danger">FECHAR</a>
                <?php else: ?>
                  <a href="<?php echo base_url('socios/') ?>" class="btn btn-danger">FECHAR</a>
                <?php endif;?>
              </div><!-- div -->
            </form>
          </div><!-- card -->
        </div><!-- div col -->
      </div><!-- div row -->
    </div><!-- /.container fluid -->
  </section><!-- /.section -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
  var base_url = "<?php echo base_url() ?>"
  //==============================FUNÇÃO PARA VERIFICAR VALIDAÇÃO DE FORMULÁRIO ==========================
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
  //=======================ATIVAR O MENU ===========================
$(function () {
    var url = window.location.href;

    // Ativar o link diretamente acessado no menu
    $('ul.nav-sidebar a, ul.nav-treeview a').filter(function () {
        return this.href === url || url.startsWith(this.href);
    }).addClass('active')
    .closest('.nav-treeview') // Ativa o submenu se necessário
    .css({'display': 'block'})
    .addClass('menu-open')
    .prev('a') // Ativa o menu principal
    .addClass('active');
});
  //==================EDITOR DE TEXTO==================================
  $("#socio_observacoes").summernote();
  //==========================MASCARA AUTOMÁTICA =======================
  $('[data-mask]').inputmask(); //PUXA AS FUNÇÕES DE MÁSCARA
  //==========================MASCARA SELECT 2 =======================
  $('#id_cliente').select2();
  
  $("#sucesso").fadeTo(2000, 500).slideUp(500, function(){
    $("#sucesso").slideUp(500);
  });
  $("#erro").fadeTo(2000, 500).slideUp(500, function(){
    $("#erro").slideUp(500);
  });
</script>