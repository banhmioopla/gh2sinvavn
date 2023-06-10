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
<div class="row justify-content-center my-5">
    <div class="col-xl-8 text-center ">
        <div id="contract-new-progress" class="row justify-content-center"><?= session()->get('contract_new_progress') ?? '<span class="alert alert-danger d-flex align-items-center"><span class="alert-icon text-danger me-2"><i class="ti ti-ban ti-xs"></i></span> Something wrong !!!!</span>' ?></div>
    </div>
</div>

<div class="row mb-3 justify-content-center" id="section-pick-apartment">
    <h4 class="col-xl-12 text-center">Chọn dự án</h4>
    <div class="col-xl-4">
        <label>Chọn Dự Án</label>
        <?= $dropdown_apartment ?>
    </div>
    <div class="col-xl-4">
        <label>Chọn Mã Phòng</label>
        <div id="picking-room" class="text-danger"> <span class="alert alert-warning d-flex align-items-center"><span class="alert-icon text-warning me-2"><i class="ti ti-ban ti-xs"></i></span> Chọn dự án đi bạn !!!!</span></div>
    </div>
</div>

<div class="row mb-3 justify-content-center" id="section-deal">
    <h4 class="col-xl-12 text-center">Thông tin Deal</h4>

    <div class="col-xl-7 mb-3">
        <label class="form-label" for="consultant_id">Sale Chốt</label>
        <input type="text" class="form-control" id="consultant_id">
    </div>

    <div class="col-xl-1 mb-3">
        <label for="rate_type" class="form-label text-center d-block">★</label>
        <input type="text" class="form-control" id="rate_type">
    </div>

    <div class="col-xl-8 mb-3">
        <label class="form-label" for="support_ids">Sale Hỗ Trợ</label>
        <input type="text" class="form-control" id="support_ids">
    </div>

    <div class="col-xl-8 mb-3">
        <div class="row">
            <div class="col-xl-12 text-center"><span class="text-warning"> <i class="ti ti-alert-triangle"></i>(Hoa Hồng Ký Gửi, Giá Thuê) => do hệ thống đề xuất! Vui lòng tự kiểm tra lại deal thực tế</span></div>
            <div class="col-xl-6">
                <label class="form-label" for="room_price">Giá Thuê</label>
                <input type="text" class="form-control numeral-formatting" id="room_price">
            </div>

            <div class="col-xl-3">
                <label class="form-label" for="months">Số tháng thuê</label>
                <input type="text" class="form-control" id="months">
            </div>
            <div class="col-xl-3">
                <label class="form-label" for="commission_rate">Hoa Hồng Ký Gửi</label>
                <input type="text" class="form-control" id="commission_rate">
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="row">
            <div class="col-xl-6 mb-3">
                <label class="form-label" for="time_start">Ngày bắt đầu</label>
                <input type="text" class="form-control app-custom-date-picker" id="time_start">
            </div>
            <div class="col-xl-6 mb-3">
                <label class="form-label" for="time_end">Ngày kết thúc</label>
                <input type="text" class="form-control app-custom-date-picker" id="time_end">
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="row">
            <div class="col-xl-6 mb-3">
                <label class="form-label" for="deposit">Tiền đặt cọc</label>
                <input type="text" class="form-control numeral-formatting" id="deposit">
            </div>
            <div class="col-xl-6 mb-3">
                <label class="form-label" for="cost">Tiền Hỗ Trợ Thuê Phòng</label>
                <input type="text" class="form-control numeral-formatting" id="cost">
            </div>
        </div>
    </div>

    <div class="col-xl-8 mb-3">
        <label class="form-label" for="note">Ghi Chú</label>
        <textarea type="text" class="form-control" id="note"></textarea>
    </div>

    <div class="col-xl-8 mb-3">
        <label for="formFileMultiple" class="form-label">Upload Ảnh Hợp Đồng | Cọc</label>
        <input class="form-control" type="file" id="formFileMultiple" multiple="">
    </div>
</div>

<div class="row mb-3 justify-content-center" id="section-customer">
    <h4 class="col-xl-12 text-center">Thông Tin Khách Thuê</h4>

    <div class="col-xl-8 mb-3">
        <label class="form-label" for="customer_phone">Số Điện thoại</label>
        <div class="input-group">
            <input type="text" class="form-control" id="customer_phone">
            <button class="btn btn-outline-primary waves-effect" type="button" id="button-addon2">Check</button>
        </div>
    </div>

    <div class="col-xl-8 mb-3">
        <label class="form-label" for="customer_name">Họ & Tên</label>
        <input type="text" class="form-control" id="customer_name">
    </div>

    <div class="col-xl-8 mb-3">
        <label class="form-label" for="customer_birthdate">Ngày Sinh</label>
        <input type="text" class="form-control app-custom-date-picker" id="customer_birthdate">
    </div>

    <div class="col-xl-8 mb-3">
        <label class="form-label" for="customer_email">Email</label>
        <input type="text" class="form-control" id="customer_email">
    </div>

    <div class="col-xl-8 mb-3">
        <label class="form-label" for="ID_card">Chứng minh thư, căn cước công dân</label>
        <input type="text" class="form-control" id="ID_card">
    </div>

    <div class="col-xl-8 mb-3">
        <label class="form-label" for="address_street">Địa chỉ</label>
        <input type="text" class="form-control" id="address_street">
    </div>

</div>

<div class="row justify-content-center" id="section-confirm">
    <div class="col-xl-12 my-3 text-center">
        <button class="btn btn-secondary" id="btn-cancel"> <i class="ti ti-ban me-2"></i> Hủy Deal</button>
        <button class="btn btn-primary" id="btn-continue"> <i class="ti ti-chevrons-right me-2 ti-flashing"></i> Xác nhận...</button>
    </div>
</div>

<?= load_single_js('apartment/contract.js') ?>
<?= $this->endSection() ?>
