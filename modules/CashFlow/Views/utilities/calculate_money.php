<?php
/**
 * @var array $denominations
 */

?>
<?= $this->extend('\Modules\Layouts\Views\base') ?>
<?= $this->section('head_title') ?>
<?= 'Máy Tính Tiền' ?>
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>

    <div class="row">
        <div class="col-xl-4">
            <h4>Nhập số tờ theo mệnh giá</h4>
            <div class="row justify-content-center">
                <?php foreach ($denominations as $item):?>
                    <div class="mb-3 col-4">
                        <label><?= number_format($item) ?></label>
                        <input type="text" min="0" data-deno="<?= $item ?>" class="form-control money-counter">
                    </div>
                <?php endforeach;?>
            </div>
        </div>

        <div class="col-xl-8 text-center">
            <h2>Kết Quả Tính</h2>
            <h2 id="result"></h2>
        </div>
    </div>
    <?= load_single_js('calculate_money.js') ?>
<?= $this->endSection() ?>
