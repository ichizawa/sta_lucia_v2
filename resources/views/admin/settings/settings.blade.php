<style>
    .list-group-item.active {
        color: white !important;
        background-color: #8B7231 !important;
        border-color: transparent !important;
    }

    .btn {
        background-color: #8F8258 !important;
        color: white !important;
    }

    .card-header {
        border-radius: 5px !important;
    }

    .nav-item .active {
        background-color: #d7d2c0 !important;
        color: #725d29 !important;
    }
</style>

@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Settings</h3>
                <h6 class="op-7 mb-2">Account Overview</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3 text-center">
                <div class="card p-3">
                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account"
                            role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password"
                            role="tab">
                            Password
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#privacy_safety"
                            role="tab">
                            Privacy & Safety
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#email_notifications"
                            role="tab">
                            Email notifications
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#web_notifications"
                            role="tab">
                            Web notifications
                        </a>
                        <a id="widgets-alert" class="list-group-item list-group-item-action" href="javascript:void(0)">
                            Widgets
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#your_data"
                            role="tab">
                            Your data
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#delete_accounts"
                            role="tab">
                            Delete accounts
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link setting-nav-link-color active" id="public_info-tab" data-bs-toggle="tab"
                                    href="#public_info" role="tab" aria-controls="public_info" aria-selected="true">
                                    Public Information
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link setting-nav-link-color" id="private_info-tab" data-bs-toggle="tab"
                                    href="#private_info" role="tab" aria-controls="private_info" aria-selected="false">
                                    Private Information
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="public_info" role="tabpanel"
                                aria-labelledby="public_info-tab">
                                <div class="card">
                                    <div class="card-header brown-border-top">
                                        <div class="card-actions float-end">
                                            <div class="dropdown show">
                                                <a href="#" data-bs-toggle="dropdown" data-display="static">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-more-horizontal align-middle">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="19" cy="12" r="1"></circle>
                                                        <circle cx="5" cy="12" r="1"></circle>
                                                    </svg>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="card-title mb-0">Public info</h5>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-4 px-4">
                                                    <div class="text-center">
                                                        <img alt="Andrew Jones"
                                                            src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                            class="rounded-circle img-responsive mt-2" width="128"
                                                            height="128">
                                                        <div class="mt-3 mb-2">
                                                            <span class="btn"><i class="fa fa-upload"></i></span>
                                                        </div>
                                                        <small>For best results, use an image at least 128px by 128px in
                                                            .jpg
                                                            format</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="inputUsername">Username</label>
                                                        <input type="text" class="form-control" id="inputUsername"
                                                            placeholder="Username">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputUsername">Biography</label>
                                                        <textarea rows="2" class="form-control" id="inputBio" placeholder="Tell something about yourself"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex justify-content-end">
                                                <button type="submit" class="btn">
                                                    <i class="fa-solid fa-check"></i> Save changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="private_info" role="tabpanel"
                                aria-labelledby="private_info-tab">
                                <div class="card">
                                    <div class="card-header brown-border-top">
                                        <div class="card-actions float-end">
                                            <div class="dropdown show">
                                                <a href="#" data-bs-toggle="dropdown" data-display="static">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-more-horizontal align-middle">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="19" cy="12" r="1"></circle>
                                                        <circle cx="5" cy="12" r="1"></circle>
                                                    </svg>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="card-title mb-0">Private info</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="inputFirstName">First name</label>
                                                        <input type="text" class="form-control" id="inputFirstName"
                                                            placeholder="First name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="inputLastName">Last name</label>
                                                        <input type="text" class="form-control" id="inputLastName"
                                                            placeholder="Last name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" id="inputEmail4"
                                                            placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputAddress">Address 1</label>
                                                        <input type="text" class="form-control" id="inputAddress"
                                                            placeholder="1234 Main St">
                                                    </div>

                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputAddress2">Address 2</label>
                                                        <input type="text" class="form-control" id="inputAddress2"
                                                            placeholder="Apartment, studio, or floor">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputCity">City</label>
                                                        <input type="text" class="form-control" id="inputCity">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="inputState">State</label>
                                                        <select id="inputState" class="form-control">
                                                            <option selected="">Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="inputZip">Zip</label>
                                                        <input type="text" class="form-control" id="inputZip">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn">
                                                            <i class="fa-solid fa-check"></i>
                                                            Save changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-header brown-border-top">
                                <h5 class="card-title">Password</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted"> <i>Reset you password</i></p>
                                <form class="px-3">
                                    <div class="form-group">
                                        <label for="inputPasswordCurrent">Current password</label>
                                        <input type="password" class="form-control" id="inputPasswordCurrent">
                                        <small><a href="#">Forgot your password?</a></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew">New password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew2">Verify password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew2">
                                    </div>
                                    <div class="form-group d-flex justify-content-end">
                                        <button type="submit" class="btn">
                                            <i class="fa-solid fa-check"></i>
                                            Save changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="privacy_safety" role="tabpanel">
                        @include('admin.settings.privacy_and_safety')
                    </div>

                    <div class="tab-pane fade" id="email_notifications" role="tabpanel">
                        @include('admin.settings.email_notifications')
                    </div>

                    <div class="tab-pane fade mt-0" id="web_notifications" role="tabpanel">
                        @include('admin.settings.web_notifications')
                    </div>

                    <div class="tab-pane fade" id="your_data" role="tabpanel">
                        @include('admin.settings.your_data')
                    </div>

                    <div class="tab-pane fade" id="delete_accounts" role="tabpanel">
                        @include('admin.settings.delete_accounts')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
