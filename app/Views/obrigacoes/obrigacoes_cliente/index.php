<?php 
  /** @var array $obrigacoescli */
  /** @var int $id_cliente */
  /** @var int $concluidas*/
  /** @var array $combo_obrigacoes*/
?>
  <div class="row mb-3">
    <?php if(hasPermission('criarObrigacao')): ?>
      <div class="col-md-6">
        <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#addModalObrigacaoCliente"><i class="fas fa-plus-square"></i> INSERIR NA FICHA</button>
      </div>
    <?php endif; ?>
    <?php if(count($obrigacoescli) > 0): ?>
      <?php if(hasPermission('modificarObrigacao')): ?>
        <div class="col-md-6">
          <a href="<?= site_url('obrigacoes_cliente/remover/'.$id_cliente) ?>" class="btn btn-lg btn-danger btn-block"><i class="fas fa-minus-square"></i> REMOVER DA FICHA</a>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <br>
  <div id="obrigacoes">
    <table class="table table-striped table-bordered">
      <thead class="bg-primary text-white">
        <tr>
          <th style="text-align:center;">TAREFA</th>
          <th style="text-align:center;">AÇÃO</th>
        </tr>                        
      </thead>
      <tbody>
        <?php foreach($obrigacoescli as $k ) : ?>
          <?php if ($k['feito']==1) : ?>
            <tr class="bg-light">
              <td width="50%" style="text-align:center;text-decoration: line-through;"><?= $k['descricao']; ?> Feito em <?= !empty($k['dt_ultimo']) ? date('d/m/Y', strtotime($k['dt_ultimo'])) : '-'; ?></td>
              <td style="text-align:center"><button type="button" class="btn btn-warning" data-toggle="modal" title="Desfazer essa Obrigação" data-target="#desfeitoModal" data-id="<?= $k['id_obrigacao']; ?>" data-cliente="<?= $k['id_cliente'] ?>"><i class="fa fa-minus"></i></button></td>
          <?php else : ?>
            <tr class="bg-default">
              <td style="text-align:center"><?= $k['descricao']; ?></td>
              <td style="text-align:center"><button type="button" class="btn btn-success" data-toggle="modal" title="Realizar essa Obrigação" data-target="#feitoModal" data-id="<?= $k['id_obrigacao']; ?>" data-cliente="<?= $k['id_cliente'] ?>"><i class="fa fa-check"></i></button></td>
            <?php endif; ?>
          </tr>
        <?php endforeach ; ?>
      </tbody>
    </table>
    <?php if ($concluidas): ?>
      <div class="text-center mt-3">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModalCobranca"><i class="fa fa-dollar-sign"></i> Enviar para Cobrança</button>
      </div>
    <?php endif; ?>
  </div>
  <?= $this->include('modal/modal_obrigacoes_cliente') ?>