<div class="nk-chat-body profile-shown">
    <div class="nk-chat-head">
        <ul class="nk-chat-head-info">
            <li class="nk-chat-head-user">
                <div class="user-card">
                    <div class="user-avatar bg-purple">
                        <span>IH</span>
                    </div>
                    <div class="user-info">
                        <div class="lead-text">Iliash Hossain</div>
                        <div class="sub-text"><span class="d-none d-sm-inline me-1">Student</span> </div>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="nk-chat-head-tools">
            <li class="me-n1 me-md-n2"><a href="#" class="btn btn-icon btn-trigger chat-profile-toggle" style="color:#fe0000 !important;"><em class="icon ni ni-alert-circle-fill"></em></a></li>
        </ul>
    </div>
    <div class="nk-chat-panel" data-simplebar>
        @include('includes.chat-me')
        @include('includes.chat-you')
        @include('includes.chat-you')
        @include('includes.chat-you')
    </div>
    <div class="nk-chat-editor">
        <div class="nk-chat-editor-form">
            <div class="form-control-wrap">
                <textarea class="form-control form-control-simple no-resize" rows="1" id="default-textarea" placeholder="Type your message..."></textarea>
            </div>
        </div>
        <ul class="nk-chat-editor-tools g-2">
            <li>
                <button class="btn btn-round btn-primary btn-icon"><em class="icon ni ni-send-alt"></em></button>
            </li>
        </ul>
    </div>
    @include('includes.current-conversation-view-profile')
</div>
