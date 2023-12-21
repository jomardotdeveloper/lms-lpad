<div class="nk-chat-body profile-shown">
    <div class="nk-chat-head">
        <ul class="nk-chat-head-info">
            <li class="nk-chat-head-user">
                <div class="user-card">
                    <div class="user-avatar bg-purple">
                        @if ($conversation->user_not_equal->contact->profile_picture)
                            <img src="{{ $conversation->user_not_equal->contact->profile_picture }}" alt="{{ $conversation->user_not_equal->contact->full_name }}">

                        @else
                            <span>{{ strtoupper($conversation->user_not_equal->contact->two_letters) }}</span>
                        @endif
                        {{-- <span>IH</span> --}}
                    </div>
                    <div class="user-info">
                        <div class="lead-text">{{ $conversation->user_not_equal->contact->full_name }}</div>
                        <div class="sub-text"><span class="d-none d-sm-inline me-1">
                            @if ($conversation->user_not_equal->contact->is_student)
                                Student
                            @elseif ($conversation->user_not_equal->contact->is_teacher)
                                Teacher
                            @elseif ($conversation->user_not_equal->contact->is_admin)
                                Admin
                            @endif
                        </span> </div>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="nk-chat-head-tools">
            <li class="me-n1 me-md-n2"><a href="#" class="btn btn-icon btn-trigger chat-profile-toggle" style="color:#fe0000 !important;"><em class="icon ni ni-alert-circle-fill"></em></a></li>
        </ul>
    </div>
    <div class="nk-chat-panel" data-simplebar>
        <div class="chat is-me d-none" id="hiddenChat">
            <div class="chat-content">
                <div class="chat-bubbles">
                    <div class="chat-bubble">
                        <div class="chat-msg">s  </div>
                        <ul class="chat-msg-more">
                            <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-sm btn-trigger"><em class="icon ni ni-reply-fill"></em></a></li>
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-sm">
                                        <ul class="link-list-opt no-bdr">
                                            <li class="d-sm-none"><a href="#"><em class="icon ni ni-reply-fill"></em> Reply</a></li>
                                            <li><a href="#"><em class="icon ni ni-pen-alt-fill"></em> Edit</a></li>
                                            <li><a href="#"><em class="icon ni ni-trash-fill"></em> Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="chat-meta">

                </ul>
            </div>
        </div>

        @foreach ($conversation->chats as $chat)

            @if ($chat->user_id == auth()->user()->id)
                @include('includes.chat-me' , ['chat' => $chat])
            @else
                @include('includes.chat-you' , ['chat' => $chat])
            @endif
        @endforeach
        {{-- @include('includes.chat-me')
        @include('includes.chat-you')
        @include('includes.chat-you')
        @include('includes.chat-you') --}}
    </div>
    <div class="nk-chat-editor">
        <div class="nk-chat-editor-form">
            <div class="form-control-wrap">
                <textarea class="form-control form-control-simple no-resize" rows="1" id="default-textarea" placeholder="Type your message..."></textarea>
            </div>
        </div>
        <ul class="nk-chat-editor-tools g-2">
            <li>
                <button class="btn btn-round btn-primary btn-icon" onclick="btnSend()"><em class="icon ni ni-send-alt"></em></button>
            </li>
        </ul>
    </div>
    {{-- @include('includes.current-conversation-view-profile') --}}
</div>
