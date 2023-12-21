@foreach ($conversations as $conversation)
<li class="chat-item is-unread">
    <a class="chat-link chat-open" href="javascript:void(0);" onclick="loadConvo('{{ $conversation->id }}')">
        <div class="chat-media user-avatar bg-purple">
            @if ($conversation->user_not_equal->contact->profile_picture)
                <img src="{{ $conversation->user_not_equal->contact->profile_picture }}" alt="{{ $conversation->user_not_equal->contact->full_name }}">
            @else
                <span>{{ strtoupper($conversation->user_not_equal->contact->two_letters) }}</span>
            @endif
            {{-- <span>JR</span> --}}
        </div>
        <div class="chat-info">
            <div class="chat-from">
                <div class="name">
                    {{ $conversation->user_not_equal->contact->full_name }}
                </div>
                {{-- <span class="time">4:12 PM</span> --}}
            </div>
            <div class="chat-context">
                <div class="text">
                    <p>{{ $conversation->last_message  }}</p>
                </div>
            </div>
        </div>
    </a>
    <div class="chat-actions">
        <div class="dropdown">
            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
            <div class="dropdown-menu dropdown-menu-end">
                <ul class="link-list-opt no-bdr">
                    <li><a href="#">Mark as Unread</a></li>
                    <li><a href="#">Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
</li>
<script>
    function loadConvo(id) {
        window.location.href = "{{ route('messages.index') }}?conversation_id=" + id + "&special=1";
    }
</script>
@endforeach
