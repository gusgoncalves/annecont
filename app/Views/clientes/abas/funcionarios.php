<div class="card">

    <div class="card-header bg-primary">

        <div class="d-flex justify-content-between align-items-center">

            <h3 class="card-title">
                Funcionários
            </h3>

            <button class="btn btn-success"
                    onclick="novoFuncionario(<?= $id_cliente; ?>)">

                <i class="fas fa-plus"></i>

                Novo Funcionário

            </button>

        </div>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th width="150">Ações</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach($funcionarios as $f): ?>

                    <tr>

                        <td><?= $f['nome']; ?></td>

                        <td><?= $f['cpf']; ?></td>

                        <td>

                            <button class="btn btn-primary btn-sm"
                                    onclick="editarFuncionario(<?= $f['id']; ?>)">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm"
                                    onclick="removerFuncionario(<?= $f['id']; ?>)">
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<div id="modal-funcionario"></div>
<script>

function novoFuncionario(id_cliente)
{
    $.ajax({

        url: "<?= base_url('funcionarios/form'); ?>/" + id_cliente,

        success: function(response)
        {
            $('#modal-funcionario').html(response);

            $('#modalFuncionario').modal('show');
        }

    });
}

function editarFuncionario(id)
{
    $.ajax({

        url: "<?= base_url('funcionarios/editForm'); ?>/" + id,

        success: function(response)
        {
            $('#modal-funcionario').html(response);

            $('#modalFuncionario').modal('show');
        }

    });
}

function removerFuncionario(id)
{
    if(confirm('Deseja remover este funcionário?'))
    {
        $.ajax({

            url: "<?= base_url('funcionarios/delete'); ?>/" + id,

            type: "POST",

            success: function()
            {
                $('.tab-funcionarios').click();
            }

        });
    }
}

</script>