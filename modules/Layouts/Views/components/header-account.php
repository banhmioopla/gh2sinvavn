<?php
$header_account_name = $header_account_role = $header_account_id = "";
if(session()->has('auth_data')):
    $roleModel = new \App\Models\BeqRole();

    $auth_data = session()->get('auth_data');

    $header_account_name =$auth_data->name;
    $header_account_role =$roleModel->getNameById($auth_data->role_id);
    $header_account_id = $auth_data->id;
    ?>

    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
                <img src="<?= base_url('/render/show-avatar-image/'.$header_account_id) ?>" alt class="h-auto rounded-circle" />
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="#">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                                <img src="<?= base_url('/render/show-avatar-image/'.$header_account_id) ?>" alt class="h-auto rounded-circle" />
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?= $header_account_name ?></span>
                            <small class="text-muted"><?= $header_account_role ?></small>
                        </div>
                    </div>
                </a>
            </li>

            <li>
                <div class="dropdown-divider"></div>
            </li>
            <li>
                <a class="dropdown-item" href="<?= base_url('/backoffice/logout') ?>">
                    <i class="ti ti-logout me-2 ti-sm"></i>
                    <span class="align-middle">Logout</span>
                </a>
            </li>
        </ul>
    </li>

<?php endif; ?>