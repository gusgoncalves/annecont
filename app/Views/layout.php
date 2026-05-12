<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->renderSection('title') ?? 'Sistema' ?></title>
        <?= view('templates/header') ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
        <div id="toast-container" style="position: fixed;top: 20px;right: 20px;z-index: 9999;width: 400px;"></div>
        <div class="wrapper">
            <?= view('templates/header_menu') ?>
            <?= view('templates/side_menubar') ?>

            <div class="content-wrapper">
                <?= $this->renderSection('content') ?>
            </div>
        </div>

        <?= $this->renderSection('scripts') ?>
            <script>
                <?php if (session()->getFlashdata('success')): ?>
                    showToast("<?= session()->getFlashdata('success') ?>", "success");
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    showToast("<?= session()->getFlashdata('errors') ?>", "error");
                <?php endif; ?>
            </script>
    </body>
</html>