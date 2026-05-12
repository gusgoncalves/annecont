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
          <?php if(in_array('criarTipoCertidao', $user_permission)): ?>
            <button class="btn btn-lg btn-warning mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVO TIPO DE CERTIDÃO</button>
            <br />
          <?php endif; ?>
          <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">LISTA DE TIPOS DE CERTIDÃO</h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="manageTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>NOME</th>
                  <th>DESCRIÇÃO</th>
                  <?php if(in_array('modificarTipoCertidao', $user_permission) || in_array('apagarTipoCertidao', $user_permission)): ?>
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
      </div><!-- /.row -->
    </section> <!-- /.content -->
  </div><!-- /.content-wrapper -->
 
<?php if(in_array('criarTipoCertidao', $user_permission)): ?>
<!-- cria o modal -->
<div class="modal fade"  role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">NOVO TIPO DE CERTIDÃO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('tipo_certidao/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
        <div class="modal-body">
          <div class="form-group">
            <label for="tipo_certidao_nome">NOME</label>
            <input type="text" class="form-control" id="tipo_certidao_nome" name="tipo_certidao_nome" placeholder="Digite o nome do tipo" autocomplete="off" required>
            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
          </div>
          <div class="form-group">
            <label for="tipo_certidao_descricao">DESCRIÇÃO</label>
            <input type="text" class="form-control" id="tipo_certidao_descricao" name="tipo_certidao_descricao" placeholder="Digite alguma informação" autocomplete="off">
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

<?php if(in_array('modificarTipoCertidao', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">ALTERAR TIPO DE CERTIDÃO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('tipo_certidao/update') ?>" method="post" id="updateForm">
        <div class="modal-body">
          <div id="messages"></div>
          <div class="form-group">
            <label for="edit_tipo_certidao_nome">NOME</label>
            <input type="text" class="form-control" id="edit_tipo_certidao_nome" name="edit_tipo_certidao_nome" placeholder="Digite o nome" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_tipo_certidao_descricao">DESCRIÇÃO</label>
            <input type="text" class="form-control" id="edit_tipo_certidao_descricao" name="edit_tipo_certidao_descricao" placeholder="Digite alguma informação" autocomplete="off">
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

<?php if(in_array('apagarTipoCertidao', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title text-center">APAGAR TIPO DE CERTIDÃO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('tipo_certidao/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Tem certeza que deseja remover o tipo de certidão?</p>
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
  //=================== SELECT 2 =====================================
  $('#id_cliente').select2({
    width : '100%',
    dropdownParent: $('#addModal')
  });
  // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'tipo_certidao/recebeDadosTipoCertidao',
    'responsive': true,
    //lengthChange: true, //mostrar resultados por etapas
    'autoWidth': false,
    'paging':false,//tira a paginação
    'searching': true, //tira o input de pesquisa
    'ordering': true, //tira a opção de ordenar
    'info':false,
    'language': {url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',},
  });
  //========================================ENVIA DADOS DE CRIAR FORM===================================
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);
    // remove the text-danger
    $(".text-danger").remove();
    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
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
          // hide the modal
          $("#addModal").modal('hide');
          //ATUALIZADA O MODAL
          location.reload();
          // reset the form
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
//===================================FUNÇÃO DE EDITAR ============================================
function editFunc(id)
{ 
  $.ajax({
    url: base_url + 'tipo_certidao/EncontraTipoCertidaoPorID/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      $("#edit_tipo_certidao_nome").val(response.nome);
      $("#edit_tipo_certidao_descricao").val(response.descricao);
      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
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
              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
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
//================================FUNÇÃO REMOVER ===========================================================
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
        data: { id:id }, 
        dataType: 'json',
        success:function(response) {
          manageTable.ajax.reload(null, false); 
          // hide the modal
            $("#removeModal").modal('hide');
          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert" id="sucesso">'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');
            $("#sucesso").fadeTo(2000, 500).slideUp(500, function(){
              $("#sucesso").slideUp(500);
            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert" id="erro">'+
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