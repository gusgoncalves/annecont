<?php /** @var array $socios */?>
<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Edição de Sócio
<?= $this->endSection() ?>
<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
              <h3>ALTERAÇÃO DE SÓCIO</h3>
            </div>
            <form role="form" action="<?= site_url('socios/update/' . $socios['id']) ?>" class="requires-validation" method="post" enctype="multipart/form-data" novalidate>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="socio_nome">NOME COMPLETO</label>
                      <input type="text" class="form-control" id="socio_nome" name="socio_nome" placeholder="Nome completo do Sócio" maxlength="50" value="<?= old('socio_nome'),$socios['nome'] ?>" autocomplete="off" required/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_cpf">CPF</label>
                      <input type="text" class="form-control" id="socio_cpf" name="socio_cpf" placeholder="CPF do Sócio" maxlength="50" value="<?= old('socio_cpf'),$socios['cpf'] ?>" data-inputmask='"mask": "999.999.999-99"' data-mask required/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_rg">RG</label>
                      <input type="text" class="form-control" id="socio_rg" name="socio_rg" placeholder="RG do Sócio" maxlength="50" value="<?= old('socio_rg'),$socios['rg'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_titulo">TÍTULO DE ELEITOR</label>
                      <input type="text" class="form-control" id="socio_titulo" name="socio_titulo" placeholder="Título do Sócio" maxlength="50" value="<?= old('socio_titulo'),$socios['titulo'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_whats">DDD + WHATSAPP</label>
                      <input type="text" class="form-control" id="socio_whats" name="socio_whats" placeholder="Whatsapp " value="<?= old('socio_whats'),$socios['whatsapp'] ?>" data-inputmask='"mask": "(99) 9999-9999"' data-mask autocomplete="off">
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_nascimento">DATA NASCIMENTO</label>
                      <input type="date" class="form-control" id="socio_nascimento" name="socio_nascimento" value="<?= old('socio_nascimento'),$socios['nascimento'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_mae">ENDEREÇO COMPLETO</label>
                      <input type="text" class="form-control" id="socio_mae" name="socio_mae" placeholder="Nome da Mãe" value="<?= old('socio_mae'),$socios['nome_mae'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_endereco">ENDEREÇO COMPLETO</label>
                      <input type="text" class="form-control" id="socio_endereco" name="socio_endereco" placeholder="Endereço do Sócio" value="<?= old('socio_endereco'),$socios['endereco'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="socio_recibo">RECIBO DO IMPOSTO</label>
                      <input type="text" class="form-control" id="socio_recibo" name="socio_recibo" placeholder="Recibo do Imposto de Renda" value="<?= old('socio_recibo'),$socios['recibo'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                  <div class="col-sm-4">               
                    <div class="form-group">
                      <label for="socio_email">EMAIL</label>
                      <input type="email" class="form-control" id="socio_email" name="socio_email" placeholder="Email do Sócio" value="<?= old('socio_email'),$socios['email'] ?>" autocomplete="off"/>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="socio_observacoes">INFORMAÇÕES</label>
                      <textarea type="text" class="form-control" id="socio_observacoes" name="socio_observacoes" placeholder="Descreva o informações importantes do Sócio" autocomplete="off">
                        <?= old('socio_observacoes'),$socios['observacoes'] ?>
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
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var base_url = "<?= base_url() ?>"
 
    //==================EDITOR DE TEXTO==================================
    $("#socio_observacoes").summernote()
    //==========================MASCARA AUTOMÁTICA =======================
    $('[data-mask]').inputmask() //PUXA AS FUNÇÕES DE MÁSCARA
  </script>
<?= $this->endSection() ?>