<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Início AnneCont
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="content-header"></section>
    <section class="content">
        <h1>Página Dashboard</h1>

       <div class="container-fluid">

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h6>Clientes Ativos</h6>
                    <h2><?= $totalClientes ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h6>Mensalistas</h6>
                    <h2><?= $totalMensalistas ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h6>Declaram IR</h6>
                    <h2><?= $totalIR ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-danger shadow-sm">
                <div class="card-body text-center">
                    <h6>Certificados Vencidos</h6>
                    <h2><?= $certificadosVencidos ?></h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">

           <div class="card shadow-sm">
    <div class="card-header bg-warning">
        🎂 Próximos Aniversários
    </div>

    <div class="card-body">

        <?php if (empty($aniversariantes)) : ?>

            <div class="alert alert-success mb-0">
                Nenhum aniversariante nos próximos dias.
            </div>

        <?php else : ?>

            <div class="list-group">

                <?php foreach ($aniversariantes as $socio) : ?>

                    <div class="list-group-item">

                        <strong><?= esc($socio['nome']) ?></strong>

                        <div class="small text-muted">

                            <?= date('d/m', strtotime($socio['nascimento'])) ?>

                            <?php if ($socio['dias'] == 0) : ?>
                                <span class="badge bg-success">Hoje</span>
                            <?php elseif ($socio['dias'] == 1) : ?>
                                <span class="badge bg-primary">Amanhã</span>
                            <?php else : ?>
                                <span class="badge bg-warning text-dark">
                                    <?= $socio['dias'] ?> dias
                                </span>
                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>
</div>

        </div>

        <div class="col-md-4">

           <div class="card shadow-sm">

    <div class="card-header bg-danger text-white">
        🔐 Certificados Digitais
    </div>

    <div class="card-body">

        <div class="mb-3">

            <strong>Vencidos:</strong>

            <span class="badge bg-danger">
                <?= $certificadosVencidos ?>
            </span>

        </div>

        <div class="mb-3">

            <strong>Vencem em 30 dias:</strong>

            <span class="badge bg-warning text-dark">
                <?= $certificados30dias ?>
            </span>

        </div>

        <hr>

        <h6>Próximos vencimentos</h6>

        <?php if (empty($proximosCertificados)) : ?>

            <div class="alert alert-success mb-0">
                Nenhum certificado próximo do vencimento.
            </div>

        <?php else : ?>

            <div class="list-group">

                <?php foreach ($proximosCertificados as $certificado) : ?>

                    <div class="list-group-item">

                        <strong>
                            <?= esc(
                                !empty($certificado['fantasia'])
                                    ? $certificado['fantasia']
                                    : $certificado['razao']
                            ) ?>
                        </strong>

                        <div class="small text-muted">

                            <?= esc($certificado['descricao']) ?>

                            <br>

                            Vence em:

                            <?= date(
                                'd/m/Y',
                                strtotime($certificado['dt_validade'])
                            ) ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</div>

        </div>

    </div>

</div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>