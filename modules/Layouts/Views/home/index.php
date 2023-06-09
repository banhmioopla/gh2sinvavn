<?php
/**
 * @var string $dropdown_district
 * @var string $progress
 * @var string $contract_table
 * @var int $contract_count
 * @var int $sale_amount
 * @var string $progress_sale
 */

?>
<?= $this->extend('\Modules\Layouts\Views\base') ?>
<?= $this->section('head_title') ?>
<?= 'Danh sách tools' ?>
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<div class="row justify-content-xl-center">
    <div class="col-xl-4 text-xl-center mb-3">
        <div class="mb-1">Số lượng hợp đồng tích lũy <strong><?= number_format($contract_count) ?></strong></div>
        <div><?= $progress ?></div>
    </div>


    <div class="col-xl-4 text-xl-center mb-3">
        <div class="mb-1">Doanh số tích lũy <strong><?= number_format($sale_amount) ?> vnđ</strong></div>
        <div><?= $progress_sale ?></div>
    </div>

</div>
<div class="row justify-content-xl-center">
    <div class="col-xl-4">
        <div class="demo-inline-spacing mt-3">
            <div class="list-group">
                <div class="list-group-item bg-secondary text-white fw-bold text-center">Dự Án</div>
                <a href="<?= base_url('/apm/sightseeing') ?>" class="list-group-item list-group-item-action">
                    <i class="ti ti-bed ti-sm me-2"></i>
                    Xem thông tin phòng
                </a>
                <a href="<?= base_url('/apm/downloader/preview') ?>" class="list-group-item list-group-item-action">
                    <i class="ti ti-download ti-sm me-2"></i>
                    Tải ảnh phòng
                </a>
                <a href="<?= base_url('/apm/contract/new') ?>" class="list-group-item list-group-item-action">
                    <i class="ti ti-file-plus ti-sm me-2"></i>
                    Nhập hợp đồng
                </a>
                <a href="" class="list-group-item list-group-item-action">
                    <i class="ti ti-loader ti-sm me-2 ti-spin"></i>
                    <del>Thêm thành viên mới</del>
                </a>

            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="demo-inline-spacing mt-3">
            <div class="list-group">
                <div class="list-group-item bg-secondary text-white fw-bold text-center"><?= session()->get('auth_data')?->name ?></div>
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
                <button type="button" id="submit-logout" class="list-group-item list-group-item-action d-flex justify-content-between">
                    <i class="ti ti-door-exit ti-sm me-2"></i>
                    <span class="text-center">Đăng Xuất</span>

                </button>
            </div>
        </div>
    </div>
</div>
<hr class="my-5">
<div class="row justify-content-xl-center">
    <div class="col-md-12">
        <?= $contract_table ?>
    </div>
</div>


<?= load_single_js('apartment/contract.js') ?>
<?= load_single_js('auth/login.js') ?>
<?= $this->endSection() ?>
