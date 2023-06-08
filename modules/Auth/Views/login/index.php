<?php
/**
 * @var string $dropdown_district
 */

?>
<?= $this->extend('\Modules\Layouts\Views\base') ?>
<?= $this->section('head_title') ?>
<?= 'Đăng nhập Giỏ Hàng' ?>
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<div class="row justify-content-xl-center">
    <div class="col-xl-4">
        <div class="text-start mb-4">
            <h3 class="mb-2 text-center " id="login-title">Đăng nhập Giỏ Hàng</h3>
        </div>

        <input type="text" id="phone_number" name="phone_number" class="form-control mb-3" placeholder="nhập số điện thoại 0945172814">
        <input type="password" id="password" name="password" class="form-control mb-3" placeholder="*****">

        <div class="text-center mt-2">

            <button type="button" id="submit-login" class="btn btn-primary me-sm-3 me-1 d-block w-100 waves-effect waves-light mb-3">Đăng Nhập</button>
            <a href="#" class="card-link">Quên mật khẩu ? </a>
        </div>
    </div>
</div>
<?= load_single_js('auth/login.js') ?>
<?= $this->endSection() ?>
