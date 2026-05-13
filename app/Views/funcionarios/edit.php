<?php
/** @var array $funcionario */
?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Edição de Funcionários
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
              <h3>ALTERAÇÃO DE FUNCIONÁRIO</h3>
            </div>
            <form role="form" action="<?= site_url('funcionarios/update/' . $funcionario['id']) ?>" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?=$funcionario['id_cliente'] ?>"/>
                      <label for="funcionario_nome">NOME COMPLETO</label>
                      <input type="text" class="form-control" id="funcionario_nome" name="funcionario_nome" placeholder="Nome completo do Funcionário" maxlength="50" autocomplete="off" value="<?=old('funcionario_nome', $funcionario['nome']) ?>" autocomplete="off" required/>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="funcionario_cpf">CPF</label>
                      <input type="text" class="form-control" id="funcionario_cpf" name="funcionario_cpf" placeholder="CPF do funcionário" autocomplete="off" value="<?=old('funcionario_cpf', $funcionario['cpf']) ?>" data-inputmask='"mask": "999.999.999-99"' data-mask required />
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="funcionario_whats">DDD + WHATSAPP</label>
                      <input type="text" class="form-control" id="funcionario_whats" name="funcionario_whats" placeholder="Whatsapp " autocomplete="off" value="<?=old('funcionario_whats', $funcionario['whatsapp']) ?>" data-inputmask='"mask": "(99) 99999-9999"' data-mask/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_nascimento">DATA NASCIMENTO</label>
                      <input type="date" class="form-control" id="funcionario_nascimento" name="funcionario_nascimento" autocomplete="off" value="<?=old('funcionario_nascimento', $funcionario['nascimento']) ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_alimentacao">VALOR ALIMENTAÇÃO</label>
                      <input type="number" class="form-control" id="funcionario_alimentacao" step="0.01" min="0" name="funcionario_alimentacao" autocomplete="off" value="<?=old('funcionario_alimentacao', $funcionario['alimentacao']) ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_diaria">VALE CAFÉ</label>
                      <input type="number" class="form-control" id="funcionario_diaria" step="0.01" min="0" name="funcionario_diaria" autocomplete="off" value="<?=old('funcionario_diaria', $funcionario['diaria']) ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_transporte">VALOR TRANSPORTE</label>
                      <input type="number" class="form-control" id="funcionario_transporte" step="0.01" min="0" name="funcionario_transporte" autocomplete="off" value="<?=old('funcionario_transporte', $funcionario['transporte']) ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-4">               
                    <div class="form-group">
                      <label for="funcionario_email">EMAIL</label>
                      <input type="email" class="form-control" id="funcionario_email" name="funcionario_email" placeholder="Email do Funcionário" autocomplete="OFF" value="<?=old('funcionario_email', $funcionario['email']) ?>"/>
                    </div>
                  </div>
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="funcionario_cep">CEP </label>
                      <input type="text" class="form-control" id="funcionario_cep" name="funcionario_cep" placeholder="Código postal do Funcionário" autocomplete="off" value="<?=old('funcionario_cep', $funcionario['cep']) ?>" data-inputmask='"mask": "99999-999"' data-mask/>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="funcionario_endereco">ENDEREÇO COMPLETO </label>
                      <input type="text" class="form-control" id="funcionario_endereco" name="funcionario_endereco" placeholder="Endereço do Funcionário" autocomplete="off" value="<?=old('funcionario_endereco', $funcionario['endereco']) ?>"/>
                    </div>
                  </div>                  
                </div>
                <div class="form-group">
                  <label for="funcionario_observacoes">INFORMAÇÕES</label>
                  <textarea type="text" class="form-control" id="funcionario_observacoes" name="funcionario_observacoes" placeholder="Descreva o informações importantes do Funcionário" autocomplete="off">
                    <?= old('funcionario_observacoes', $funcionario['observacoes']) ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="funcionario_ativo">Ativo</label>
                  <select class="form-control" id="funcionario_ativo" name="funcionario_ativo"> 
                    <option value="1" <?= old('funcionario_ativo', $funcionario['ativo']) == 1 ? 'selected="selected"' : '' ?>>Sim</option>
                    <option value="2" <?= old('funcionario_ativo', $funcionario['ativo']) == 2 ? 'selected="selected"' : '' ?>>Não</option>
                  </select>
                </div>
              </div><!-- /.card-body -->
              <div class="card-footer">
              <button type="submit" class="btn btn-success">SALVAR</button>
              <?php if(!empty($funcionario['id_cliente'])): ?>
                <a href="<?= base_url('clientes/ver/'.$funcionario['id_cliente']) ?>" class="btn btn-danger">FECHAR</a>
              <?php else: ?>
                <a href="<?= base_url('funcionario/') ?>" class="btn btn-danger">FECHAR</a>
              <?php endif;?>  
              </div><!-- card footer -->
            </form>
          </div><!-- /.card -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </div>  <!-- /.container fluid -->
  </section> <!-- /.section -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

  <script type="text/javascript">
  
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
<?= $this->endSection() ?>