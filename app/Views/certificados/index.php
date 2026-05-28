<?php /** @var array $certificados */ ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <h5 class="text-center">LISTA DE CERTIFICADOS</h5>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
            <?php if (hasPermission('criarCertificado')): ?>
                <button class="btn btn-lg btn-primary mb-2" data-toggle="modal" data-target="#addModalCertificado"><i class="fas fa-plus-square"></i> NOVO CERTIFICADO</button>
              <?php endif; ?>
            <?php if(empty($certificados)): ?>
              <div class="alert alert-warning mb-0">
                Nenhum certificado cadastrado.
              </div>
            <?php else : ?>
              <table id="CertificadoTable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>DESCRIÇÃO</th>
                    <th>VALIDADE</th>
                    <th>SENHA</th>
                    <th>SITUAÇÃO</th>
                    <?php if (hasAnyPermission(['modificarCertificado','apagarCertificado'])): ?>
                      <th class="text-center text-nowrap col-auto">AÇÕES</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($certificados as $value): ?>
                    <tr>
                      <td><?= $value['descricao'] ?></td>
                      <td><?= date('d/m/Y',strtotime($value['dt_validade'])) ?></td>
                      <td><?= $value['senha'] ?></td>
                      <td><?= $value['ativo'] == 1 ? '<span class="badge badge-success">ATIVO</span>' : '<span class="badge badge-danger">INATIVO</span>' ?></td>
                      <td class="text-center text-nowrap col-auto">
                        <?php if(hasPermission('modificarCertificado')): ?>
                          <button type="button" class="btn btn-primary" style="font-size:0.55em" onclick="editCertificado('<?= $value['id'] ?>')"><i class="fas fa-edit"></i></button>
                        <?php endif; ?>
                        <?php if(hasPermission('apagarCertificado')): ?>
                          <button type="button" class="btn btn-danger" style="font-size:0.55em" onclick="removeCertificado('<?= $value['id'] ?>')" data-toggle="modal" data-target="#removeModalCertificado"><i class="fas fa-trash"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- col-md-12 -->
    </div><!-- /.row -->
  </section> <!-- /.content -->
  <?= $this->include('modal/modal_certificados') ?>
