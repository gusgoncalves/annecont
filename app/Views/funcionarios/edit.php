
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
              <h3>ALTERAÇÃO DE FUNCIONÁRIO</h3>
            </div>
            <form role="form" action="" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?=$funcionario_data['id_cliente'] ?>"/>
                      <label for="funcionario_nome">NOME COMPLETO</label>
                      <input type="text" class="form-control" id="funcionario_nome" name="funcionario_nome" placeholder="Nome completo do Funcionário" maxlength="50" autocomplete="off" value="<?=!empty($this->input->post('funcionario_nome')) ?:$funcionario_data['nome'] ?>" autocomplete="off" required/>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="funcionario_cpf">CPF</label>
                      <input type="text" class="form-control" id="funcionario_cpf" name="funcionario_cpf" placeholder="CPF do funcionário" autocomplete="off" value="<?= !empty($this->input->post('funcionario_cpf')) ?:$funcionario_data['cpf'] ?>" data-inputmask='"mask": "999.999.999-99"' data-mask required />
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="funcionario_whats">DDD + WHATSAPP</label>
                      <input type="text" class="form-control" id="funcionario_whats" name="funcionario_whats" placeholder="Whatsapp " autocomplete="off" value="<?php echo !empty($this->input->post('funcionario_whats')) ?:$funcionario_data['whatsapp'] ?>" data-inputmask='"mask": "(99) 99999-9999"' data-mask/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_nascimento">DATA NASCIMENTO</label>
                      <input type="date" class="form-control" id="funcionario_nascimento" name="funcionario_nascimento" autocomplete="off" value="<?php echo !empty($this->input->post('funcionario_nascimento')) ?:$funcionario_data['nascimento'] ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_alimentacao">VALOR ALIMENTAÇÃO</label>
                      <input type="number" class="form-control" id="funcionario_alimentacao" step="0.01" min="0" name="funcionario_alimentacao" autocomplete="off" value="<?php echo !empty($this->input->post('funcionario_alimentacao')) ?:$funcionario_data['alimentacao'] ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_diaria">VALE CAFÉ</label>
                      <input type="number" class="form-control" id="funcionario_diaria" step="0.01" min="0" name="funcionario_diaria" autocomplete="off" value="<?php echo !empty($this->input->post('funcionario_diaria')) ?:$funcionario_data['diaria'] ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_transporte">VALOR TRANSPORTE</label>
                      <input type="number" class="form-control" id="funcionario_transporte" step="0.01" min="0" name="funcionario_transporte" autocomplete="off" value="<?php echo !empty($this->input->post('funcionario_transporte')) ?:$funcionario_data['transporte'] ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-4">               
                    <div class="form-group">
                      <label for="funcionario_email">EMAIL</label>
                      <input type="email" class="form-control" id="funcionario_email" name="funcionario_email" placeholder="Email do Funcionário" autocomplete="OFF" value="<?php echo !empty($this->input->post('funcionario_email')) ?:$funcionario_data['email'] ?>"/>
                    </div>
                  </div>
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="funcionario_cep">CEP </label>
                      <input type="text" class="form-control" id="funcionario_cep" name="funcionario_cep" placeholder="Código postal do Funcionário" autocomplete="off" value="<?php echo !empty($this->input->post('funcionario_cep')) ?:$funcionario_data['cep'] ?>" data-inputmask='"mask": "99999-999"' data-mask/>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="funcionario_endereco">ENDEREÇO COMPLETO </label>
                      <input type="text" class="form-control" id="funcionario_endereco" name="funcionario_endereco" placeholder="Endereço do Funcionário" autocomplete="off" value="<?php echo !empty($this->input->post('funcionario_endereco')) ?:$funcionario_data['endereco'] ?>"/>
                    </div>
                  </div>                  
                </div>
                <div class="form-group">
                  <label for="funcionario_observacoes">INFORMAÇÕES</label>
                  <textarea type="text" class="form-control" id="funcionario_observacoes" name="funcionario_observacoes" placeholder="Descreva o informações importantes do Funcionário" autocomplete="off">
                    <?php echo !empty($this->input->post('funcionario_observacoes')) ?:$funcionario_data['observacoes'] ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="funcionario_ativo">Ativo</label>
                  <select class="form-control" id="funcionario_ativo" name="funcionario_ativo"> 
                    <option value="1" <?php if($funcionario_data['ativo'] == 1) { echo 'selected="selected"'; } ?>>Sim</option>
                    <option value="2" <?php if($funcionario_data['ativo'] == 2) { echo 'selected="selected"'; } ?>>Não</option>
                  </select>
                </div>
              </div><!-- /.card-body -->
              <div class="card-footer">
              <button type="submit" class="btn btn-success">SALVAR</button>
              <?php if(!empty($funcionario_data['id_cliente'])): ?>
                <a href="<?= base_url('clientes/ver/'.$funcionario_data['id_cliente']) ?>" class="btn btn-danger">FECHAR</a>
              <?php else: ?>
                <a href="<?= base_url('funcionarios/') ?>" class="btn btn-danger">FECHAR</a>
              <?php endif;?>  
              </div><!-- card footer -->
            </form>
          </div><!-- /.card -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </div>  <!-- /.container fluid -->
  </section> <!-- /.section -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
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
 $(function() {
    var url = window.location.href;

    // Ativar o link diretamente acessado no menu
    $('ul.nav-sidebar a, ul.nav-treeview a').filter(function() {
        return this.href === url || url.startsWith(this.href);
      }).addClass('active')
      .closest('.nav-treeview') // Ativa o submenu se necessário
      .css({
        'display': 'block'
      })
      .addClass('menu-open')
      .prev('a') // Ativa o menu principal
      .addClass('active');
  });
  //==================EDITOR DE TEXTO==================================
  $("#funcionario_observacoes").summernote()
  //==========================MASCARA AUTOMÁTICA =======================
  $('[data-mask]').inputmask() //PUXA AS FUNÇÕES DE MÁSCARA
  
  $("#sucesso").fadeTo(2000, 500).slideUp(500, function(){
    $("#sucesso").slideUp(500);
  });
  $("#erro").fadeTo(2000, 500).slideUp(500, function(){
    $("#erro").slideUp(500);
  });
</script>