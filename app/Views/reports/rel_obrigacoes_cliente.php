<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header bg-primary">
              <h3>RELATÓRIO DE OBRIGAÇÕES POR CLIENTE</h3>
            </div>
            <form role="form" action="<?=base_url('dashboard/pesquisa')?>" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="id_obrigacao">OBRIGACAO</label>
                  <select class="form-control select-group select-group-lg" id="id_obrigacao" name="id_obrigacao">
                    <?php echo $combo_obrigacoes?>
                  </select>
                </div>
                <button type="submit" class="btn btn-success btn-block btn-ls">GERAR PESQUISA</button>
                <br>
                <div class="row">
                  <div class="col-lg-12">
                    <?php if(isset($relatorio)) : ?>
                      <button onclick="printDiv('impressao')" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR</button>
                      <br>
                      <br>
                      <div class="text-size:16pt" id="impressao">
                        <table class="table table-striped table-bordered table-houver">
                          <th>CLIENTE</th>
                          <th>OBRIGACAO</th>
                          <?php foreach($relatorio as $k => $v):?>                            
                            <tr>
                              <td><?=$v['razao']?></td>
                              <td><?=$v['descricao']?></td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      </div>
                    <?php endif; ?>                    
                  </div>
                </div>
              </div><!-- div class body-->
            </form>       
          </div><!-- div panel primary -->
        </div><!-- div col -->
      </div><!-- div row -->
    </div><!-- div conteiner -->
  </section>
</div><!-- div content wapper -->

<!-- =============================================================================================================== -->
<script type="text/javascript">
  var base_url = "<?= base_url(); ?>";
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
  //funcção que faz imprimir os dados da tela
  function printDiv(impressao)  
    {
        var conteudo = document.getElementById(impressao).innerHTML;  
        var win = window.open();  
        win.document.write(conteudo);  
        win.print(); 
        win.close();
    } 
</script>