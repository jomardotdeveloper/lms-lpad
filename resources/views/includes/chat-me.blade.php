<div class="chat is-me">
    <div class="chat-content">
        <div class="chat-bubbles">
            <div class="chat-bubble">
                <div class="chat-msg"> {{ $chat->message }} </div>
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
            <li>{{ $chat->user->contact->full_name }}</li>
            <li>{{ $chat->user->created_at }}</li>
        </ul>
    </div>
</div>
