<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>
        <?php if(in_array('criarFuncionario', $user_permission)): ?>
          <a href="<?php echo base_url('funcionarios/create') ?>" class="btn btn-lg btn-warning mb-2"><i class="fas fa-plus-square"></i> NOVO FUNCIONÁRIO</a>
        <?php endif; ?>
        <br />
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTA DE FUNCIONÁRIOS INATIVOS</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <!-- Botão que redireciona para um link específico -->
              <a href="<?php echo base_url('funcionarios/') ?>" class="btn btn-lg btn-success mb-2"><i class="fas fa-plus-square"></i> VER ATIVOS</a>
            </div>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>CLIENTE</th>
                <th>FUNCIONÁRIO</th>
                <th>WHATSAPP</th>
                <?php if(in_array('modificarFuncionario', $user_permission) || in_array('apagarFuncionario', $user_permission)): ?>
                  <th class="col-2">AÇÕES</th>
                <?php endif; ?>
              </tr>
              </thead>
              <tbody>
                <!-- AQUI DENTRO VAI O CONTEÚDO DA DATATABLE -->
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- col-md-12 -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php if(in_array('apagarFuncionario', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title textenter">REMOVER FUNCIONÁRIO</h4>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
      </div>
      <form role="form" action="<?php echo base_url('funcionarios/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Tem certeza que deseja mesmo remover o funcionário selecionado?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">SIM</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
        </div><!-- End Modal footer -->
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<script type="text/javascript">
  var manageTable;
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
  // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $('#manageTable').DataTable({
      'ajax': base_url + 'funcionarios/buscarDadosFuncionarioInativo',//MONTA A DATA TABLE
      'responsive': true,
      //lengthChange: true, //mostrar resultados por etapas
      'autoWidth': false,
      //'dom': 'Bfrtip',
      'paging':true,//tira a paginação
      'pageLength': 25, // Define para exibir 50 itens por página
      'searching': true, //tira o input de pesquisa
      'ordering': true, //tira a opção de ordenar
      'info':false,
      'language': {url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',},
      'buttons': ["print"] //"colvis" é uma opção para ver as colunas e escolher 
    });
  
// ============================REMOVE FUNÇÃO===============================================
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {
      var form = $(this);
      // remove the text-danger
      $(".text-danger").remove();
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { funcionario_id:id }, 
        dataType: 'json',
        success:function(response) {
          manageTable.ajax.reload(null, false); 
          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
              $("#sucesso").fadeTo(2000, 500).slideUp(500, function(){
                $("#sucesso").slideUp(500);
              });
            $("#removeModal").modal('hide');
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
            $("#erro").fadeTo(2000, 500).slideUp(500, function(){
              $("#erro").slideUp(500);
            });
          }
        }
      }); 
      return false;
    });
  }
}
</script>
