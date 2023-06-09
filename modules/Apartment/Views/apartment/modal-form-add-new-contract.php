<?php

$LibApartment = new \App\Libraries\LibApartment();
$dropdown_apartment = $LibApartment->dropdownApartment();

?>

<div
    class="modal-onboarding modal fade animate__animated h-100"
    id="add-new-contract-modal"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal"
                >Skip Intro</a
                >
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div id="modalCarouselControls" class="carousel slide pb-4 mb-2" data-bs-interval="false">
                <ol class="carousel-indicators">
                    <li data-bs-target="#modalCarouselControls" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#modalCarouselControls" data-bs-slide-to="1"></li>
                    <li data-bs-target="#modalCarouselControls" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="onboarding-content">
                            <h4 class="onboarding-title text-body">Example Request Information</h4>
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="nameEx" class="form-label">Dự án</label>
                                            <?= $dropdown_apartment ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="roleEx" class="form-label">Your Role</label>
                                            <select class="form-select" tabindex="0" id="roleEx">
                                                <option>Web Developer</option>
                                                <option>Business Owner</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="onboarding-content">
                            <h4 class="onboarding-title text-body">Example Request Information</h4>
                            <div class="onboarding-info">
                                In this example you can see a form where you can request some additional
                                information from the customer when they land on the app page.
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="nameEx1" class="form-label">Your Full Name</label>
                                            <input
                                                class="form-control"
                                                placeholder="Enter your full name..."
                                                type="text"
                                                value=""
                                                tabindex="0"
                                                id="nameEx1"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="roleEx1" class="form-label">Your Role</label>
                                            <select class="form-select" tabindex="0" id="roleEx1">
                                                <option>Web Developer</option>
                                                <option>Business Owner</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="onboarding-content">
                            <h4 class="onboarding-title text-body">Example Request Information</h4>
                            <div class="onboarding-info">
                                In this example you can see a form where you can request some additional
                                information from the customer when they land on the app page.
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="nameEx2" class="form-label">Your Full Name</label>
                                            <input
                                                class="form-control"
                                                placeholder="Enter your full name..."
                                                type="text"
                                                value=""
                                                tabindex="0"
                                                id="nameEx2"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="roleEx2" class="form-label">Your Role</label>
                                            <select class="form-select" tabindex="0" id="roleEx2">
                                                <option>Web Developer</option>
                                                <option>Business Owner</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a
                    class="carousel-control-prev"
                    href="#modalCarouselControls"
                    role="button"
                    data-bs-slide="prev"
                >
                    <i class="ti ti-chevrons-left me-2"></i><span>Previous</span>
                </a>
                <a
                    class="carousel-control-next"
                    href="#modalCarouselControls"
                    role="button"
                    data-bs-slide="next"
                >
                    <span>Next</span><i class="ti ti-chevrons-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>