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
          <?php if(in_array('criarFaturamento', $user_permission)): ?>
            <button class="btn btn-lg btn-warning mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVO FATURAMENTO</button>
            <br />
          <?php endif; ?>
          <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">LISTA DE FATURAMENTO</h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="manageTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>CLIENTE</th>
                  <th>MES</th>
                  <th>ANO</th>
                  <th>VALOR</th>
                  <?php if(in_array('modificarFaturamento', $user_permission) || in_array('apagarFaturamento', $user_permission)): ?>
                  <th class="col-2">AÇÕES</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <!-- AQUI DENTRO VAI O CONTEÚDO DA DATATABLE -->
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- col-md-12 -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<?php if(in_array('criarFaturamento', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">NOVO FATURAMENTO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('faturamento/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
        <div class="modal-body">
          <div class="form-group">
            <label for="id_cliente">CLIENTE</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
              <?php echo $combo_cliente;?>
            </select>
            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
          </div>
          <div class="form-group">
            <label for="faturamento_mes">MÊS</label>
            <select class="form-control" id="mes" name="mes" required>
              <?php echo $combo_meses;?>
            </select>
            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="faturamento_ano">ANO</label>
                <input type="text" class="form-control" id="faturamento_ano" name="faturamento_ano"  maxlength="4" pattern="[0-9]{4}" value="<?=date('Y');?>" required>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="faturamento_valor">VALOR</label>
                <input type="number" class="form-control" id="faturamento_valor" name="faturamento_valor" step="0.01" autocomplete="off" required>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              </div>
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
<!-- ======================================MODIFICAR MODAL DE FATURAMENTO ==================================== -->
<?php if(in_array('modificarFaturamento', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">Alterar Faturamento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('faturamento/update') ?>" method="post" id="updateForm">
        <div class="modal-body">
          <div id="messages"></div>
          <div class="form-group">
            <label for="edit_faturamento_mes">MÊS</label>
            <select class="form-control" id="edit_faturamento_mes" name="edit_faturamento_mes">
              <?php echo $combo_meses;?>
            </select>
            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_faturamento_ano">ANO</label>
                <input type="text" class="form-control" id="edit_faturamento_ano" name="edit_faturamento_ano"  maxlength="4" pattern="[0-9]{4}" required>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_faturamento_valor">VALOR</label>
                <input type="number" class="form-control" id="edit_faturamento_valor" name="edit_faturamento_valor" step="0.01" autocomplete="off" required>
                <div class="invalid-feedback">Preenchimento Obrigatório!</div>
              </div>
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

<?php if(in_array('apagarFaturamento', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title text-center">APAGAR FATURAMENTO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('faturamento/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Tem certeza que deseja remover o faturamento?</p>
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

  //==============FUNÇÃO DE ATIVAR MENU ======================
  $(function () {
    var url = window.location;
    // for single sidebar menu
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active');

    // for sidebar menu and treeview
    $('ul.nav-treeview a').filter(function () {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview")
        .css({'display': 'block'})
        .addClass('menu-open').prev('a')
        .addClass('active');
  });
  //=================== SELECT 2 =====================================
  $('#id_cliente').select2({
    width : '100%',
    dropdownParent: $('#addModal')
  });
  // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'faturamento/recebeDadosFaturamento',
    'responsive': true,
    //lengthChange: true, //mostrar resultados por etapas
    'autoWidth': false,
    //'dom': 'Bfrtip',
    'paging':false,//tira a paginação
    'searching': true, //tira o input de pesquisa
    'ordering': true, //tira a opção de ordenar
    'info':false,
    'language': {url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',},
    'buttons': ["print"] //"colvis" é uma opção para ver as colunas e escolher 
  });

  //=========ENVIA DADOS DE CRIAR FORM==================
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
    url: base_url + 'faturamento/EncontraFaturamentoPorID/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      $("#edit_faturamento_mes").val(response.id_mes);
      $("#edit_faturamento_ano").val(response.ano);
      $("#edit_faturamento_valor").val(response.valor);
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
        data: { id_faturamento:id }, 
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
//==============================FUNÇÃO PARA VERIFICAR VALIDAÇÃO DE FORMULÁRIO ==========================
$(function () {
  'use strict'
  const forms = document.querySelectorAll('.requires-validation')
  Array.from(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  });
</script>