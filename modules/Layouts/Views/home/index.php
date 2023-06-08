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
<?= 'Giỏ Hàng Sinva Version 2' ?>
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

<div class="row justify-content-xl-center">
    <div class="col-xl-4">
        <div class="demo-inline-spacing mt-3">
            <div class="list-group">
                <div class="list-group-item bg-secondary text-white fw-bold text-center">Tài Khoản</div>
                <div class="list-group-item d-flex justify-content-between">
                    <i class="ti ti-face-id ti-sm me-2"></i>
                    <span><?= session()->get('auth_data')?->account_id ?></span>
                </div>

                <div class="list-group-item d-flex justify-content-between">
                    <i class="ti ti-user ti-sm me-2"></i>
                    <?= session()->get('auth_data')?->name ?>
                </div>

                <div class="list-group-item d-flex justify-content-between">
                    <i class="ti ti-phone-call ti-sm me-2"></i>
                    <?= session()->get('auth_data')?->phone_number ?>
                </div>

                <div class="list-group-item d-flex justify-content-between">
                    <i class="ti ti-candle ti-sm me-2"></i>
                    <?= date("d/m/Y",session()->get('auth_data')?->date_of_birth) ?>
                </div>

                <div class="list-group-item d-flex justify-content-between">
                    <i class="ti ti-mail ti-sm me-2"></i>
                    <?= session()->get('auth_data')?->email ?? '<span class="text-warning"><i class="ti ti-alert-circle"></i> chưa cập nhật</span>' ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-xl-center">
    <div class="col-xl-4">
        <div class="demo-inline-spacing mt-3">
            <div class="list-group">
                <button type="button" id="submit-logout" class="list-group-item list-group-item-action">
                    <i class="ti ti-door-exit ti-sm me-2"></i>
                    Đăng xuất
                </button>
            </div>
        </div>
    </div>
</div>
<?= load_single_js('auth/login.js') ?>
<?= $this->endSection() ?>
