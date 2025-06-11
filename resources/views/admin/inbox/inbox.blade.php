@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Email/Chat Inbox</h3>
                <h6 class="op-7 mb-2">Tenant Management System</h6>
            </div>
        </div>

        <div class="row vh-100">
            <!-- Sidebar -->
            <div class="col-md-2 bg-white border-end p-3 d-flex flex-column">
                <a href="#" class="btn w-100 mb-4" id="composeEmail" data-bs-toggle="modal"
                    data-bs-target="#composeEmailModal">
                    Compose an Email
                </a>

                <!-- Nav Tabs -->
                <ul class="nav flex-column nav-pills mb-4" id="inbox-menu" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link w-100 text-start" href="#emailChatInbox" data-bs-toggle="tab" role="tab"
                            aria-controls="emailChatInbox" aria-selected="true">
                            <i class="fa-solid fa-inbox me-2"></i> Inbox
                            <span class="badge float-end" id="inbox-badge">4</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link w-100 text-start" href="#starred" data-bs-toggle="tab"
                            role="tab" aria-controls="starred" aria-selected="true"><i
                                class="fa-solid fa-star me-2"></i> Starred</a></li>
                    <li class="nav-item"><a class="nav-link w-100 text-start" href="#drafts" data-bs-toggle="tab"
                            role="tab" aria-controls="drafts" aria-selected="true"><i
                                class="fa-solid fa-envelope me-2"></i> Drafts</a></li>
                    <li class="nav-item"><a class="nav-link w-100 text-start" href="#sent" data-bs-toggle="tab"
                            role="tab" aria-controls="sent" aria-selected="true"><i
                                class="fa-solid fa-envelope-circle-check me-2"></i> Sent</a></li>
                    <li class="nav-item"><a class="nav-link w-100 text-start" href="#trash" data-bs-toggle="tab"
                            role="tab" aria-controls="starred" aria-selected="true"><i
                                class="fa-solid fa-trash-can me-2"></i> Trash</a></li>
                    <li class="nav-item"><a class="nav-link w-100 text-start" href="#"><i
                                class="fa-solid fa-newspaper me-2"></i> Newsletters</a></li>
                    <li class="nav-item"><a class="nav-link w-100 text-start" href="#"><i
                                class="fa-solid fa-receipt me-2"></i> Invoices</a></li>
                    <li class="nav-item"><a class="nav-link w-100 text-start" href="#"><i
                                class="fa-solid fa-folder-open me-2"></i> Work</a></li>
                </ul>


                <hr>
                <!-- Contacts -->
                <h4 class="text-muted">Chat</h4>
                <ul class="list-unstyled">
                    @foreach (['John Hill', 'Michael Johnson', 'Johnny Walker', 'Jack Daniel', 'Jose Cuervo'] as $i => $contact)
                        <li class="d-flex align-items-center mb-2" id="chat-contact" data-bs-toggle="modal"
                            data-bs-target="#chatBoxModal">
                            {{ $contact }}
                            <span class="ms-auto" id="{{ $i % 2 === 0 ? 'online-indicator' : 'offline-indicator' }}"></span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-10 tab-content">
                <div class="tab-pane fade show active" id="emailChatInbox" role="tabpanel">
                    @include('admin.inbox.email-chat-inbox')
                </div>
                <div class="tab-pane fade" id="starred" role="tabpanel">
                    @include('admin.inbox.starred')
                </div>
                <div class="tab-pane fade" id="drafts" role="tabpanel">
                    @include('admin.inbox.drafts')
                </div>
                <div class="tab-pane fade" id="sent" role="tabpanel">
                    @include('admin.inbox.sent')
                </div>
                <div class="tab-pane fade" id="trash" role="tabpanel">
                    @include('admin.inbox.trash')
                </div>
            </div>
        </div>
    </div>

    @include('admin.components.modals.compose-email-modal')
    @include('admin.components.modals.chat-box-modal')

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

        document.querySelector("#viewAnnouncementModal form")?.addEventListener("submit", function() {
            document.querySelector("#message").value = quill.root.innerHTML;
        });
    </script>
@endsection
