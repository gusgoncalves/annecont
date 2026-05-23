<?php /** @var array $movimento */ ?>
<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
Fluxo de Caixa
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">FLUXO DE CAIXA / MÊS</h5>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <form role="form" action="" method="post" id="movimentoData">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="dt_inicial">DATA ENTRADA</label>
                    <input type="date" class="form-control" id="dt_inicial" name="dt_inicial">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="dt_final">DATA SAÍDA</label>
                    <input type="date" class="form-control" id="dt_final" name="dt_final">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="buscar" class="invisible">Buscar</label>
                    <button class="btn btn-success form-control" type="submit" name="buscar">BUSCAR</button>
                  </div>
                </div>
                </br>
              </div>
              </br>
              <table id="manageTable" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>TIPO</th>
                    <th style="width:5%">DATA</th>
                    <th>DESCRIÇÃO</th>
                    <th>VALOR</th>
                  </tr>
                </thead>
                <?php foreach ($movimento as $v) : ?>
                  <?php if ($v['tipo'] == 'C') : ?>
                    <tr class="bg-success">
                      <td width="10%"><b>RECEBER</b></td>
                    <?php else : ?>
                    <tr  class="bg-danger">
                      <td width="10%"><b>PAGAR</b></td>
                    <?php endif ?>
                    <td width="15%"><?= date('d/m/Y', strtotime($v['dt_movimento'])); ?></td>
                    <td width="40%"><?= $v['descricao'] ?></td>
                    <?php if ($v['tipo'] == 'C') : ?>
                      <td width="20%"><b>R$ <?= number_format($v['valor'], 2, ',', '.'); ?></b></td>
                    <?php else : ?>
                      <td width="20%"><b>R$ <?= number_format($v['valor'], 2, ',', '.'); ?></b></td>
                    <?php endif ?>
                    </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php
                    // $total = $credito['credito'] - $debito['debito'];
                    // if ($total <= 0) {
                    //   echo "<td class='bg-danger'><h4>R$ " . number_format($total, 2, ',', '.') . "</h4></td>";
                    // } else {
                    //   echo "<td class='bg-success'><h4>R$ " . number_format($total, 2, ',', '.') . "</h4></td>";
                    // }
                    ?>
                  </tr>
              </table>
            </form>
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
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
  </script>
<?= $this->endSection() ?>