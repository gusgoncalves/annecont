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
          <?php if(in_array('criarCidade', $user_permission)): ?>
            <button class="btn btn-lg btn-warning mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVA CIDADE</button>
            <br />
          <?php endif; ?>
          <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">LISTA DE CIDADES </h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="manageTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>CIDADE</th>
                  <th>UF</th>
                  <?php if(in_array('modificarCidade', $user_permission) || in_array('apagarCidade', $user_permission)): ?>
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
<!-- ======================== CRIANDO MODAL DE ADICIONAR CIDADE ============================-->
<?php if(in_array('criarCidade', $user_permission)): ?>
<!-- CRIANDO MODAL ADICIONAR NOVA CIDADE -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">NOVA CIDADE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('cidades/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
        <div class="modal-body">
          <div class="form-group">
            <label for="brand_name">NOME DA CIDADE</label>
            <input type="text" class="form-control" id="nome_cidade" name="nome_cidade" placeholder="Nome da Cidade" autocomplete="off" required>
            <div class="invalid-feedback">Preenchimento Obrigatório!</div>
          </div>
          <div class="form-group">
            <label for="UF">UF</label>
              <select class="form-control" id="combo_uf" name="combo_uf" required>
              <?php foreach ($get_uf as $k => $v): ?>
                <option value="<?php echo $v['id'] ?>"><?php echo $v['uf'] ?></option>
              <?php endforeach ?>
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

<!-- ======================== MODAL DE EDIÇÃO DE CIDADE ============================-->
<?php if(in_array('modificarCidade', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center">EDITAR CIDADE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('cidades/update') ?>" method="post" id="updateForm">
        <div class="modal-body">
          <div id="messages"></div>
          <div class="form-group">
            <label for="Cidades">NOME DA CIDADE</label>
            <input type="text" class="form-control" id="edit_nome_cidade" name="edit_nome_cidade" placeholder="Nome da Cidade" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="uf">UF</label>
            <select class="form-control" id="edit_combo_uf" name="edit_combo_uf">
            <?php foreach ($get_uf as $k => $v): ?>
                <option value="<?php echo $v['id'] ?>"><?php echo $v['uf'] ?></option>
              <?php endforeach ?>
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

<!-- ======================== CRIANDO MODAL DE APAGAR CIDADE ============================-->
<?php if(in_array('apagarCidade', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title text-center">REMOVER CIDADE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('cidades/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Tem certeza que deseja remover  cidade?</p>
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
    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $('#manageTable').DataTable({
      'ajax': base_url + 'cidades/recebeDadosCidade',
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
  // =-=========================EDITAR CIDADE ==========================================
  function editCidade(id)
  { 
    $.ajax({
      url: base_url + 'cidades/recebeDadosCidadePorID/'+id,
      type: 'post',
      dataType: 'json',
      success:function(response) {
        //montagem do form para aparecer as variáveis de edição
        $("#edit_nome_cidade").val(response.nome_cidade);//aqui é o campo que aparece
        $("#edit_combo_uf").val(response.id_uf);
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
                  //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
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
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
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
  // ============================REMOVER DADOS DA CIDADE ===============================
  function removeCidade(id)
  {
    if(id) {
      $("#removeForm").on('submit', function() {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: { cidade_id:id }, 
          dataType: 'json',
          success:function(response) {
            manageTable.ajax.reload(null, false); 
            // hide the modal
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