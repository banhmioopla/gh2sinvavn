<?php
/**
 * @var string $dropdown_district
 */

?>
<?= $this->extend('\Modules\Layouts\Views\base') ?>

<?= $this->section('breadcrumb_text') ?>
<?= 'Tải ảnh dự án ' ?>
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
