<div div class="modal fade" id="composeEmailModal" tabindex="-1" aria-labelledby="composeEmailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="container mt-4">
                <div>
                    <div class="card-header text-black">
                        <h5 class="mb-0">✉️ Compose New Email</h5>
                    </div>
                    <div class="text-end">
                        <div class="btn-group">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="form-select"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Select Theme
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" id="selectTheme" aria-labelledby="form-select">
                                <li><a class="dropdown-item" href="#">Theme 1</a></li>
                                <li><a class="dropdown-item" href="#">Theme 2</a></li>
                                <li><a class="dropdown-item" href="#">Theme 3</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="to" class="form-label">To</label>
                                <input type="email" name="to" class="form-control"
                                    placeholder="recipient@example.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="cc" class="form-label">CC</label>
                                <input type="email" name="cc" class="form-control"
                                    placeholder="optional@example.com">
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control"
                                    placeholder="Subject of your email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <div id="quillEditor" style="height: 200px;"></div>
                                <input type="hidden" name="message" id="message">
                            </div>

                            <div class="d-flex justify-content-between" id="composeEmailActions">
                                <button type="submit" class="btn" id="emailBtnSend">Send</button>
                                <button type="reset" class="btn btn-outline-danger">Discard</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
