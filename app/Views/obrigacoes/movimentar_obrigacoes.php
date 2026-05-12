  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div id="messages"></div>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Start box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="box">
            <div class="box-header">
            <div class="alert alert-info"><h3 class="box-title">MOVIMENTAR OBRIGAÇÕES</h3></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="manageTable" class="table table-hover table-striped">
                <thead>
                <tr>
                  <th>DESCRIÇÃO</th>
                  <th>STATUS</th>
                  <?php if(in_array('modificarObrigacao', $user_permission) || in_array('apagarObrigacao', $user_permission)): ?>
                  <th>AÇÕES</th>
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

<?php if(in_array('criarObrigacao', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">NOVA OBRIGAÇÃO</h4>
      </div>

      <form role="form" action="<?php echo base_url('obrigacoes/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="obrigacao_descricao">DESCRIÇÃO</label>
            <input type="text" class="form-control" id="obrigacao_descricao" name="obrigacao_descricao" placeholder="Descrição da Obrigação" autocomplete="off" required>
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

<?php if(in_array('modificarObrigacao', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">EDITAR OBRIGAÇÃO</h4>
      </div>

      <form role="form" action="<?php echo base_url('obrigacoes/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_obrigacao_descricao">NOME</label>
            <input type="text" class="form-control" id="edit_obrigacao_descricao" name="edit_obrigacao_descricao" placeholder="Descrição da Obrigação" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="edit_obrigacao_ativo">ATIVO</label>
            <select class="form-control" id="edit_obrigacao_ativo" name="edit_obrigacao_ativo">
              <option value="1">ATIVO</option>
              <option value="2">INATIVO</option>
            </select>
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

<?php if(in_array('apagarObrigacao', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">REMOVER OBRIGACAO</h4>
      </div>

      <form role="form" action="<?php echo base_url('obrigacoes/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Tem certeza que deseja remover?</p>
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


$(document).ready(function() {
  $('#mainClienteNav').addClass('active');
  $('#obrigacoesMainNav').addClass('active');
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'obrigacoes/recebeDadosObrigacoes',
    'order': []
  });

  //Envia o form criado
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
            //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
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
});
// função editar
function editFunc(id)
{ 
  $.ajax({
    url: base_url + 'obrigacoes/EncontraObrigacaoPorID/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      $("#edit_obrigacao_descricao").val(response.descricao);
      $("#edit_obrigacao_ativo").val(response.ativo);
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
    }
  });
}
// função remover
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {
      var form = $(this);
      $(".text-danger").remove();
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { quarto_id:id }, 
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