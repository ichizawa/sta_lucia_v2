@extends('layouts')

@section('content')
    <div class="container-fluid">
        <div class="row vh-100">
            <!-- Sidebar -->
            <div class="col-md-2 bg-white border-end p-3 d-flex flex-column">
                <a href="#" class="btn btn-danger w-100 mb-4" data-bs-toggle="modal"
                    data-bs-target="#composeEmailModal">Write a message</a>
                <ul class="nav flex-column mb-4">
                    <li class="nav-item"><a class="nav-link active" href="#"><i class="fa-solid fa-inbox"></i> Inbox
                            <span class="badge bg-primary float-end">4</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-star"></i> Starred</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-envelope"></i> Drafts</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#"><i
                                class="fa-solid fa-envelope-circle-check"></i> Sent</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-trash-can"></i> Trash</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-newspaper"></i>
                            Newsletters</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-receipt"></i> Invoices</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-folder-open"></i> Work</a>
                    </li>
                </ul>
                <hr>
                <!-- Contacts -->
                <h4 class="text-muted">Chat</h4>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-2" id="chat-contact">
                        John Hill <span class="ms-auto" id="online-indicator"><i class="fas fa-circle"></i></span>
                    </li>
                    <li class="d-flex align-items-center mb-2" id="chat-contact">
                        Michael Johnson <span class="ms-auto" id="online-indicator"><i class="fas fa-circle"></i></span>
                    </li>
                    <li class="d-flex align-items-center mb-2" id="chat-contact">
                        Johnny Walker <span class="ms-auto" id="online-indicator"><i class="fas fa-circle"></i></span>
                    </li>
                    <li class="d-flex align-items-center mb-2" id="chat-contact">
                        Jack Daniel <span class="ms-auto" id="offline-indicator"><i class="fas fa-circle"></i></span>
                    </li>
                    <li class="d-flex align-items-center mb-2" id="chat-contact">
                        Jose Cuervo <span class="ms-auto" id="offline-indicator"><i class="fas fa-circle"></i></span>
                    </li>
                    <!-- Add more contacts -->
                </ul>
            </div>

            <!-- Inbox List -->
            <div class="col-md-5 border-end p-0 d-flex flex-column">
                <div class="border-bottom p-3 d-flex justify-content-between">
                    <input type="text" class="form-control w-75" placeholder="Search email...">
                    <span class="text-muted">Recent ⌄</span>
                </div>
                <div class="overflow-auto" style="flex-grow: 1;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex">
                            <div class="me-3">
                                <input type="checkbox">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <strong>Mark Zuckerberg</strong>
                                    <small>12:25</small>
                                </div>
                                <div class="text-muted">New design for MESSENGER</div>
                                <small class="text-muted d-block text-truncate">Hi there :) I'm creating a messenger for new
                                    OS…</small>
                            </div>
                            <div class="ms-2 text-warning">⭐</div>
                        </li>
                        <!-- Repeat this <li> for each message -->
                        <li class="list-group-item d-flex">
                            <div class="me-3">
                                <input type="checkbox">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <strong>Mark Zuckerberg</strong>
                                    <small>12:25</small>
                                </div>
                                <div class="text-muted">New design for MESSENGER</div>
                                <small class="text-muted d-block text-truncate">Hi there :) I'm creating a messenger for new
                                    OS…</small>
                            </div>
                            <div class="ms-2 text-warning"><i class="fa-regular fa-star"></i></div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="me-3">
                                <input type="checkbox">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <strong>Bill Gates</strong>
                                    <small>12:25</small>
                                </div>
                                <div class="text-muted">New design for MESSENGER</div>
                                <small class="text-muted d-block text-truncate">Hi there :) I'm creating a messenger for
                                    new
                                    OS…</small>
                            </div>
                            <div class="ms-2 text-warning"><i class="fa-regular fa-star"></i></div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="me-3">
                                <input type="checkbox">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <strong>Ellon Musk</strong>
                                    <small>12:25</small>
                                </div>
                                <div class="text-muted">New design for MESSENGER</div>
                                <small class="text-muted d-block text-truncate">Hi there :) I'm creating a messenger for
                                    new
                                    OS…</small>
                            </div>
                            <div class="ms-2 text-warning"><i class="fa-regular fa-star"></i></div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Message View -->
            <div class="col-md-5 bg-white d-flex flex-column">
                <div class="p-3 border-bottom">
                    <h6>From <span class="text-primary">Mark Zuckerberg</span> to Me</h6>
                    <strong class="d-block">New design for MESSENGER</strong>
                    <small class="text-muted">2.03.2019 12:25</small>
                </div>
                <div class="flex-grow-1 overflow-auto p-3">
                    <p>Hey Mirek,</p>
                    <p>
                        Sed velit dignissim sodales ut. Ornare arcu odio ut sem nulla. Nibh sit amet commodo nulla facilisi
                        nullam vehicula ipsum.
                        Enim ut sem viverra aliquet eget sit. Diam quis enim lobortis scelerisque fermentum dui faucibus in
                        ornare.
                    </p>
                    <p>
                        Diam quis enim lobortis scelerisque fermentum dui faucibus. Porttitor rhoncus dolor purus non enim
                        praesent elementum facilisis.
                    </p>
                    <p>Have a nice day 😊</p>
                    <p>Mark Zuckerberg</p>
                </div>
                <div class="p-3 border-top">
                    <form class="d-flex">
                        <button class="btn btn-outline-primary">Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- compose email modal --}}
    <div div class="modal fade" id="composeEmailModal" tabindex="-1" aria-labelledby="composeEmailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <div class="container mt-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">✉️ Compose New Email</h5>
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

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success">Send</button>
                                        <button type="reset" class="btn btn-outline-secondary">Discard</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        var quill = new Quill('#quillEditor', {
            theme: 'snow',
            placeholder: 'Type your message here...',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, 3, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'blockquote', 'code-block'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                    ['clean']
                ]
            }
        });

        // Sync content to hidden input on form submit
        document.querySelector("#viewAnnouncementModal form")?.addEventListener("submit", function() {
            document.querySelector("#message").value = quill.root.innerHTML;
        });
    </script>
@endsection
