<!DOCTYPE html>

<html
        lang="en"
        class="light-style layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="<?= base_url('public/assets').'/' ?>"
        data-template="horizontal-menu-template-starter"
>
<head>
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?= APP_NAME ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/assets/img/branding/logo-beq.png') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
    />

    <?= site_load_css() ?>
    <script src="<?= base_url('public/assets/vendor/js/helpers.js') ?>"></script>

    <script src="<?= base_url('public/assets/js/config.js') ?>"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
        <!-- Navbar -->

        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="container-xxl">
                <div class="navbar-brand brand demo d-none d-xl-flex py-0 me-4">
                    <a href="/" class="brand-link gap-2">
                <span class="brand-logo demo" style="min-height: 45px">
                  <img src="<?= base_url('public/assets/img/branding/GIOHANG.png') ?>" alt="avatar"

                       height="60"
                       width="auto" class="cursor-pointer">
                </span>
                        <span class="brand-text demo menu-text fw-bold"><?= APP_NAME ?></span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                        <i class="ti ti-x ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="ti ti-menu-2 ti-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Style Switcher -->
                        <li class="nav-item me-2 me-xl-0">
                            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                                <i class="ti ti-md"></i>
                            </a>
                        </li>
                        <!--/ Style Switcher -->

                        <!-- User HEADER -->
                        <?= view('\Modules\Layouts\Views\components\header-account') ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Menu -->
                <?= view('\Modules\Layouts\Views\components\menu-bar') ?>
                <!-- / Menu -->



