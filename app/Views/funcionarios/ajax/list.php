<?php /** @var array $funcionarios */ ?>
<a
    href="<?= base_url('funcionarios/create/'.$cliente_id.'?return=clientes/ver/'.$cliente_id) ?>"
    class="btn btn-success mb-3">

    NOVO FUNCIONÁRIO

</a>

<table class="table table-bordered">

<?php foreach($funcionarios as $f): ?>

<tr>

    <td><?= $f['nome'] ?></td>

    <td><?= $f['whatsapp'] ?></td>

    <td>

        <a
            href="<?= base_url('funcionarios/edit/'.$f['id'].'?return=clientes/ver/'.$cliente_id) ?>"
            class="btn btn-primary btn-sm">

            EDITAR

        </a>

        <a
            href="<?= base_url('funcionarios/transporte/'.$f['id']) ?>"
            class="btn btn-dark btn-sm">

            TRANSPORTE

        </a>

    </td>

</tr>

<?php endforeach; ?>

</table>