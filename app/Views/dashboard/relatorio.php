<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Início AnneCont
<?= $this->endSection() ?>
  <style>
    @media print {
        .nao-imprimir {
            display:none;
        }
    }
    body{
        font-size:14px;
    }
  </style>
<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTAGEM DE <?= strtoupper($titulo) ?></h5>
          </div>
      <div class="card-body">
        <div class="col-md-6 text-end nao-imprimir">
          <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-print"></i> Imprimir</button>
          <br>
        </div>
        <div class="col-md-6">
            <small> Total de registros: <?= count($dados) ?></small>
        </div>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
                <?php foreach ($cabecalhos as $cabecalho): ?>
                    <th><?= esc($cabecalho) ?></th>
                <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($dados as $linha): ?>
                <tr>
                  <?php foreach ($campos as $campo): ?>
                    <td>
                        <?php
                          $valor = $linha[$campo] ?? '';
                          if (strpos($campo, 'data') !== false || strpos($campo, 'nascimento') !== false || strpos($campo, 'validade') !== false) {
                            if (!empty($valor)) {
                                $valor = date('d/m/Y',strtotime($valor));
                            }
                          }
                          echo esc($valor);
                        ?>
                    </td>
                  <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>
