<?php 
  /** @return array */
  /** @var array $movimento */ 
  /** @var float $totalEntradas */
  /** @var float $totalSaidas */
  /** @var array $fluxoPrevisto */  
  /** @var float $saldo */ 
  /** @var string $dt_inicial */ 
  /** @var string $dt_final */ 
  /** @var string $tipo */
?>
<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Fluxo de Caixa
<?= $this->endSection() ?>
<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header bg-primary">
              <h4 class="mb-0 text-center"><i class="fa fa-chart-line"></i> FLUXO DE CAIXA</h4>
          </div>
          <div class="card-body">
            <!-- RESUMOS -->
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>R$ <?= number_format($totalEntradas, 2, ',', '.') ?></h3>
                    <p>ENTRADAS</p>
                  </div>
                  <div class="icon"><i class="fa fa-arrow-up"></i></div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>R$ <?= number_format($totalSaidas, 2, ',', '.') ?></h3>
                    <p>SAÍDAS</p>
                  </div>
                  <div class="icon"><i class="fa fa-arrow-down"></i></div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="small-box <?= $saldo >= 0 ? 'bg-primary' : 'bg-warning' ?>">
                  <div class="inner">
                    <h3>R$ <?= number_format($saldo, 2, ',', '.') ?></h3>
                    <p>SALDO</p>
                  </div>
                  <div class="icon"><i class="fa fa-wallet"></i></div>
                </div>
              </div>
            </div>
            <!-- TABELA 1-->
            <h4 class="mb-3"><i class="fa fa-calendar-check"></i></i> PREVISÃO FUTURA</h4>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="bg-dark">
                  <tr>
                    <th>VENCIMENTO</th>
                    <th>TIPO</th>
                    <th>DESCRIÇÃO</th>
                    <th>VALOR</th>
                    <th>SALDO PREVISTO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($fluxoPrevisto as $v): ?>
                    <tr>
                      <td><?= date('d/m/Y', strtotime($v['data_vencimento'])) ?></td>
                      <td>
                        <?php if($v['tipo'] == 'RECEBER'): ?>
                          <span class="badge badge-success">RECEBER</span>
                        <?php else: ?>
                          <span class="badge badge-danger">PAGAR</span>
                        <?php endif; ?>
                      </td>
                      <td><?= esc($v['descricao']) ?></td>
                      <td class="<?= $v['tipo'] == 'RECEBER'? 'text-success': 'text-danger' ?>"><strong><?= $v['tipo'] == 'RECEBER'? '+': '-' ?> R$ <?= number_format($v['valor'],2,',','.') ?></strong></td>
                      <td class="<?= $v['saldo_previsto'] >= 0 ? 'text-primary' : 'text-danger' ?>"><strong>R$ <?= number_format($v['saldo_previsto'],2,',','.') ?></strong></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <hr>
            </br>
            <!-- FILTROS -->
            <form method="GET">
              <div class="row mb-4">
                <div class="col-md-3">
                  <label>Data Inicial</label>
                  <input type="date" name="dt_inicial" class="form-control" value="<?= $dt_inicial ?>">
                </div>
                <div class="col-md-3">
                  <label>Data Final</label>
                  <input type="date" name="dt_final" class="form-control" value="<?= $dt_final ?>">
                </div>
                <div class="col-md-3">
                  <label>Tipo</label>
                  <select name="tipo" class="form-control">
                    <option value="">TODOS</option>
                    <option value="C" <?= $tipo == 'C' ? 'selected' : '' ?>>ENTRADAS</option>
                    <option value="D" <?= $tipo == 'D' ? 'selected' : '' ?>>SAÍDAS</option>
                  </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                  <button class="btn btn-primary btn-block"><i class="fa fa-search"></i>FILTRAR</button>
                </div>
              </div>
            </form> 
            <h4 class="mb-3"><i class="fa fa-chart-line"></i> RESUMO DAS CONTAS</h4>
            <!-- TABELA 2-->
            <div class="table-responsive">
              <table id="manageTable" class="table table-hover table-striped table-bordered">
                <thead class="bg-dark">
                  <tr>
                      <th width="15%">DATA</th>
                      <th width="15%">TIPO</th>
                      <th>DESCRIÇÃO</th>
                      <th width="20%">VALOR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($movimento as $v): ?>
                    <tr>
                      <td><?= date('d/m/Y', strtotime($v['dt_movimento'])) ?></td>
                      <td>
                        <?php if ($v['tipo'] == 'C'): ?>
                          <span class="badge badge-success">RECEITA</span>
                        <?php else: ?>
                          <span class="badge badge-danger">DESPESA</span>
                        <?php endif; ?>
                      </td>
                      <td><?= esc($v['descricao']) ?></td>
                      <td class="<?= $v['tipo'] == 'C' ? 'text-success' : 'text-danger' ?>">
                        <strong><?= $v['tipo'] == 'C'? '+': '-' ?>R$ <?= number_format($v['valor'], 2, ',', '.') ?></strong>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script>
    $('#manageTable').DataTable({
        responsive: true,
        autoWidth: false,
        ordering: true,
        pageLength: 25,
        language: {url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'}
    });
  </script>
<?= $this->endSection() ?>