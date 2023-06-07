<?php
/**
 * @var string $dropdown_district
 */

?>
<?= $this->extend('\Modules\Layouts\Views\base') ?>
<?= $this->section('head_title') ?>
<?= 'Danh sách tools' ?>
<?= $this->endSection() ?>

<?= $this->section('breadcrumb_text') ?>
<?= 'Danh sách tools' ?>
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<div class="row justify-content-xl-center">
    <div class="col-xl-4">
        <div class="demo-inline-spacing mt-3">
            <div class="list-group">
                <a href="<?= base_url('/apm/sightseeing') ?>" class="list-group-item list-group-item-action">
                    <i class="ti ti-bed ti-sm me-2"></i>
                    Xem thông tin phòng
                </a>
                <a href="<?= base_url('/apm/downloader/preview') ?>" class="list-group-item list-group-item-action">
                    <i class="ti ti-download ti-sm me-2"></i>
                    Tải ảnh phòng
                </a>
                <a href="" class="list-group-item list-group-item-action">
                    <i class="ti ti-loader ti-sm me-2 ti-spin"></i> <del>Nhập hợp đồng</del>
                </a>
                <a href="" class="list-group-item list-group-item-action">
                    <i class="ti ti-loader ti-sm me-2 ti-spin"></i>
                    <del>Thêm thành viên mới</del>
                </a>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
