<style>
  .table td input[type="checkbox"] {
    margin: 0;
    position: relative;
    top: 2px; /* ou ajuste conforme necessário */
    width: 24px;
    height: 24px;
    accent-color:rgb(255, 0, 0);
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div id="messages"></div>
    </section>
    <!-- Main conttent -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="text-center">REMOVER OBRIGAÇÕES DO CLIENTE </h3>
              </div> 
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <?php echo validation_errors(); ?>
                      <?php if(empty($cliente_data['id'])): ?>
                        <div class="form-group">
                            <label for="id_cliente">CLIENTE</label>
                            <select class="form-control" id="id_cliente" style="width:100%" name="id_cliente">
                                <?php echo $combo_cliente?>
                            </select>
                        </div>
                      <?php else: ?>
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
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="id_obrigacao">MARQUE A OBRIGAÇÃO QUE DESEJA REMOVER</label>
                        <div class="form-check checkbox-xl">
                          <table class="table table-responsive table-striped table-hover">
                            <?php foreach($obrigacoes_data_cliente as $k => $v) :?>
                              <tr>
                                <td width="4%">
                                  <input class="form-check-input checkbox-xl" type="checkbox" value="<?=$v['id'];?>" name="cod_obrigacao[]" id="cod_obrigacao_<?=$v['id'];?>">
                                </td>
                                <td width="2%">-</td>
                                <td>
                                  <label class="form-check-label" for="cod_obrigacao_<?=$v['id'];?>"><?=$v['descricao'];?></label>
                                </td>
                              </tr>
                            <?php endforeach;?>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <?php if (count($obrigacoes_data_cliente) > 0) : ?>
                    <button type="submit" class="btn btn-success">REMOVER</button>
                  <?php endif; ?>
                  <a href="<?php echo base_url('clientes/ver/'.$cliente_data['id']) ?>" class="btn btn-danger">VOLTAR</a>
                </div>  
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    //$(".select_group").select2();
    $("#mainClienteNav").addClass('active');
    $("#obrigacoesMainNav").addClass('active');
    $('#id_obrigacao').select2();
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