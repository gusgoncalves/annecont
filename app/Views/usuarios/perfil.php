

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
            <a href="<?= base_url('usuarios/configurar');?>" class="btn btn-lg btn-warning mb-2"><i class="fas fa-plus-square"></i> Editar Perfil</a>
            <br />
          <div class="card">
            <div class="card-header bg-primary">
              <h5 class="text-center">PERFIL DE USUÁRIO</h5>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table class="table table-bordered table-condensed table-hovered">
                <tr>
                  <th>USUÁRIO</th>
                  <td><?php echo $user_data['username']; ?></td>
                </tr>
                <tr>
                  <th>EMAIL</th>
                  <td><?php echo $user_data['email']; ?></td>
                </tr>
                <tr>
                  <th>NOME</th>
                  <td><?php echo $user_data['firstname']; ?></td>
                </tr>
                <tr>
                  <th>SEXO</th>
                  <td><?php echo ($user_data['gender'] == 1) ? 'Masculino' : 'Feminino'; ?></td>
                </tr>
                <tr>
                  <th>TELEFONE</th>
                  <td><?php echo "(" .substr($user_data['phone'],0,2).")".substr($user_data['phone'],2,5) ."-". substr($user_data['phone'],7,4); ?></td>
                </tr>
                <tr>
                  <th>GRUPO</th>
                  <td><span class="label label-info"><?php echo $user_group['group_name']; ?></span></td>
                </tr>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
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

    $(document).ready(function() {
      $("#perfilMainNav").addClass('active');
    });
  </script>

