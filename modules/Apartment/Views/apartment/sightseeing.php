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
            <?= anchor(base_url('home'), "Danh sách tools") ?>
        </li>
        <li class="breadcrumb-item active"><?= $breadcrumb ?></li>
    </ol>
</nav>
<?= $this->endSection() ?>

<?= $this->section('breadcrumb_text') ?>
<?= $breadcrumb ?>
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<div class="row mb-3 border-bottom pb-3">

    
    <div class="col-xl">
        <label>Chọn Quận</label>
        <div><?= $dropdown_district ?></div>
    </div>

    <div class="col-xl">
        <label>Giá Min</label>
        <div><input type="text" name="price_min" class="form-control numeral-formatting"></div>
    </div>

    <div class="col-xl">
        <label>Giá Max</label>
        <div><input type="text" name="price_max" class="form-control numeral-formatting"></div>
    </div>

    <div class="col-xl">
        <label>Chọn Dự Án</label>
        <div id="pick-apartment">loading dự án...</div>
    </div>

    <div class="col-xl-12 mt-2 text-center">
        <button class="btn btn-primary" id="searching-room">Tìm Phòng</button>
    </div>
</div>

<div class="row mb-3"><div class="text-center" id="searching-title"></div></div>
<div class="row mb-3" id="room-board"><div class="text-center"> <i class="ti ti-loader ti-spin"></i> Loading Phòng...</div></div>

<?= load_single_js('apartment/sightseeing.js') ?>
<?= $this->endSection() ?>
