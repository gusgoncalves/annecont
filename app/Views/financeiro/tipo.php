  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div id="messages"></div>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
         
          <?php if(in_array('criarTipoConta', $user_permission)): ?>
            <button class="btn btn-lg btn-warning mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVO TIPO DE CONTA</button>
            <br />
            
          <?php endif; ?>

          <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">TIPOS DE PAGAMENTO</h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="manageTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>NOME</th>
                  <th>TIPO</th>
                  <?php if(in_array('modificarTipoConta', $user_permission) || in_array('apagarTipoConta', $user_permission)): ?>
                  <th class="col-2">AÇÕES</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php if(in_array('criarTipoConta', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">TIPO DE PAGAMENTO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('financeiro/criarTipoConta') ?>" method="post" id="createForm">

        <div class="modal-body">
          <div class="form-group">
            <label for="nome">NOME</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do tipo da conta" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="tipo">CATEGORIA</label>&nbsp;&nbsp;&nbsp;
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tipo" id="pagar" value="2">&nbsp;&nbsp;&nbsp;
                  PAGAR
              </label class="form-check-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tipo" id="receber" value="1">&nbsp;&nbsp;&nbsp;
                  RECEBER
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">SALVAR</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>
<!-- =================================================MODAL DE EDIÇÃO =================================================== -->
<?php if(in_array('modificarTipoConta', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">EDITAR CATEGORIA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('financeiro/updateTipo') ?>" method="post" id="updateForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_nome">NOME</label>
            <input type="text" class="form-control" id="edit_nome" name="edit_nome" placeholder="Nome do tipo da conta" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="gender">TIPO DA CATEGORIA</label>&nbsp;&nbsp;&nbsp;
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="edit_tipo" id="edit_pagar" value="2">&nbsp;&nbsp;&nbsp;
                    PAGAR
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="edit_tipo" id="edit_receber" value="1">&nbsp;&nbsp;&nbsp;
                    RECEBER
              </label>
            </div>
          </div><!--div dorm group --> 
        </div><!--Div modal body -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">SALVAR</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>
<!-- ===============REMOVER UM TIPO DE PAGAMENTO ================================= -->
<?php if(in_array('apagarTipoConta', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title text-center">REMOVER CATEGORIA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('financeiro/removeTipo') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Tem certeza que deseja remover esta categoria?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">SIM</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">NÃO</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";
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
  manageTable = $("#manageTable").DataTable({
    'ajax': base_url + 'financeiro/buscaDadosTipo',
      'responsive': true,
      //lengthChange: true, //mostrar resultados por etapas
      'autoWidth': false,
      'dom': 'Bfrtip',
      'paging':false,//tira a paginação
      'searching': true, //tira o input de pesquisa
      'ordering': false, //tira a opção de ordenar
      'info':false,
      'language': {url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',},
      'buttons': ["print"] //"colvis" é uma opção para ver as colunas e escolher 
    });
  //================================Envia o form criado ==================================
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);
    $(".text-danger").remove();
    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(),//converte para linguagem do servidor
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
          // esconde o modal
          $("#addModal").modal('hide');
          //reseta o form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');
        } else {
          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              id.after(value);
            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">'+
              //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
            $("#erro").fadeTo(2000, 500).slideUp(500, function(){
              $("#erro").slideUp(500);
            });
          }
        }
      }
    }); 
    return false;
  });
  $('#addModal').on('hidden.bs.modal', function () {
      location.reload();
    });
  // =========================================função editar===================================
  function editFunc(id)
  { 
    $.ajax({
      url: base_url + 'financeiro/buscaDadosTipoPorID/'+id,
      type: 'post',
      dataType: 'json',
      success:function(response) {

        $("#edit_nome").val(response.nome);
        if(response.tipo ==1){
          $("#edit_receber").prop('checked',true);
        }else {
          $("#edit_pagar").prop('checked',true);
        }
        // envia o form de editar 
        $("#updateForm").unbind('submit').bind('submit', function() {
          var form = $(this);
          // remove the text-danger
          $(".text-danger").remove();
          $.ajax({
            url: form.attr('action') + '/' + id,
            type: form.attr('method'),
            data: form.serialize(), // /converte os dados para forma de serviço de servidor
            dataType: 'json',
            success:function(response) {
              manageTable.ajax.reload(null, false); 
              if(response.success === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">'+
                  //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                '</div>');
                $("#sucesso").fadeTo(2000, 500).slideUp(500, function(){
                $("#sucesso").slideUp(500);
                });
                // esconde o modal
                $("#editModal").modal('hide');
                // reseta o modal 
                $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');
              } else {
                if(response.messages instanceof Object) {
                  $.each(response.messages, function(index, value) {
                    var id = $("#"+index);

                    id.closest('.form-group')
                    .removeClass('has-error')
                    .removeClass('has-success')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success');
                    id.after(value);
                  });
                } else {
                  $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">'+
                    //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                  '</div>');
                  $("#erro").fadeTo(2000, 500).slideUp(500, function(){
                  $("#erro").slideUp(500);
                });
                }
              }
            }
          }); 
          return false;
        });
        $('#editModal').on('hidden.bs.modal', function () {
        location.reload();
      });
      }
    });
  }

  //========================================== função remover==========================================
  function removeFunc(id)
  {
    if(id) {
      $("#removeForm").on('submit', function() {
        var form = $(this);
        $(".text-danger").remove();
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: {id:id }, 
          dataType: 'json',
          success:function(response) {
            manageTable.ajax.reload(null, false); 
            // esconde o modal
              $("#removeModal").modal('hide');
            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">'+
                //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');
                $("#sucesso").fadeTo(2000, 500).slideUp(500, function(){
                  $("#sucesso").slideUp(500);
                });
            } else {
              $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">'+
                //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
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