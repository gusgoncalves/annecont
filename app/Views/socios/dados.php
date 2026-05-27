<?php /** @var array $socio */
  /** @var int $id_cliente */
?>

  <?php if(hasPermission('criarCliente')): ?>
    <a href="<?php echo base_url('socios/create/'.$id_cliente) ?>" class="btn btn-success btn-block"><i class="fas fa-plus-square"></i> NOVO SÓCIO</a>
  <?php endif; ?>
  <br>
  <?php if(empty($socio)) : ?>
    <div class="alert alert-warning text-center">
        Nenhum sócio cadastrado.
    </div>
  <?php else : ?>
    <div class="card">
      <div class="card-header bg-primary">
        <h5 class="text-center">SÓCIOS</h5>
      </div>
      <div class="card-body">
        <?php foreach($socio as $z) : ?>
          <table class="table table-striped table-bordered">
            <tr>
              <th>NOME:</th>
              <td class="width:10%"><?= $z['nome']; ?></td>
            </tr>
            <tr>
              <th>CPF:</th>
              <td><?= strtoupper($z['cpf']); ?></td>
            </tr>
            <tr>
              <th>RG:</th>
              <td><?= $z['rg'] ?></td>
            </tr>
            <tr>
              <th>TÍTULO:</th>
              <td><?= $z['titulo'] ?></td>
            </tr>
            <tr>
              <th>WHATSAPP:</th>
              <td><?= $z['whatsapp'] ?></td>
            </tr>
            <tr>
              <th>ENDEREÇO:</th>
              <td><?= $z['endereco'] ?></td>
            </tr>
            <tr>
              <th>RECIBO:</th>
              <td><?= $z['recibo'] ?></td>
            </tr>
            <tr>
              <th>EMAIL:</th>
              <td><?= $z['email'] ?></td>
            </tr>
            <tr>
              <th>NASCIMENTO:</th>
              <td><?= $z['nascimento']?></td>
            </tr>
            <tr>
              <th>NOME DA MÃE:</th>
              <td><?= $z['nome_mae'] ?></td>
            </tr>
            <tr>
              <th>OBSERVAÇÕES:</th>
              <td><?= $z['observacoes'] ?></td>
            </tr>
            </br>
          </table>
        <?php endforeach; ?>
      </div><!-- card body -->      
    </div><!-- card -->
  <?php endif; ?>