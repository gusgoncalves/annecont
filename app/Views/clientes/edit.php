<?php
/** @var array $cliente */
/** @var array $portes */
/** @var array $cidades */
/** @var array $estados */
?>
<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Cadastro de Clientes
<?= $this->endSection() ?>
<?php if (session()->get('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->get('errors') as $erro): ?>
                <li><?= $erro ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?= $this->section('content') ?>
  <section class="content-header"></section> 
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header bg-primary">
              <h3>ALTERAÇÃO DE CLIENTE</h3>
            </div>
            <!-- /.card-header -->
            <form role="form" action="<?= site_url('/clientes/update/' . $cliente['id']) ?>" method="post" class="was-validated" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="cliente_razao">RAZÃO SOCIAL</label>
                      <input type="text" class="form-control" id="cliente_razao" name="cliente_razao" placeholder="Razão Social do Cliente" maxlength="80" autocomplete="off" value="<?= old('cliente_razao', $cliente['razao']) ?>" required/>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="cliente_fantasia">NOME FANTASIA</label><div class="invalid-feedback"> * este campo é obrigatório </div>
                      <input type="text" class="form-control" id="cliente_fantasia" name="cliente_fantasia" placeholder="Nome Fantasia do Cliente" maxlength="80" autocomplete="off" value="<?= old('cliente_fantasia', $cliente['fantasia']) ?>" autocomplete="off" required/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="cliente_whats">DDD + WHATSAPP</label>
                      <input type="text" class="form-control" id="cliente_whats" name="cliente_whats" placeholder="Whatsapp" autocomplete="off" value="<?= old('cliente_whats', $cliente['whatsapp']) ?>" data-inputmask='"mask": "(99) 99999-9999"' data-mask required/>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="cliente_abertura">DATA ABERTURA EMPRESA</label>
                      <input type="date" class="form-control" id="cliente_abertura" name="cliente_abertura" autocomplete="off" value="<?= old('cliente_abertura', $cliente['dt_abertura']) ?>"/>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="cliente_cnpj">CNPJ / CPF</label>
                      <input type="text" class="form-control" id="cliente_cnpj" name="cliente_cnpj" placeholder="CNPJ do cliente" autocomplete="off" value="<?= old('cliente_cnpj', $cliente['cnpj']) ?>" onkeypress='chama_mascara(this)' onblur='clearTimeout()' maxlength="18" required/>
                    </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                        <label for="cliente_porte">PORTE</label>
                        <select class="form-control" id="cliente_porte" name="cliente_porte">
                          <?php foreach ($portes as $p): ?>
                            <option value="<?= $p['id'] ?>"
                                <?= $p['id'] == old('cliente_porte', $cliente['id_porte']) ? 'selected' : '' ?>>
                                <?= $p['descricao'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="cliente_endereco">ENDEREÇO COMPLETO</label>
                      <input type="text" class="form-control" id="cliente_endereco" name="cliente_endereco" placeholder="Endereço do cliente" autocomplete="off" value="<?= old('cliente_endereco', $cliente['endereco']) ?>"/>
                    </div>
                  </div>                  
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="cliente_uf">UF</label>
                      <?php $estado = json_decode($cliente['id_uf']); ?>
                      <select class="form-control" id="cliente_uf" name="cliente_uf">
                        <?php foreach ($estados as $v): ?>
                          <option value="<?= $v['id'] ?>" <?php if($v['id']==$estado) echo "selected" ;?>>
                            <?= $v['nome']; ?>
                          </option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="cliente_cidade">CIDADE</label>
                      <select class="form-control" id="cliente_cidade" name="cliente_cidade">
                        <?php foreach ($cidades as $c): ?>
                          <option value="<?= $c['id'] ?>" 
                            <?= $c['id']== old('cliente_cidade', $c['id']) ? 'selected' : '' ?>>
                            <?= $c['nome_cidade']; ?>
                          </option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>               
                </div>                
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="cliente_cep">CEP</label>
                      <input type="text" class="form-control" id="cliente_cep" name="cliente_cep" placeholder="CEP do cliente" autocomplete="off" value="<?= old('cliente_cep', $cliente['cep']) ?>" data-inputmask='"mask": "99999-999"' data-mask>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="cliente_valor">VALOR COBRADO</label>
                      <input type="number" class="form-control" id="cliente_valor" name="cliente_valor" placeholder="Valor para pagamento" step="0.01" min="0" value="<?= old('cliente_valor', $cliente['valor']) ?>" required/>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="cliente_vencimento">DIA VENCIMENTO</label>
                      <input type="number" class="form-control" id="cliente_vencimento" name="cliente_vencimento" min="1" max="31" placeholder="Dia do vencimento" value="<?= old('cliente_vencimento', $cliente['dia_vencimento']) ?>" required/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="cliente_email">EMAIL</label>
                      <input type="email" class="form-control" id="cliente_email" name="cliente_email" placeholder="Email do Cliente" autocomplete="OFF" value="<?= old('cliente_email', $cliente['email']) ?>">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>DECLARA IR?</label>
                      <div class="custom-control custom-switch">
                        <input type="hidden" name="declara_ir" value="0">
                        <input type="checkbox" class="custom-control-input" id="declara_ir" name="declara_ir" value="1" <?= old('declara_ir', $cliente['declara_ir']) ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="declara_ir">
                          Sim
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="cliente_descricao">INFORMAÇÕES</label>
                  <textarea type="text" class="form-control" id="cliente_descricao" name="cliente_descricao" placeholder="Descreva as informações importantes passa esse Cliente" autocomplete="off">
                    <?= old('cliente_descricao', $cliente['observacoes']) ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="ativo">Ativo</label>
                  <select class="form-control" id="ativo" name="ativo"> 
                    <option value="1" <?php if($cliente['ativo'] == 1) { echo 'selected="selected"'; } ?>>Sim</option>
                    <option value="2" <?php if($cliente['ativo'] == 2) { echo 'selected="selected"'; } ?>>Não</option>
                  </select>
                </div>
              </div><!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">SALVAR</button>
                  <a href="<?php echo base_url('clientes/ver/'.$cliente['id']) ?>" class="btn btn-danger">FECHAR</a>
              </div>
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
    $("#cliente_descricao").summernote()
    //==========================MASCARA AUTOMÁTICA =======================
    $('[data-mask]').inputmask()
    
    //================FUNÇÃO DE ADD CIDADE APÓS ADD O ESTADO ===============
    $(function(){
      $('#cliente_uf').change(function(){
        let id_estado = $(this).val();
        $('#cliente_cidade')
        .prop('disabled', true)
        .html('<option>Carregando...</option>');
        $.post(
          base_url + 'clientes/getCidades',{ id_estado: id_estado },
          function(data){
            let options = '<option value="">Selecione a cidade</option>';
            data.forEach(function(cidade){
              options += `<option value="${cidade.id}">${cidade.nome_cidade}</option>`;
            });
            $('#cliente_cidade').html(options).prop('disabled', false);
          },
          'json'
        );
      });
    });
    //===================MASCARA PARA CPF OU CNPJ =================================
    function chama_mascara(o) {
      if (o.value.length > 14)
        mascara(o, cnpj);
      else
        mascara(o, cpf);
    }

    function mascara(o, f) {
      v_obj = o;
      v_fun = f;
      setTimeout("execmascara()", 1);
    }

    function execmascara() {
      v_obj.value = v_fun(v_obj.value);
    }
    function cnpj(v) {
      v = v.replace( /\D/g , ""); //Remove tudo o que não é dígito
      v = v.replace( /^(\d{2})(\d)/ , "$1.$2"); //Coloca ponto entre o segundo e o terceiro dígitos
      v = v.replace( /^(\d{2})\.(\d{3})(\d)/ , "$1.$2.$3"); //Coloca ponto entre o quinto e o sexto dígitos
      v = v.replace( /\.(\d{3})(\d)/ , ".$1/$2"); //Coloca uma barra entre o oitavo e o nono dígitos
      v = v.replace( /(\d{4})(\d)/ , "$1-$2"); //Coloca um hífen depois do bloco de quatro dígitos
      return v;
    }
    function cpf(v) {
      v = v.replace( /\D/g , ""); //Remove tudo o que não é dígito
      v = v.replace( /(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
      v = v.replace( /(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
      //de novo (para o segundo bloco de números)
      v = v.replace( /(\d{3})(\d{1,2})$/ , "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
      return v;
    }
  </script>
<?= $this->endSection() ?>