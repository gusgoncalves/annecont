<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
  Clientes
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">LISTA DE USUÁRIOS </h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <?php if(hasPermission('criarUser')): ?>
                <a href="<?= site_url('usuarios/create') ?>" class="btn btn-lg btn-primary mb-2"><i class="fas fa-plus-square"></i> NOVO USUÁRIO</a>
                <br />
              <?php endif; ?>
              <table id="manageTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>USUÁRIO</th>
                  <th>EMAIL</th>
                  <th>NOME</th>
                  <th>TELEFONE</th>
                  <th>GRUPO</th>
                  <?php if(hasAnyPermission(['modificarUser','apagarUser'])): ?>
                  <th class="col-2">AÇÕES</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if(!empty($user_data)): ?>                  
                    <?php foreach ($user_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['username']; ?></td>
                        <td><?php echo $v['email']; ?></td>
                        <td><?php echo $v['firstname']; ?></td>
                        <td><?php echo $v['phone']; ?></td>
                        <td><?php echo $v['group_name']; ?></td>
                        <?php if(hasAnyPermission(['modificarUser', 'apagarUser'])): ?>
                        <td>
                          <?php if(hasPermission('modificarUser')): ?>
                            <a href="<?= site_url('usuarios/edit/'.$v['id']) ?>" class="btn btn-primary" style="font-size:0.55em"><i class="fas fa-edit"></i></a>
                          <?php endif; ?>
                          <?php if(hasPermission('apagarUser')): ?>
                          <button type="button" onclick="removeFunc(<?=  $v['id'] ?>)" class="btn btn-danger" data-toggle="modal" data-target="#removeModal" style="font-size:0.55em"><i class="fas fa-trash"></i></button>
                          <?php endif; ?>
                        </td>
                      <?php endif; ?>
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- col-md-12 -->
      </div> <!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?php if(hasPermission('apagarUser')): ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title text-center">REMOVER USUÁRIO</h4>  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
        </div>
        <form role="form" action="<?= base_url('usuarios/delete') ?>" method="post" id="removeForm">
          <div class="modal-body">
            <p>Tem certeza que deseja mesmo remover o usuário selecionado?</p>
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script type="text/javascript">
    //===============FUNÇÃO PARA EXIBIR TOAST DE SUCESSO OU ERRO APÓS AÇÃO ============
    function showToast(message, type = 'success') {
      let bg = 'bg-success';
      if (type === 'error') {
        bg = 'bg-danger';
      }
      if (type === 'warning') {
        bg = 'bg-warning';
      }
      let toast = $(`
        <div class="toast ${bg} text-white border-0 mb-3 shadow-lg"
             role="alert"
             style="
                min-width: 400px;
                padding: 10px;
                border-radius: 12px;
                font-size: 1rem;
             ">
             
            <div class="d-flex align-items-center">

                <div class="toast-body"
                     style="
                        padding: 15px 20px;
                        font-weight: 600;
                        line-height: 1.5;
                     ">
                    ${message}
                </div>
            </div>
        </div>
      `);
      $("#toast-container").append(toast);
      let bsToast = new bootstrap.Toast(toast[0], {
        delay: 6000 // 6 segundos
      });
      bsToast.show();
      toast.on('hidden.bs.toast', function() {
        $(this).remove();
      });
    }
    //=========================================================
    <?php if (session()->getFlashdata('success')): ?>
      showToast("<?= session()->getFlashdata('success') ?>", "success");
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
      showToast("<?= session()->getFlashdata('errors') ?>", "error");
    <?php endif; ?>
    //=========================================================
      manageTable = $('#userTable').DataTable({
        'responsive': true,
        //lengthChange: true, //mostrar resultados por etapas
        'autoWidth': false,
        //'dom': 'Bfrtip',
        'paging':false,//tira a paginação
        'searching': true, //tira o input de pesquisa
        'ordering': false, //tira a opção de ordenar
        'info':false,
        'language': {url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',},
        'buttons': ["print"] //"colvis" é uma opção para ver as colunas e escolher 
    });
  </script>
<?= $this->endSection() ?>
