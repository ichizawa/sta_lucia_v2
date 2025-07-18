<div class="modal fade" id="chatBoxModal" tabindex="-1" aria-labelledby="chatBoxModalLabel" aria-hidden="true">
    <div class= "modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            @csrf
            <div class="modal-header px-1 text-white d-flex justify-content-between align-items-center" id="chatHeader">
                <h5 class="modal-title mb-0">💬 Chat with User</h5>
                <div>
                    <button type="button" class="btn btn-sm" id="minimizeChat">
                        <i class="fas fa-minus text-white fa-lg"></i>
                    </button>
                    <button type="button" class="btn btn-sm" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark text-white fa-lg"></i></button>
                </div>
            </div>
            <div class="collapse show" id="chatCollapse">
                <div class="modal-body" style="height: 400px; overflow-y: auto;" id="chatMessages">
                    {{-- Chat messages will be dynamically loaded here --}}
                    <div class="text-muted text-center">Start of conversation</div>

                </div>

                <div class="modal-footer bg-light">
                    <form id="chatForm" class="d-flex w-100">
                        <input type="hidden" name="user_id" id="chat_user_id" value="">

                        <input type="text" name="message" id="chat_message" class="form-control me-2"
                            placeholder="Type your message..." autocomplete="off" required>

                        <button type="submit" class="btn" id="chatBnSend">
                            <i class="fas fa-paper-plane"></i> Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const minimizeBtn = document.getElementById('minimizeChat');
            const chatCollapse = document.getElementById('chatCollapse');
            let isCollapsed = false;

            minimizeBtn.addEventListener('click', function() {
                const collapseInstance = bootstrap.Collapse.getOrCreateInstance(chatCollapse);

                if (isCollapsed) {
                    collapseInstance.show();
                    minimizeBtn.innerHTML = `<i class="fas fa-minus"></i>`;
                } else {
                    collapseInstance.hide();
                    minimizeBtn.innerHTML = `<i class="fas fa-plus"></i>`;
                }

                isCollapsed = !isCollapsed;
            });
        });
    </script>
@endpush
@push('scripts')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
@endpush
