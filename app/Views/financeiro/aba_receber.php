<?php
/** @var array $receber */
/** @var array $bancos */
?>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">CONTAS A RECEBER</h5>
          </div>
          <div class="card-body">
            <?php if (hasPermission('criarReceber')) : ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-square"></i> NOVA COBRANÇA</button>
            <?php endif; ?>
            <table id="manageTable" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>DESCRICAO</th>
                  <th>VENCIMENTO</th>
                  <th>VALOR</th>
                  <th>SITUAÇÃO</th>
                  <?php if (hasAnyPermission(['modificarReceber', 'apagarReceber'])) : ?>
                    <th class="col-2">AÇOES</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($receber as $value): ?>
                  <tr>
                    <td><?= $value['nome'] ?></td>
                    <td><?= date('d/m/Y', strtotime($value['dt_recebimento'])) ?></td>
                    <td><?= number_format($value['valor'], 2, ',', '.') ?></td>
                    <td><?= $value['quitado'] == 0 ? '<span class="badge badge-warning">Aberto</span>' : '<span class="badge badge-success">Pago</span>' ?></td>
                    <?php if (hasAnyPermission(['modificarReceber', 'apagarReceber'])) : ?>
                      <td class="text-center">
                        <?php if (hasPermission('modificarReceber') && $value['quitado'] == 0) : ?>
                          <button class="btn btn-primary" style="font-size:0.55em" onclick="editFunc(<?= $value['id'] ?>)"><i class="fas fa-edit"></i></button>
                        <?php endif; ?>
                        <?php if (hasPermission('modificarReceber') && $value['quitado'] == 0) : ?>
                          <button type="button" style="font-size:0.55em" class="btn btn-success" onclick="quitarFunc(' <?= $value['id'] ?> ', ' <?= $value['valor'] ?> ')" data-toggle="modal" title="Quitar esta conta" data-target="#quitarModal"><i class="fa fa-check"></i></button>
                        <?php endif; ?>
                      </td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div><!-- /.card -->
      </div><!-- div col -->
    </div><!-- div row -->
  </section>
<?= $this->include('modal/modal_receber') ?>

<script>
</script>