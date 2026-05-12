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
              <h3>ALTERAÇÃO DE SÓCIO</h3>
            </div>
            <form role="form" action="" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="socio_nome">NOME COMPLETO</label>
                      <input type="text" class="form-control" id="socio_nome" name="socio_nome" placeholder="Nome completo do Sócio" maxlength="50" value="<?php echo !empty($this->input->post('socio_nome')) ?:$socio_data['nome'] ?>" autocomplete="off" required/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_cpf">CPF</label>
                      <input type="text" class="form-control" id="socio_cpf" name="socio_cpf" placeholder="CPF do Sócio" maxlength="50" value="<?php echo !empty($this->input->post('socio_cpf')) ?:$socio_data['cpf'] ?>" data-inputmask='"mask": "999.999.999-99"' data-mask required/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_rg">RG</label>
                      <input type="text" class="form-control" id="socio_rg" name="socio_rg" placeholder="RG do Sócio" maxlength="50" value="<?php echo !empty($this->input->post('socio_rg')) ?:$socio_data['rg'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_titulo">TÍTULO DE ELEITOR</label>
                      <input type="text" class="form-control" id="socio_titulo" name="socio_titulo" placeholder="Título do Sócio" maxlength="50" value="<?php echo !empty($this->input->post('socio_titulo')) ?:$socio_data['titulo'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_whats">DDD + WHATSAPP</label>
                      <input type="text" class="form-control" id="socio_whats" name="socio_whats" placeholder="Whatsapp " value="<?php echo !empty($this->input->post('socio_whats')) ?:$socio_data['whatsapp'] ?>" data-inputmask='"mask": "(99) 9999-9999"' data-mask autocomplete="off">
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_nascimento">DATA NASCIMENTO</label>
                      <input type="date" class="form-control" id="socio_nascimento" name="socio_nascimento" value="<?php echo !empty($this->input->post('socio_nascimento')) ?:$socio_data['nascimento'] ?>" autocomplete="off" required/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_mae">ENDEREÇO COMPLETO</label>
                      <input type="text" class="form-control" id="socio_mae" name="socio_mae" placeholder="Nome da Mãe" value="<?php echo !empty($this->input->post('socio_mae')) ?:$socio_data['nome_mae'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_endereco">ENDEREÇO COMPLETO</label>
                      <input type="text" class="form-control" id="socio_endereco" name="socio_endereco" placeholder="Endereço do Sócio" value="<?php echo !empty($this->input->post('socio_endereco')) ?:$socio_data['endereco'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_recibo">RECIBO DO IMPOSTO</label>
                      <input type="text" class="form-control" id="socio_recibo" name="socio_recibo" placeholder="Recibo do Imposto de Renda" value="<?php echo !empty($this->input->post('socio_recibo')) ?:$socio_data['recibo'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">               
                    <div class="form-group">
                      <label for="socio_email">EMAIL</label>
                      <input type="email" class="form-control" id="socio_email" name="socio_email" placeholder="Email do Sócio" value="<?php echo !empty($this->input->post('socio_email')) ?:$socio_data['email'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="socio_observacoes">INFORMAÇÕES</label>
                      <textarea type="text" class="form-control" id="socio_observacoes" name="socio_observacoes" placeholder="Descreva o informações importantes do Sócio"/>
                        <?php echo !empty($this->input->post('socio_observacoes')) ?:$socio_data['observacoes'] ?>
                      </textarea>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
              </div><!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">SALVAR</button>
                <a href="<?php echo base_url('socios') ?>" class="btn btn-danger">FECHAR</a>
              </div><!-- div footer -->
            </form>
          </div><!-- /.card -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </div><!-- /.container fluid -->
  </section><!-- /.section -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
  var base_url = "<?= base_url() ?>"
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
  $("#socio_observacoes").summernote()
  //==========================MASCARA AUTOMÁTICA =======================
  $('[data-mask]').inputmask() //PUXA AS FUNÇÕES DE MÁSCARA
</script>