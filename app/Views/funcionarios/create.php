<?php
/** @var array $cliente */
?>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Cadastro de Funcionários
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
              <h3>CADASTRO DE FUNCIONÁRIO</h3>
            </div>
            <form role="form" action="<?= site_url('funcionarios/store') ?>" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <?php if(empty($cliente['id'])){ ?>
                      <div class="form-group">
                        <label for="id_cliente">CLIENTE</label>
                        <select class="form-control form-select-lg" id="id_cliente" style="width:100%" name="id_cliente" required>
                          <option value="">SELECIONE O CLIENTE</option>
                          <?php foreach($cliente as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= $c['razao'] ?></option> 
                          <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                      </div>
                    <?php }else{ ?>
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="id_cliente" value="<?= $cliente['id'] ;?>">
                      </div>
                      <div class="form-group">
                        <label for="cliente_nome">CLIENTE</label>
                        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" value="<?=$cliente['razao'];?>" readonly>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="funcionario_nome">NOME COMPLETO</label>
                      <input type="text" class="form-control" id="funcionario_nome" value="<?= old('funcionario_nome') ?>" name="funcionario_nome" placeholder="Nome completo do Funcionário" maxlength="50" autocomplete="off" required>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="funcionario_cpf">CPF</label>
                      <input type="text" class="form-control" id="funcionario_cpf" value="<?= old('funcionario_cpf') ?>" name="funcionario_cpf" placeholder="CPF do funcionário" autocomplete="off" data-inputmask='"mask": "999.999.999-99"' data-mask required >
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="funcionario_whats">DDD + WHATSAPP</label>
                      <input type="text" class="form-control" id="funcionario_whatsapp" value="<?= old('funcionario_whatsapp') ?>" name="funcionario_whatsapp" placeholder="Whatsapp " autocomplete="off" data-inputmask='"mask": "(99) 99999-9999"' data-mask required >
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_nascimento">DATA NASCIMENTO</label>
                      <input type="date" class="form-control" id="funcionario_nascimento" name="funcionario_nascimento" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_alimentacao">VALOR ALIMENTAÇÃO</label>
                      <input type="number" class="form-control" id="funcionario_alimentacao" value="<?= old('funcionario_alimentacao') ?>" step="0.01" min="0" name="funcionario_alimentacao" autocomplete="off" required>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_diaria">VALE CAFÉ</label>
                      <input type="number" class="form-control" id="funcionario_diaria" value="<?= old('funcionario_diaria') ?>" step="0.01" min="0" name="funcionario_diaria" autocomplete="off" required>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="funcionario_transporte">VALOR TRANSPORTE</label>
                      <input type="number" class="form-control" id="funcionario_transporte" value="<?= old('funcionario_transporte') ?>" step="0.01" min="0" name="funcionario_transporte" autocomplete="off" required>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div>
                  <div class="col-sm-4">               
                    <div class="form-group">
                      <label for="funcionario_email">EMAIL</label>
                      <input type="email" class="form-control" id="funcionario_email" name="funcionario_email" value="<?= old('funcionario_email') ?>" placeholder="Email do Funcionário" autocomplete="OFF"/>
                    </div>
                  </div>                  
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="funcionario_cep">CEP</label>
                      <input type="text" class="form-control" id="funcionario_cep" name="funcionario_cep" placeholder="CEP do Funcionário" value="<?= old('funcionario_cep') ?>" autocomplete="off" data-inputmask='"mask": "99999-999"' data-mask>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="funcionario_endereco">ENDEREÇO COMPLETO</label>
                      <input type="text" class="form-control" id="funcionario_endereco" name="funcionario_endereco" value="<?= old('funcionario_endereco') ?>" placeholder="Endereço do Funcionário" autocomplete="off">
                    </div>
                  </div>                  
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="funcionario_observacoes">INFORMAÇÕES</label>
                      <textarea type="text" class="form-control" id="funcionario_observacoes" name="funcionario_observacoes" value="<?= old('funcionario_observacoes') ?>" placeholder="Descreva o informações importantes do Funcionário" autocomplete="off">
                        <?= old('funcionario_observacoes') ?>
                      </textarea>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
              </div><!-- /.box-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">SALVAR</button>
                <?php if(isset($cliente['id'])): ?>
                  <a href="<?= base_url('clientes/ver/'.$cliente['id']) ?>" class="btn btn-danger">FECHAR</a>
                <?php else: ?>
                  <a href="<?= base_url('funcionarios/') ?>" class="btn btn-danger">FECHAR</a>
                <?php endif;?>
              </div><!-- card footer -->
            </form> 
          </div><!-- /.card -->         
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </div><!-- /.container fluid -->
  </section><!-- /.section -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

  <script type="text/javascript">  
    var base_url = "<?php echo base_url() ?>"//BASE PARA PEGAR A PÁGINA PRINCIPAL
  
    //==================EDITOR DE TEXTO==================================
    $("#funcionario_observacoes").summernote()
    //==========================MASCARA AUTOMÁTICA =======================
    $('[data-mask]').inputmask() //PUXA AS FUNÇÕES DE MÁSCARA
    
    $('#id_cliente').select2({
      width: '100%',
      theme: 'classic'
    });
  </script>
<?= $this->endSection() ?>