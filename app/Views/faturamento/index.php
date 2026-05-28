  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTA DE FATURAMENTO</h5>
          </div>
          <div class="card-body">
            <?php if(hasPermission('criarFaturamento')): ?>
              <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModalFaturamento"><i class="fas fa-plus-square"></i> NOVO FATURAMENTO</button>
            <?php endif; ?>
             <?php if(empty($faturamento)): ?>
              <div class="alert alert-warning mb-0">
                Nenhum certificado cadastrado.
              </div>
            <?php else : ?>
              <table id="faturamentoTable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ANO</th>
                    <th>MÊS</th>
                    <th>VALOR</th>
                    <?php if(hasAnyPermission(['modificarFaturamento', 'apagarFaturamento'])): ?>
                    <th class="text-center text-nowrap col-auto">AÇÕES</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <?php $total_faturamento = 0; ?>
                <tbody>
                  <?php foreach($faturamento as $value) :?>
                    <?php $total_faturamento += $value['valor']; ?>
                    <tr>
                      <td><?= $value['ano'] ?></td>
                      <td><?= $value['mes'] ?></td>
                      <td><?= number_format($value['valor'], 2, ',', '.') ?></td>
                      <td class="text-center text-nowrap col-auto">
                        <?php if(hasPermission('modificarFaturamento')): ?>
                          <button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editFaturamento('<?= $value['id'] ?>')"><i class="fas fa-edit"></i></button>
                        <?php endif; ?>
                        <?php if(hasPermission('apagarFaturamento')): ?>
                          <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeFaturamento('<?= $value['id']?>')" data-toggle="modal"><i class="fas fa-trash"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                      <th colspan="2" class="text-left bg-secondary">
                          TOTAL:
                      </th>
                      <th class="bg-secondary">R$ <?= number_format($total_faturamento, 2, ',', '.') ?></th>
                      <th></th>                      
                  </tr>
                </tfoot>
              </table>
            <?php endif; ?>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- col-md-12 -->
    </div><!-- /.row -->
  </section><!-- /.content -->
  <?= $this->include('modal/modal_faturamento') ?>