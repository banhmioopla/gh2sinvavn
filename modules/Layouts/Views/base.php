<?= $this->include('\Modules\Layouts\Views\components\header') ?>

<div class="container-xxl flex-grow-1 container-p-y">

    <?= $this->renderSection('nav_breadcrumb') ?>
    <h4 class="fw-bold py-3 mb-4"><?= $this->renderSection('breadcrumb_text') ?></h4>
    <?= $this->renderSection('main_content') ?>
</div>
<?= $this->include('\Modules\Layouts\Views\components\footer') ?>
