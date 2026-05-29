<?php 
  /** @var array $obrigacoes_cliente */
  /** @var int $id_cliente */
?>
<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
  Remover Obrigações Cliente
<?= $this->endSection() ?>
<?= $this->section('content') ?>
  <section class="content-header"></section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header bg-primary">
              <h3><i class="fas fa-trash-alt"></i> REMOVER OBRIGAÇÕES DO CLIENTE</h3>
            </div>
            <form role="form" action="<?= site_url('obrigacoes_cliente/delete/').$id_cliente ?>" method="post">
              <div class="card-body">
                <?php if(count($obrigacoes_cliente) > 0): ?>
                  <!-- TOPO AÇÕES -->
                  <div class="row mb-3">
                    <div class="col-md-6 mb-2">
                      <button type="button" class="btn btn-outline-primary btn-block" id="marcarTodos"><i class="fas fa-check-square"></i> MARCAR TODOS</button>
                    </div>
                    <div class="col-md-6 mb-2">
                      <button type="button" class="btn btn-outline-secondary btn-block" id="desmarcarTodos"><i class="far fa-square"></i> DESMARCAR TODOS</button>
                    </div>
                    </div>
                    <!-- TABELA -->
                    <div class="table-responsive">
                      <table class="table table-hover table-striped align-middle">
                        <thead class="bg-light">
                            <tr>
                              <th width="6%" class="text-center"><i class="fas fa-check"></i></th>
                              <th>OBRIGAÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($obrigacoes_cliente as $v): ?>
                            <tr class="linha-obrigacao">
                              <!-- CHECKBOX -->
                              <td class="text-center align-middle">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox"class="custom-control-input obrigacao-check" value="<?= $v['id'];?>" name="cod_obrigacao[]" id="cod_obrigacao_<?= $v['id'];?>">
                                  <label class="custom-control-label" for="cod_obrigacao_<?= $v['id'];?>"></label>
                                </div>
                              </td>
                              <!-- DESCRIÇÃO -->
                              <td class="align-middle">
                                  <label class="label-obrigacao" for="cod_obrigacao_<?= $v['id'];?>"><?= $v['descricao'];?></label>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                <?php else: ?>
                  <!-- SEM OBRIGAÇÕES -->
                  <div class="alert alert-warning text-center shadow-sm"><i class="fas fa-exclamation-triangle"></i> Nenhuma obrigação encontrada para este cliente.</div>
              <?php endif; ?>
              </div>
              <!-- FOOTER -->
              <div class="card-footer">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <a href="<?= site_url('clientes/ver/'.$id_cliente) ?>" class="btn btn-danger btn-lg btn-block"><i class="fas fa-arrow-left"></i> VOLTAR</a>
                    </div>
                    <div class="col-md-6 mb-2">
                      <?php if(count($obrigacoes_cliente) > 0): ?>
                          <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-trash"></i> REMOVER SELECIONADAS</button>
                      <?php endif; ?>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
    <style>

    .card {
        border-radius: 8px;
        border: 0;
    }

    .card-header {
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .table tbody tr {
        transition: all .2s ease;
    }

    .table tbody tr:hover {
        background-color: #f4f6f9;
    }

    .label-obrigacao {
        margin-bottom: 0;
        cursor: pointer;
        font-size: 15px;
        font-weight: 600;
        width: 100%;
    }

    .custom-checkbox .custom-control-label::before {
        width: 22px;
        height: 22px;
        border-radius: 6px;
        top: -2px;
        border: 2px solid #adb5bd;
    }

    .custom-checkbox .custom-control-label::after {
        width: 22px;
        height: 22px;
        top: -2px;
    }

    .custom-control-input:checked~.custom-control-label::before {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .linha-obrigacao td {
        vertical-align: middle !important;
    }

    .alert {
        border-radius: 8px;
    }

    .btn {
        font-weight: 600;
    }

</style>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
  <script>
    // MARCAR TODOS
    $('#marcarTodos').click(function() {
        $('.obrigacao-check').prop('checked', true);
    });
    // DESMARCAR TODOS
    $('#desmarcarTodos').click(function() {
        $('.obrigacao-check').prop('checked', false);
    });
  </script>
<?= $this->endSection() ?>