<?php /** @var int $id_cliente */ ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTA DE FUNCIONÁRIOS</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php if(hasPermission('criarFuncionario')): ?>
                <a href="<?= site_url('funcionarios/create/'.$id_cliente) ?>" class="btn btn-lg btn-primary mb-2"><i class="fas fa-plus-square"></i> NOVO FUNCIONÁRIO</a>
              <?php endif; ?>
            <?php if(empty($funcionarios)): ?>
              <div class="alert alert-warning mb-0">
                Nenhum funcionário cadastrado.
            </div>
            <?php else : ?>
              <table id="manageTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>FUNCIONÁRIO</th>
                  <th>WHATSAPP</th>
                  <th>ATIVO</th>
                  <?php if(hasAnyPermission(['modificarFuncionario', 'apagarFuncionario'])): ?>
                    <th class="col-2">AÇÕES</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($funcionarios as $value): ?>
                    <tr>
                      <td><?= $value['nome'] ?></td>
                      <td><?= $value['whatsapp'] ?></td>
                      <td><?= $value['ativo'] == 1 ? '<span class="badge badge-success">ATIVO</span>' : '<span class="badge badge-danger">INATIVO</span>' ?></td>
                      <td class="text-nowrap">
                        <a href="<?= site_url('funcionarios/transporte/'.$value['id'])?>" class="btn btn-dark" style="font-size:0.55em"><i class="fas fa-bus"></i></a>
                        <a href="<?= site_url('funcionarios/alimentacao/'.$value['id'])?>" class="btn btn-warning" style="font-size:0.55em"><i class="fas fa-utensils"></i></a>
                        <?php if(hasPermission('modificarFuncionario')): ?>
                          <a href="<?= site_url('funcionarios/edit/'.$value['id'])?>" class="btn btn-primary" style="font-size:0.55em"><i class="fas fa-edit"></i></a>
                        <?php endif; ?>
                        <?php if(hasPermission('apagarFuncionario')): ?>
                          <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeFunc('<?= $value['id']?>')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- col-md-12 -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
  <!-- ============================== CRIANDO MODAL DE APAGAR DE FUNCIONÁRIO ==============================-->

  <?php if(hasPermission('apagarFuncionario')): ?> 
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title textenter">REMOVER FUNCIONÁRIO</h4>  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
          </div>
          <form role="form" action="<?= site_url('funcionarios/delete ') ?>" method="post" id="removeForm">
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
    function removeFunc(id) 
    {
      $('#removeModal').modal('show');
      // remove submits antigos
      $('#removeForm').off('submit');
      // novo submit
      $('#removeForm').on('submit', function(e) {
          e.preventDefault();
          $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              data: {
                  id: id
              },
              dataType: 'json',
              success: function(response) {
                  if (response.success) {
                      $('#removeForm')[0].reset();
                      $('#removeModal').modal('hide');
                      $('#removeModal').one('hidden.bs.modal', function () {
                          reloadTab('#tab-funcionarios');
                      });
                      showToast(response.messages, 'success');
                  } else {
                      showToast(response.messages, 'error');
                  }
              },
              error: function() {
                  showToast('Erro ao remover o Banco.', 'error');
              }
          });
      });
    } 
  </script>

