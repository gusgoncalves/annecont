<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div id="messages"></div>
  </section>
  <!-- Main contennt -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-center">OBRIGAÇÕES DO CLIENTE</h3>
            </div>
            <!-- /.card-header -->
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <?php echo validation_errors(); ?>
                    <?php if(empty($cliente_data['id'])): ?>
                      <div class="form-group">
                        <label for="id_cliente">CLIENTE</label>
                        <select class="form-control" id="id_cliente" style="width:100%" name="id_cliente">
                            <?php echo $combo_cliente?>
                        </select>
                      </div>
                    <?php else : ?>
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?= $cliente_data['id'] ;?>">
                      </div>
                      <div class="form-group">
                        <label for="cliente_nome">CLIENTE</label>
                        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" value="<?=$cliente_data['fantasia'];?>" readonly>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                      <label for="id_obrigacao">OBRIGAÇÕES</label>
                      <select class="form-control" id="id_obrigacao" style="width:100%" name="id_obrigacao[]" multiple="multiple" required>
                          <?php echo $combo_obrigacoes?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">SALVAR</button>
                  <a href="<?php echo base_url('clientes/ver/'.$cliente_data['id']) ?>" class="btn btn-danger">FECHAR</a>
                </div>
              </div>  
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div><!-- /.content-wrapper -->

<script type="text/javascript">
  
  //var base_url = "<?php echo base_url() ?>"

  $(document).ready(function() {
    //$(".select_group").select2();
    $("#mainClienteNav").addClass('active');
    $("#funcionarioMainNav").addClass('active');
    $('#id_obrigacao').select2();
  });
  
  $("#sucesso").fadeTo(2000, 500).slideUp(500, function(){
    $("#sucesso").slideUp(500);
  });
  $("#erro").fadeTo(2000, 500).slideUp(500, function(){
    $("#erro").slideUp(500);
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
</script>