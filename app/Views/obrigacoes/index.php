  <?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Obrigações
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTA DE OBRIGAÇÕES</h5>
          </div>
          <div class="card-body">
            <?php if(hasPermission('criarObrigacao')): ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVA OBRIGAÇÃO</button>
              <br />
            <?php endif; ?>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>DESCRIÇÃO</th>
                <th>VALOR</th>
                <th>DATA INÍCIO</th>
                <th>DATA FIM</th>
                <th>STATUS</th>
                <?php if(hasAnyPermission(['modificarObrigacao','apagarObrigacao'])): ?>
                <th class="col-2">AÇÕES</th>
                <?php endif; ?>
              </tr>
              </thead>
              <tbody>
              <!-- AQUI DENTRO VAI O CONTEÚDO DA DATATABLE -->
              </tbody>
            </table>
          </div><!-- /.card body-->
        </div><!-- card -->
      </div><!-- col-md-12 -->
    </div><!-- row -->
  </section><!-- /.content -->

  <?php if(hasPermission('criarObrigacao')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center">NOVA OBRIGAÇÃO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?php echo base_url('obrigacoes/create') ?>" class="requires-validation" method="post" id="createForm" novalidate>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="obrigacao_descricao">DESCRIÇÃO</label>
                    <input type="text" class="form-control" id="obrigacao_descricao" name="obrigacao_descricao" placeholder="Descrição da Obrigação" autocomplete="off" required>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="valor">VALOR</label>
                    <input type="number" min="0.00" step="0.01" class="form-control" id="valor" name="valor" placeholder="valor" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dt_inicio">DATA INÍCIO</label>
                    <input type="date" class="form-control" id="dt_inicio" name="dt_inicio">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dt_fim">DATA FIM</label>
                    <input type="date" class="form-control" id="dt_fim" name="dt_fim">
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

  <?php if(hasPermission('modificarObrigacao')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center">EDITAR OBRIGAÇÃO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?php echo base_url('obrigacoes/update') ?>" method="post" id="updateForm">
            <div class="modal-body">
              <div id="messages"></div>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="edit_obrigacao_descricao">DESCRIÇÃO</label>
                    <input type="text" class="form-control" id="edit_obrigacao_descricao" name="edit_obrigacao_descricao" placeholder="Descrição da Obrigação" autocomplete="off" required>
                    <div class="invalid-feedback">Preenchimento Obrigatório!</div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="edit_valor">VALOR</label>
                    <input type="number" min="0.00" step="0.01" class="form-control" id="edit_valor" name="edit_valor" placeholder="edit_valor" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_dt_inicio">DATA INÍCIO</label>
                    <input type="date" class="form-control" id="edit_dt_inicio" name="edit_dt_inicio">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_dt_fim">DATA FIM</label>
                    <input type="date" class="form-control" id="edit_dt_fim" name="edit_dt_fim">
                  </div>
                </div>
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

  <?php if(hasPermission('apagarObrigacao')): ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title text-center">REMOVER OBRIGACAO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form role="form" action="<?php echo base_url('obrigacoes/remove') ?>" method="post" id="removeForm">
            <div class="modal-body">
              <p>Tem certeza que deseja remover essa obrigação?</p>
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var manageTable;
    var base_url = "<?= base_url(); ?>";
    // ===============================DATA TABLE COM RESPONSIVE E FUNÇÕES ======================
    manageTable = $('#manageTable').DataTable({
        ajax: base_url + 'obrigacoes/busca/',//MONTA A DATA TABLE
        responsive: true,
        autoWidth: false,
        paging: false,//tira a paginação
        searching: true, //tira o input de pesquisa
        ordering: false, //tira a opção de ordenar
        info: false,
        language: {url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',},
          columns: [
          { data: 'descricao'},
          { data: 'valor' },
          { data: 'dt_inicio' },
          { data: 'dt_fim' },
          { data: 'ativo' },
          { data: 'acoes' },
        ]
      });
    //=========ENVIA DADOS DE CRIAR FORM==================
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
    //===================================FUNÇÃO DE EDITAR ============================================
    function editFunc(id)
    { 
      $.ajax({
        url: base_url + 'obrigacoes/EncontraObrigacaoPorID/'+id,
        type: 'post',
        dataType: 'json',
        success:function(response) {
          $("#edit_obrigacao_descricao").val(response.descricao);
          $("#edit_dt_inicio").val(response.dt_inicio);
          $("#edit_dt_fim").val(response.dt_fim);
          $("#edit_valor").val(response.valor);
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
    //================================FUNÇÃO REMOVER ===========================================================
    function removeFunc(id)
    {
      if(id) {
        $("#removeForm").on('submit', function() {
          var form = $(this);
          $(".text-danger").remove();
          $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: { obrigacao_id:id }, 
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
<?= $this->endSection() ?>