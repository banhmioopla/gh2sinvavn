<?php
/**
 * @var string $dropdown_apartment
 * @var string $breadcrumb
 * @var string $contract_new_progress
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
<div class="row justify-content-center my-3">
    <div class="col-xl-8 text-center ">
        <div id="contract-new-progress"><?= session()->get('contract_new_progress') ?? '<span class="alert alert-danger d-flex align-items-center"><span class="alert-icon text-danger me-2"><i class="ti ti-ban ti-xs"></i></span> Something wrong !!!!</span>' ?></div>
    </div>
</div>

<div class="row justify-content-center">

    <div class="col-xl-4">
        <label>Chọn Dự Án</label>
        <?= $dropdown_apartment ?>
    </div>
    <div class="col-xl-4">
        <label>Chọn Mã Phòng</label>
        <div id="picking-room" class="text-danger"> <span class="alert alert-warning d-flex align-items-center"><span class="alert-icon text-warning me-2"><i class="ti ti-ban ti-xs"></i></span> Chọn dự án đi bạn !!!!</span></div>
    </div>

    <div class="col-xl-12 my-3 text-center">
        <button class="btn btn-secondary" id="btn-cancel"> <i class="ti ti-ban me-2"></i> Hủy Deal</button>
        <button class="btn btn-primary" id="btn-continue"> <i class="ti ti-chevrons-right me-2 ti-flashing"></i> Tu bi con ti niu...</button>
    </div>
</div>

<div class="row mb-3">

</div>


<?= load_single_js('apartment/contract.js') ?>
<?= $this->endSection() ?>
