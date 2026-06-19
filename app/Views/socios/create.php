<?php /** @var array $cliente */ ?>
<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Cadastro Sócios
<?= $this->endSection() ?>
<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
              <h3>Cadastro de Sócios <b>Cliente:</b> <b><?= strtoupper($cliente['razao']) ?></b></h3>
            </div>
            <form role="form" action="<?= site_url('socios/store')?>" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">              
                    <div class="form-group">
                      <input type="hidden" name="id_cliente" value="<?= $cliente['id'] ?>">
                      <label for="socio_nome">NOME COMPLETO</label>
                      <input type="text" class="form-control" id="socio_nome" name="socio_nome" placeholder="Nome completo do Sócio" value="<?= old('socio_nome') ?>" maxlength="50" autocomplete="off" required>
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_cpf">CPF</label>
                      <input type="text" class="form-control" id="socio_cpf" name="socio_cpf" placeholder="CPF do Sócio"  value="<?= old('socio_cpf') ?>" maxlength="50" autocomplete="off" data-inputmask='"mask": "999.999.999-99"' data-mask required >
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_rg">RG</label>
                      <input type="text" class="form-control" id="socio_rg" name="socio_rg" placeholder="RG do Sócio" value="<?= old('socio_rg') ?>" maxlength="50" autocomplete="off" >
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_titulo">TÍTULO DE ELEITOR</label>
                      <input type="text" class="form-control" id="socio_titulo" name="socio_titulo" placeholder="Título do Sócio" value="<?= old('socio_titulo') ?>" maxlength="50" autocomplete="off" >
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_whats">DDD + WHATSAPP</label>
                      <input type="text" class="form-control" id="socio_whats" name="socio_whats" placeholder="Whatsapp " value="<?= old('socio_whats') ?>" required autocomplete="off" data-inputmask='"mask": "(99) 9999-9999"' data-mask >
                      <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                    </div>
                  </div><!-- col-->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_nascimento">DATA NASCIMENTO</label>
                      <input type="date" class="form-control" id="socio_nascimento" name="socio_nascimento" value="<?= old('socio_nascimento') ?>" autocomplete="off">
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_mae">NOME DA MÃE</label>
                      <input type="text" class="form-control" id="socio_mae" name="socio_mae" placeholder="Nome da Mãe" value="<?= old('socio_mae') ?>" autocomplete="off">
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_endereco">ENDEREÇO COMPLETO</label>
                      <input type="text" class="form-control" id="socio_endereco" name="socio_endereco" placeholder="Endereço do Sócio" value="<?= old('socio_endereco') ?>" autocomplete="off">
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="socio_recibo">RECIBO DO IMPOSTO</label>
                      <input type="text" class="form-control" id="socio_recibo" name="socio_recibo" placeholder="Recibo do Imposto de Renda" value="<?= old('socio_recibo') ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-sm-4">               
                    <div class="form-group">
                      <label for="socio_email">EMAIL</label>
                      <input type="email" class="form-control" id="socio_email" name="socio_email" placeholder="Email do Sócio" value="<?= old('socio_email') ?>" autocomplete="OFF"/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>DECLARA IMPOSTO DE RENDA?</label>
                      <div class="custom-control custom-switch">
                        <input type="hidden" name="declara_ir" value="0">
                        <input type="checkbox" class="custom-control-input" id="declara_ir" name="declara_ir" value="1" <?= old('declara_ir') ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="declara_ir">
                          Sim
                        </label>
                      </div>
                    </div>
                  </div>
                </div><!-- row -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="socio_observacoes">INFORMAÇÕES</label>
                      <textarea type="text" class="form-control" id="socio_observacoes" name="socio_observacoes" placeholder="Descreva o informações importantes do Sócio" autocomplete="off">
                      <?= old('socio_observacoes') ?>
                      </textarea>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
              </div><!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">SALVAR</button>
                <a href="<?php echo base_url('clientes/ver/'.$cliente['id']) ?>" class="btn btn-danger">FECHAR</a>
              </div><!-- div -->
            </form>
          </div><!-- card -->
        </div><!-- div col -->
      </div><!-- div row -->
    </div><!-- /.container fluid -->
  </section><!-- /.section -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var base_url = "<?php echo base_url() ?>"
    //==============================FUNÇÃO PARA VERIFICAR VALIDAÇÃO DE FORMULÁRIO ==========================
    
    //==================EDITOR DE TEXTO==================================
    $("#socio_observacoes").summernote();
    //==========================MASCARA AUTOMÁTICA =======================
    $('[data-mask]').inputmask(); //PUXA AS FUNÇÕES DE MÁSCARA
    //==========================MASCARA SELECT 2 =======================
    $('#id_cliente').select2({
      width: '100%',
      theme: 'classic'
    });
  </script>
<?= $this->endSection() ?>