<?= $this->include('\Modules\Layouts\Views\components\header') ?>

<div class="container-xxl flex-grow-1 container-p-y">

    <?= $this->renderSection('nav_breadcrumb') ?>
    <h4 class="fw-bold py-1 mb-4"><?= $this->renderSection('breadcrumb_text') ?></h4>
    <?= $this->renderSection('main_content') ?>
</div>
<?= $this->include('\Modules\Apartment\Views\apartment\modal-form-add-new-contract') ?>
<?= $this->include('\Modules\Layouts\Views\components\footer') ?>
