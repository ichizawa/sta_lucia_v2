<div class="card">
    <div id="templateList">
        <div class="card-header brown-border-top d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Email Notifications <i class="fa-solid fa-envelope align-middle"></i></h5>
            <button id="createTemplateBtn" class="btn btn-sta">
                <i class="fa-solid fa-plus"></i> Create Template
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th class="text-center">Template Name</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Last Updated</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Registration Rejected</td>
                            <td class="text-center">Registration Status</td>
                            <td class="text-center">May 23, 2025</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#viewTemplateModal">
                                    <i class="fa fa-eye text-white"></i>
                                </button>
                                <button class="btn btn-sm btn-warning edit-template-btn">
                                    <i class="fa fa-edit text-white"></i>
                                </button>
                                <button class="btn btn-sm btn-danger delete-template-btn">
                                    <i class="fa fa-trash text-white"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="templateForm" class="d-none">
        <div class="card-header brown-border-top">
            <h5 class="card-title mb-0">New Template <i class="fa-solid fa-pen fa-sm"></i>
            </h5>
        </div>
        <div class="card-body">
            <form id="emailTemplateForm">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="templateName" class="form-label">Template Name</label>
                            <input type="text" id="templateName" class="form-control"
                                placeholder="Enter template name" required>
                        </div>
                    </div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Email Subject</label>
                            <input type="text" id="subject" class="form-control" placeholder="Enter email subject"
                                required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="bannerText" class="form-label">Banner Text <small
                                    class="text-muted">(optional)</small></label>
                            <input type="text" id="bannerText" class="form-control"
                                placeholder="Enter banner text (e.g., Approved, Rejected, etc.)">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="themeColorSelect" class="form-label">Theme Color</label>
                            <div class="d-flex align-items-center gap-2">
                                <select id="themeColorSelect" name="themeColor" class="form-select mt-1">
                                    <option value="#f44336" selected>Crimson Blaze</option>
                                    <option value="#2196f3">Sky Pulse</option>
                                    <option value="#4caf50">Emerald Rise</option>
                                    <option value="#ff9800">Amber Spark</option>
                                    <option value="#9c27b0">Royal Amethyst</option>
                                    <option value="#8F8258">Earthstone Gold</option>
                                    <option value="#17a2b8">Aqua Drift</option>
                                    <option value="#6c757d">Steel Shade</option>
                                </select>

                                <span id="colorSwatch"
                                    style="display: inline-block;
                                    width: 30px;
                                    height: 30px;
                                    border-radius: 4px;
                                    border: 1px solid #ccc;
                                    background-color: #f44336;
                                    margin-top: 3px;">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="emailBody" class="form-label">Email Body</label>
                    <textarea id="emailBody" class="form-control" rows="8" placeholder="Write default email body here."></textarea>
                </div>

                <div class="mb-5">
                    <label for="footerText" class="form-label">Footer Text</label>
                    <input type="text" id="footerText" class="form-control"
                        placeholder="e.g., © 2025 Sta. Lucia. All rights reserved.">
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <button type="button" id="cancelTemplateBtn" class="btn btn-secondary">Cancel</button>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-sta me-2"><i class="fa-solid fa-check"></i> Save
                            Template</button>
                        <button type="button" id="previewTemplateBtn" class="btn btn-warning">
                            <i class="fa fa-eye"></i> Preview
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="viewTemplateModal" tabindex="-1" aria-labelledby="viewTemplateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" style="background-color: rgba(255, 0, 0, 0);">
                <div class="d-flex justify-content-end p-2">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="templatePreviewContent" class="email_notif_container" style="--theme-color: #f44336;">
                        <div class="email_notif_header">
                            <img src="/assets/img/logo-no-background.png" alt="Logo" />
                            <h1 id="previewSubject">Subject Here</h1>
                        </div>

                        <div class="email_notif_banner">
                            <p id="previewBannerText">Banner Text Here</p>
                        </div>

                        <div class="email_notif_body" id="previewEmailBody">
                            <p>Body here.</p>
                        </div>

                        <hr>

                        <div class="email_notif_footer" id="previewFooterText">
                            <p>Footer text here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
