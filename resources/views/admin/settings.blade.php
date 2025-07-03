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
                        <div class="card">
                            <div id="contentListContainer">
                                <div class="card-header brown-border-top">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h5 class="card-title mb-0">
                                                Privacy & Safety
                                                <i class="fa-solid fa-user-shield"></i>
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <button id="addContentBtn" class="btn btn-sta">
                                                <i class="fa-solid fa-plus"></i> Add Content
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover datatable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Author</th>
                                                    <th class="text-center">Created at</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Privacy Policy Update</td>
                                                    <td class="text-center">Faye Macs</td>
                                                    <td class="text-center">May 23, 2025</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#contentModal"
                                                            data-title="Privacy Policy Update"
                                                            data-description="An update to how we collect, use, and protect your personal data. We are committed to transparency and ensuring your privacy rights are respected. This update clarifies data retention periods and user consent options."
                                                            data-author="Faye Macs" data-date="May 23, 2025">
                                                            <i class="fa fa-pen text-white"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash text-white"></i>
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="contentModal" tabindex="-1"
                                                        aria-labelledby="contentModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header brown-border-top">
                                                                    <h5 class="modal-title" id="contentModalLabel">Content
                                                                        Details</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Title:</strong> <span
                                                                            id="modalTitle"></span></p>
                                                                    <p class="mb-0"><strong>Description:</strong></p>
                                                                    <p id="modalDescription"></p>
                                                                    <p class="text-muted mt-5 mb-0 small">
                                                                        <strong>Author:</strong>
                                                                        <span id="modalAuthor"></span> | <strong>Date
                                                                            Created:</strong> <span id="modalDate"></span>
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-sta btn-sm"
                                                                        onclick="openPrivacySafetyEditor()">
                                                                        <i class="far fa-edit"></i> Update
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="privacySafetyNewContent" class="d-none">
                                <div class="card-header brown-border-top">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h5 class="card-title mb-0">Privacy & Safety</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex mb-3">
                                        <div class="col-sm-3 d-flex justify-content-start mt-1">
                                            Create new content...
                                        </div>
                                        <div class="col-sm-3 ms-auto">
                                            <input type="text" class="form-control form-control-sm" id="authorName"
                                                placeholder="Author Name">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control form-control-sm" id="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control form-control-lg mb-3"
                                        placeholder="Add Title">
                                    <div id="editor"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="#contentListContainer" class="btn btn-kt mt-3" id="saveContent">
                                            <i class="fa-solid fa-check"></i> Save
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="email_notifications" role="tabpanel">
                        <div class="card">
                            <div id="emailList">
                                <div class="card-header brown-border-top">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h5 class="card-title mb-0">Email Notifications
                                                <i class="fa-solid fa-envelope align-middle"></i>
                                            </h5>
                                        </div>

                                        <div class="col-auto">
                                            <button id="composeButton" class="btn btn-sta">
                                                <i class="fa-solid fa-pen"></i> Compose
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover datatable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Subject</th>
                                                    <th class="text-center">From</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center fw-bold">Privacy Policy Update</td>
                                                    <td class="text-center">Faye Macs</td>
                                                    <td class="text-center">May 23, 2025</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                            data-bs-target="#viewEmail">
                                                            <i class="fa fa-eye text-white"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash text-white"></i>
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="viewEmail" tabindex="-1"
                                                        aria-labelledby="viewEmailLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header brown-border-top">
                                                                    <h5 class="modal-title" id="viewEmailLabel">Content
                                                                        Details</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>
                                                                        <strong>Subject:</strong>
                                                                        <span id="modalSubject">
                                                                            Privacy Policy Update
                                                                        </span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <strong>Body:</strong>
                                                                    </p>
                                                                    <p id="modalBody">This is the body.</p>
                                                                    <p class="text-muted mt-5 mb-0 small">
                                                                        <strong>From:</strong>
                                                                        <span id="modalAuthor">Faye Macs</span>
                                                                        |
                                                                        <strong>Date:</strong>
                                                                        <span id="modalDate">May 23, 2023</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="writeEmail" class="d-none">
                                <div class="card-header brown-border-top">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h5 class="card-title mb-0">Email Notifications
                                                <i class="fa-solid fa-envelope align-middle"></i>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex mb-3">
                                        <div class="col-sm-3 d-flex justify-content-start mt-1">
                                            Compose email...
                                        </div>
                                    </div>
                                    <input type="text" class="form-control form-control-lg mb-3"
                                        placeholder="Subject">
                                    <textarea class="editor"></textarea>
                                    <div class="d-flex justify-content-end">
                                        <a href="#emailList" class="btn btn-kt mt-3" id="saveEmail">
                                            <i class="fa-solid fa-check"></i> Save
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade mt-0" id="web_notifications" role="tabpanel">
                        <div class="card">
                            <div id="announcementList">
                                <div class="card-header brown-border-top">
                                    <div class="row d-flex justify-content-between align-items-center w-100">
                                        <div class="col-auto">
                                            <h5 class="card-title mb-0">
                                                Web Notifications
                                                <i class="fa-solid fa-bell fa-sm"></i>
                                            </h5>
                                        </div>
                                        <div class="col-md-8 d-flex justify-content-end align-items-center gap-2">
                                            <div class="position-relative w-50">
                                                <input type="text" id="announcementSearch"
                                                    class="form-control rounded-pill ps-5" placeholder="Search...">
                                                <span
                                                    class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>

                                            <a class="btn btn-sta" id="createAnnouncementBtn">
                                                <i class="fa-solid fa-plus"></i> Create Announcement
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="list-group">
                                        <div
                                            class="list-group-item list-group-item-action flex-column align-items-start mb-3 border rounded p-3 shadow-sm text-dark">
                                            <div class="d-flex w-100 justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1 fw-bold">System Maintenance Notice</h5>
                                                    <p class="mb-2 mt-2">
                                                        Please be advised that the system will be temporarily unavailable
                                                        from 10:00
                                                        PM to 12:00 AM due to scheduled maintenance...
                                                    </p>
                                                    <span class="text-small text-muted">May 18, 2025</span>
                                                </div>
                                                <div class="dropdown">
                                                    <a data-bs-toggle="dropdown" class="text-dark"><i
                                                            class="fas fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewAnnouncementModal">
                                                                View Announcement
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger delete-btn"
                                                                href="#">
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action flex-column align-items-start mb-3 border rounded p-3 shadow-sm text-dark">
                                            <div class="d-flex w-100 justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Tenant Portal Maintenance & Feature Updates
                                                    </h5>
                                                    <p class="mb-2 mt-2">
                                                        Please be advised that the Tenant Management System (TMS) will
                                                        undergo scheduled maintenance on...
                                                    </p>
                                                    <span class="text-small text-muted">May 18, 2025</span>
                                                </div>
                                                <div class="dropdown">
                                                    <a data-bs-toggle="dropdown" class="text-dark"><i
                                                            class="fas fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewAnnouncementModal">
                                                                View Announcement
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger delete-btn"
                                                                href="#">
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action flex-column align-items-start mb-3 border rounded p-3 shadow-sm text-dark">
                                            <div class="d-flex w-100 justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Waste Collection Schedule</h5>
                                                    <p class="mb-2 mt-2">
                                                        Reminder: Waste collection will be every Tuesday and Friday starting
                                                        next
                                                        week. Please segregate biodegradable and non-biodegradable...
                                                    </p>
                                                    <span class="text-small text-muted">May 20, 2025</span>
                                                </div>
                                                <div class="dropdown">
                                                    <a data-bs-toggle="dropdown" class="text-dark"><i
                                                            class="fas fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewAnnouncementModal">
                                                                View Announcement
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger delete-btn"
                                                                href="#">
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action flex-column align-items-start mb-3 border rounded p-3 shadow-sm text-dark">
                                            <div class="d-flex w-100 justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Waste Collection Schedule</h5>
                                                    <p class="mb-2 mt-2">
                                                        Reminder: Waste collection will be every Tuesday and Friday starting
                                                        next
                                                        week. Please segregate biodegradable and non-biodegradable...
                                                    </p>
                                                    <span class="text-small text-muted">May 20, 2025</span>
                                                </div>
                                                <div class="dropdown">
                                                    <a data-bs-toggle="dropdown" class="text-dark"><i
                                                            class="fas fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewAnnouncementModal">
                                                                View Announcement
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger delete-btn"
                                                                href="#">
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer fixed-footer"></div>
                            </div>

                            <div id="createAnnouncement" class="d-none">
                                <div class="card-header brown-border-top">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h5 class="card-title mb-0">Create Announcement
                                                <i class="fa-solid fa-envelope align-middle"></i>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="form-control form-control-lg mb-3" placeholder="Title"
                                        id="announcementTitle">
                                    <textarea class="editor"></textarea>
                                    <div class="d-flex justify-content-end">
                                        <a href="#emailList" class="btn btn-kt mt-3" id="saveEmail">
                                            <i class="fa-solid fa-check"></i> Save
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="viewAnnouncementModal" tabindex="-1"
                            aria-labelledby="viewAnnouncementModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="viewAnnouncementModalLabel">Announcement Title
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="viewAnnouncementBody" class="mb-3"></p>
                                        <p class="text-muted small mb-0" id="viewAnnouncementDate"></p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const viewButtons = document.querySelectorAll(
                                    ".dropdown-item[data-bs-target='#viewAnnouncementModal']");

                                viewButtons.forEach(button => {
                                    button.addEventListener("click", function() {
                                        const item = this.closest(".list-group-item");
                                        const title = item.querySelector("h5")?.textContent.trim();
                                        const body = item.querySelector("p")?.textContent.trim();
                                        const date = item.querySelector("span.text-muted")?.textContent.trim();

                                        // Inject into modal
                                        document.getElementById("viewAnnouncementModalLabel").textContent = title;
                                        document.getElementById("viewAnnouncementBody").textContent = body;
                                        document.getElementById("viewAnnouncementDate").textContent = date;
                                    });
                                });
                            });
                        </script>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const subtleColors = [
                                    "rgba(255, 193, 7, 0.15)", // light yellow
                                    "rgba(23, 162, 184, 0.15)", // light cyan
                                    "rgba(220, 53, 69, 0.15)", // light red
                                    "rgba(0, 123, 255, 0.15)", // light blue
                                    "rgba(40, 167, 69, 0.15)", // light green
                                    "rgba(108, 117, 125, 0.15)" // light gray
                                ];

                                // Select only items inside #web_notifications
                                const container = document.getElementById("web_notifications");
                                if (!container) return; // Safety check

                                const items = container.querySelectorAll(".list-group-item");

                                items.forEach((item, i) => {
                                    item.style.backgroundColor = subtleColors[i % subtleColors.length];
                                    item.classList.remove('text-white');
                                    item.classList.add('text-dark');
                                });

                                // Search filter
                                const searchInput = document.getElementById("announcementSearch");
                                searchInput.addEventListener("input", () => {
                                    const query = searchInput.value.toLowerCase();

                                    items.forEach((item) => {
                                        const title = item.querySelector("h5").textContent.toLowerCase();
                                        const body = item.querySelector("p").textContent.toLowerCase();

                                        // Show item if query matches title or body
                                        if (title.includes(query) || body.includes(query)) {
                                            item.style.display = "";
                                        } else {
                                            item.style.display = "none";
                                        }
                                    });
                                });
                            });
                        </script>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const viewButtons = document.querySelectorAll(
                                    ".dropdown-item[data-bs-target='#viewAnnouncementModal']"
                                );

                                viewButtons.forEach(button => {
                                    button.addEventListener("click", function() {
                                        const item = this.closest(".list-group-item");
                                        const title = item.querySelector("h5")?.textContent.trim();
                                        const body = item.querySelector("p")?.textContent.trim();
                                        const date = item.querySelector("span.text-muted")?.textContent.trim();

                                        // Inject into modal
                                        document.getElementById("viewAnnouncementModalLabel").textContent = title;
                                        document.getElementById("viewAnnouncementBody").textContent = body;
                                        document.getElementById("viewAnnouncementDate").textContent = date;

                                        // Match modal header background to the item's color
                                        const itemColor = window.getComputedStyle(item).backgroundColor;

                                        const header = document.querySelector("#viewAnnouncementModal .modal-header");
                                        const colorMap = {
                                            "rgba(255, 193, 7, 0.15)": "#fef6df",
                                            "rgba(23, 162, 184, 0.15)": "#cadee0",
                                            "rgba(220, 53, 69, 0.15)": "#f1dddf",
                                            "rgba(0, 123, 255, 0.15)": "#d7e8fa",
                                            "rgba(40, 167, 69, 0.15)": "#d7f2de",
                                            "rgba(108, 117, 125, 0.15)": "#dcdfe2"
                                        };

                                        header.style.backgroundColor = colorMap[itemColor] || "#f8f9fa"; // fallback
                                        // header.style.color = "white"; // optional, for contrast
                                    });
                                });
                            });
                        </script>
                    </div>

                    <div class="tab-pane fade" id="your_data" role="tabpanel">
                        <div class="card">
                            <div id="contentListContainer">
                                <div class="card-header brown-border-top">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h5 class="card-title mb-0">
                                                List of All Modules
                                                <i class="fa-solid fa-folder-open fa-sm"></i>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover datatable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Role</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Faye Macs</td>
                                                    <td class="text-center">Admin</td>
                                                    <td class="text-center"><span
                                                            class="badge badge-success">Active</span></td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">

                                                            <a class="btn btn-sm btn-warning" title="View"
                                                                data-bs-toggle="modal" data-bs-target="#viewAccountModal">
                                                                <i class="fa fa-pen text-white"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-secondary disable-btn"
                                                                data-bs-toggle="tooltip" title="Disable">
                                                                <i class="fa-solid fa-user-slash text-white"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger delete-btn"
                                                                data-bs-toggle="tooltip" title="Delete">
                                                                <i class="fa fa-trash text-white"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Lizzy Olsen</td>
                                                    <td class="text-center">Admin</td>
                                                    <td class="text-center"><span
                                                            class="badge badge-success">Active</span></td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">

                                                            <a class="btn btn-sm btn-warning" title="View"
                                                                data-bs-toggle="modal" data-bs-target="#viewAccountModal">
                                                                <i class="fa fa-pen text-white"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-secondary disable-btn"
                                                                data-bs-toggle="tooltip" title="Disable">
                                                                <i class="fa-solid fa-user-slash text-white"></i>
                                                            </a>

                                                            <a class="btn btn-sm btn-danger delete-btn"
                                                                data-bs-toggle="tooltip" title="Delete">
                                                                <i class="fa fa-trash text-white"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="modal fade" id="viewAccountModal" tabindex="-1"
                                            aria-labelledby="viewAccountModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header brown-border-top">
                                                        <h5 class="modal-title" id="viewAccountModalLabel">Account Details
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <form class="px-3 mt-2">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="account_name">Account Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="account_name">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="user_email">Email</label>
                                                                        <input type="email" class="form-control"
                                                                            id="user_email">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="role">Role</label>
                                                                        <input type="text" class="form-control"
                                                                            id="role">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone">Phone #</label>
                                                                        <input type="number" class="form-control"
                                                                            id="phone">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="date_registered">Date
                                                                            Registered</label>
                                                                        <input type="date" class="form-control"
                                                                            id="date_registered">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="commencement_date">Commencement</label>
                                                                        <input type="date" class="form-control"
                                                                            id="commencement_date">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="end_of_contract">End of
                                                                            Contract</label>
                                                                        <input type="date" class="form-control"
                                                                            id="end_of_contract">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="contract_status">Contract
                                                                            Status</label>
                                                                        <input type="text" class="form-control"
                                                                            id="contract_status">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="form-group p-0">
                                                            <button id="accountDetailsSaveBtn" class="btn btn-sta">
                                                                <i class="fa-solid fa-check"></i> Save Changes
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
                    </div>

                    <div class="tab-pane fade" id="delete_accounts" role="tabpanel">
                        <div class="card">
                            <div id="contentListContainer">
                                <div class="card-header brown-border-top">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h5 class="card-title mb-0">
                                                List of All Accounts
                                                <i class="fa-solid fa-users fa-sm"></i>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover datatable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Role</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Faye Macs</td>
                                                    <td class="text-center">Admin</td>
                                                    <td class="text-center"><span
                                                            class="badge badge-success">Active</span></td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">

                                                            <a class="btn btn-sm btn-warning" title="View"
                                                                data-bs-toggle="modal" data-bs-target="#viewAccountModal">
                                                                <i class="fa fa-pen text-white"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-secondary disable-btn"
                                                                data-bs-toggle="tooltip" title="Disable">
                                                                <i class="fa-solid fa-user-slash text-white"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger delete-btn"
                                                                data-bs-toggle="tooltip" title="Delete">
                                                                <i class="fa fa-trash text-white"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Lizzy Olsen</td>
                                                    <td class="text-center">Admin</td>
                                                    <td class="text-center"><span
                                                            class="badge badge-success">Active</span></td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">

                                                            <a class="btn btn-sm btn-warning" title="View"
                                                                data-bs-toggle="modal" data-bs-target="#viewAccountModal">
                                                                <i class="fa fa-pen text-white"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-secondary disable-btn"
                                                                data-bs-toggle="tooltip" title="Disable">
                                                                <i class="fa-solid fa-user-slash text-white"></i>
                                                            </a>

                                                            <a class="btn btn-sm btn-danger delete-btn"
                                                                data-bs-toggle="tooltip" title="Delete">
                                                                <i class="fa fa-trash text-white"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="modal fade" id="viewAccountModal" tabindex="-1"
                                            aria-labelledby="viewAccountModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header brown-border-top">
                                                        <h5 class="modal-title" id="viewAccountModalLabel">Account Details
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <form class="px-3 mt-2">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="account_name">Account Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="account_name">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="user_email">Email</label>
                                                                        <input type="email" class="form-control"
                                                                            id="user_email">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="role">Role</label>
                                                                        <input type="text" class="form-control"
                                                                            id="role">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone">Phone #</label>
                                                                        <input type="number" class="form-control"
                                                                            id="phone">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="date_registered">Date
                                                                            Registered</label>
                                                                        <input type="date" class="form-control"
                                                                            id="date_registered">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="commencement_date">Commencement</label>
                                                                        <input type="date" class="form-control"
                                                                            id="commencement_date">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="end_of_contract">End of
                                                                            Contract</label>
                                                                        <input type="date" class="form-control"
                                                                            id="end_of_contract">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="contract_status">Contract
                                                                            Status</label>
                                                                        <input type="text" class="form-control"
                                                                            id="contract_status">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="form-group p-0">
                                                            <button id="accountDetailsSaveBtn" class="btn btn-sta">
                                                                <i class="fa-solid fa-check"></i> Save Changes
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
