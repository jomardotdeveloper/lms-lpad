<div class="chat is-you">
    <div class="chat-avatar">
        <div class="user-avatar bg-purple">
            @if ($chat->user->contact->profile_picture)
                <img src="{{ $chat->user->contact->profile_picture }}" alt="{{ $chat->user->contact->full_name }}">
            @else
                <span>{{ strtoupper($chat->user->contact->two_letters) }}</span>


            @endif
            {{-- <span>IH</span> --}}
        </div>
    </div>
    <div class="chat-content">
        <div class="chat-bubbles">
            <div class="chat-bubble">
                <div class="chat-msg"> {{ $chat->message }} </div>
                <ul class="chat-msg-more">
                    <li>
                        <div class="dropdown">
                            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
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
