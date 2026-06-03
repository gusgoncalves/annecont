<?php /** @var array $cliente */ ?>
<?php /** @var array $cidades */ ?>
 <?php if(hasPermission('modificarCliente')): ?>
    <a href="<?php echo base_url('clientes/edit/'.$cliente['id']) ?>" class="btn btn-success btn-block"><i class="fas fa-plus-square"></i> EDITAR DADOS</a>
  <?php endif; ?>
 </br>
<div class="card shadow-sm">

    <div class="card-body p-0">

        <table class="table table-striped table-bordered mb-0">

            <tr>
                <th width="20%">NOME FANTASIA</th>
                <td><?= strtoupper($cliente['fantasia']) ?></td>
            </tr>

            <tr>
                <th>RAZÃO SOCIAL</th>
                <td><?= strtoupper($cliente['razao']) ?></td>
            </tr>

            <tr>
                <th>CNPJ</th>
                <td><?= $cliente['cnpj'] ?></td>
            </tr>

            <tr>
                <th>ENDEREÇO</th>
                <td><?= strtoupper($cliente['endereco']) ?></td>
            </tr>

            <tr>
                <th>CEP</th>
                <td><?= $cliente['cep'] ?></td>
            </tr>

             <tr>
                <th>CIDADE</th>
                <td><?= $cidades[0]['nome_cidade'] ?></td>
            </tr>

            <tr>
                <th>WHATSAPP</th>
                <td><?= $cliente['whatsapp'] ?></td>
            </tr>

            <tr>
                <th>E-MAIL</th>
                <td><?= $cliente['email'] ?></td>
            </tr>

            <tr>
                <th>ABERTURA</th>
                <td>
                    <?= !empty($cliente['dt_abertura']) 
                        ? date('d/m/Y', strtotime($cliente['dt_abertura'])) 
                        : '-' ?>
                </td>
            </tr>

            <tr>
                <th>CADASTRO</th>
                <td>
                    <?= !empty($cliente['dt_cadastro']) 
                        ? date('d/m/Y', strtotime($cliente['dt_cadastro'])) 
                        : '-' ?>
                </td>
            </tr>
            <?php if(hasPermission('verReceber')): ?>
                <tr>
                    <th>VALOR MENSAL</th>
                    <td>
                        R$ <?= number_format($cliente['valor'], 2, ',', '.') ?>
                    </td>
                </tr>
            <?php endif; ?>

            <tr>
                <th>OBSERVAÇÕES</th>
                <td>
                    <?= nl2br($cliente['observacoes']) ?>
                </td>
            </tr>

        </table>

    </div>
</div>
