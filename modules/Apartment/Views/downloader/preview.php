<?php
/**
 * @var string $dropdown_district
 * @var string $breadcrumb
 */

?>
<?= $this->extend('\Modules\Layouts\Views\base') ?>

<?= $this->section('head_title') ?>
<?= $breadcrumb ?>
<?= $this->endSection() ?>



<?= $this->section('nav_breadcrumb') ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <?= anchor('/home', "Danh sách tools") ?>
        </li>
        <li class="breadcrumb-item active"><?= $breadcrumb ?></li>
    </ol>
</nav>
<?= $this->endSection() ?>

<?= $this->section('breadcrumb_text') ?>
<?= $breadcrumb ?>
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<form method="POST" action="<?= base_url('apm/downloader/submit-download') ?>" class="row mb-2">
    <div class="col-xl-4">
        <label>Chọn Quận</label>
        <div><?= $dropdown_district ?></div>
    </div>
    <div class="col-xl-4">
        <label>Chọn Dự Án</label>
        <div id="pick-apartment">loading dự án...</div>
    </div>
    <div class="col-xl-4">
        <label>Chọn phòng</label>
        <div id="pick-room">loading phòng...</div>
    </div>
    <div class="col mt-2">
        <?= form_button([
            'content' => 'Down Ảnh/Video',
            'class' => 'btn btn-primary',
            'id' => 'submitDownload',
            'type' => 'submit'
        ]) ?>
    </div>
</form>

<div class="row">


</div>

<?= load_single_js('apartment/downloader.js') ?>
<?= $this->endSection() ?>
