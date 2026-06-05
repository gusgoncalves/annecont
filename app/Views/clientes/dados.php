<?php /** @var array $cliente */ ?>
<?php /** @var array $cidades */ ?>
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0"><?= strtoupper($cliente['fantasia']) ?></h4>
                <small><?= strtoupper($cliente['razao']) ?></small>
            </div>
            <?php if(hasPermission('modificarCliente')): ?>
                <a href="<?= base_url('clientes/edit/'.$cliente['id']) ?>" class="btn btn-light"><i class="fas fa-edit"></i> Editar</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card border-left-primary">
                    <div class="card-body">
                        <h6 class="text-muted"><strong>DOCUMENTAÇÃO</strong></h6>
                        <p class="mb-1"><strong>CNPJ / CPF: </strong><?= formatarDocumento($cliente['cnpj']) ?></p>
                        <p class="mb-0"><strong>Abertura Empresa: </strong><?= !empty($cliente['dt_abertura']) ? date('d/m/Y', strtotime($cliente['dt_abertura'])) : '-' ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-left-success">
                    <div class="card-body">
                        <h6 class="text-muted"><strong>CONTATO</strong></h6>
                        <p class="mb-1"><i class="fab fa-whatsapp text-success"></i> <?= $cliente['whatsapp'] ?></p>
                        <p class="mb-0"><i class="fas fa-envelope text-primary"></i> <?= $cliente['email'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card border-left-info">
                    <div class="card-body">
                        <h6 class="text-muted"><strong>ENDEREÇO</strong></h6>
                        <p class="mb-0">
                            <?= strtoupper($cliente['endereco']) ?><br>
                            <strong>CEP: </strong><?= $cliente['cep'] ?><br>
                            <strong>CIDADE: </strong><?= $cidades[0]['nome_cidade'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php if(hasPermission('verReceber')): ?>
            <div class="col-md-4 mb-3">
                <div class="card bg-light text-white">
                    <div class="card-body text-center">
                        <h6><strong>MENSALIDADE: </strong></h6>
                        <h3>R$ <?= number_format($cliente['valor'],2,',','.') ?></h3>  
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-4 mb-3">
                <div class="card bg-light text-white">
                    <div class="card-body text-center">
                        <h6><strong>DIA VENCIMENTO: </strong></h6>
                        <h3><?= date('d', strtotime($cliente['dia_vencimento'])) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-light text-white">
                    <div class="card-body text-center">
                        <h6><strong>DECLARA IR: </strong></h6>
                        <h3><?= $cliente['declara_ir'] ? '<span class="badge badge-success">SIM</span>' : '<span class="badge badge-danger">NÃO</span>' ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="text-muted"><strong>OBSERVAÇÕES</strong></h6>
                    </div>
                    <div class="card-body">
                        <?= nl2br($cliente['observacoes']) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
