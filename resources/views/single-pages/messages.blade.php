@extends('layouts.master')
@section('title', 'Admin Dashboard')

@section('special-content')
{{-- <div class="mt-5"></div>
<div class="mt-5"></div>
<div class="mt-5"></div> --}}
{{-- <div class="alert alert-fill alert-danger alert-dismissible alert-icon">
    <em class="icon ni ni-cross-circle"></em> <strong>Terminated</strong>!
    Illuminate\Broadcasting\BroadcastException: Pusher error: The data content of this event exceeds the allowed maximum (10240 bytes).
    <button class="close" data-bs-dismiss="alert"></button>
</div> --}}

<div class="nk-wrap ">
    <div class="nk-header nk-header-fixed is-light"></div>

    <div class="nk-content p-0">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                @include('includes.alert-error')
                @include('includes.alert-success')
                <div class="nk-chat">
                    <div class="nk-chat-aside">
                        <div class="nk-chat-aside-head">
                            <div class="nk-chat-aside-user">
                                <div class="dropdown">
                                    <div class="user-avatar">
                                        @if (auth()->user()->contact->profile_picture)
                                            <img src="{{ auth()->user()->contact->profile_picture }}" alt="">
                                        @else
                                            <span>{{ auth()->user()->contact->two_letters }}</span>
                                        @endif
                                    </div>
                                    <div class="title">Chats</div>
                                </div>
                            </div>
                            <ul class="nk-chat-aside-tools g-2">
                                <li>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#chat" class="btn btn-round btn-icon btn-light">
                                        <em class="icon ni ni-edit-alt-fill"></em>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="nk-chat-aside-body" data-simplebar>
                            <div class="nk-chat-aside-search">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-search"></em>
                                        </div>
                                        <input type="text" class="form-control form-round" id="default-03" placeholder="Search by name">
                                    </div>
                                </div>
                            </div>
                            <div class="nk-chat-list">
                                <h6 class="title overline-title-alt">Messages</h6>
                                <ul class="chat-list">
                                    @include('includes.chat-item' , ['conversations' => auth()->user()->conversations])
                                </ul>
                            </div>
                        </div>
                    </div>
                    @php
                        $current = null;

                        if(isset($_GET['conversation_id'])) {
                            $current = \App\Models\Conversation::find($_GET['conversation_id']);
                        }
                    @endphp
                    @if ($current)
                        @include('includes.current-conversation' , ['conversation' => $current])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('single-pages.create-conversation-modal')
<div class="chat is-me d-none" id="copyIsMe">
    <div class="chat-content">
        <div class="chat-bubbles">
            <div class="chat-bubble">
                <div class="chat-msg"> MEssage here </div>
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
            <li>Full name</li>
            <li>Date</li>
        </ul>
    </div>
</div>


<div class="chat is-you d-none" id="copyIsYou">
    <div class="chat-avatar">
        <div class="user-avatar bg-purple">
            <span id="twoLetters"></span>
            {{-- <span>IH</span> --}}
        </div>
    </div>
    <div class="chat-content">
        <div class="chat-bubbles">
            <div class="chat-bubble">
                <div class="chat-msg"></div>
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
            <li>Full name</li>
            <li>Date</li>
        </ul>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
    const channel = pusher.subscribe('public');

    //Receive messages
    channel.bind('chat', function (data) {
        $('#default-textarea').val('');
        var copy = $('#copyIsYou').clone();
        copy.removeClass('d-none');
        copy.find('#twoLetters').html(data.two_letters);
        copy.find('.chat-msg').html(data.message);
        copy.find('.chat-meta li:first-child').html(data.name);
        copy.find('.chat-meta li:last-child').html(data.date);
        // ADD A
        // copy.append('.nk-chat-panel');
        // $('.nk-chat-panel')
        // Check if there are existing chats
        var chatPanel = $('.nk-chat-panel');
        var existingChats = chatPanel.find('.chat');
        var hiddenDiv = chatPanel.find('#hiddenChat');

        if (existingChats.length > 0) {
            // If there are existing chats, append the new message after the last chat
            var lastChat = existingChats.last();
            lastChat.after(copy);
        } else {
            // If there are no existing chats, append the new message as the first chat
            hiddenDiv.after(copy);
        }
    });



    function btnSend() {
        var message = $('#default-textarea').val();
        var conversation_id = "{{ $current ? $current->id : null }}";

        if(message.length > 0) {
            $.ajax({

                url: "{{ route('messages.storeChat') }}",
                method: "POST",
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: {
                    _token: "{{ csrf_token() }}",
                    message: message,
                    conversation_id: conversation_id
                },
                success: function(data) {
                    $('#default-textarea').val('');
                    var copy = $('#copyIsMe').clone();
                    copy.removeClass('d-none');
                    copy.find('.chat-msg').html(data.message);
                    copy.find('.chat-meta li:first-child').html(data.name);
                    copy.find('.chat-meta li:last-child').html(data.date);
                    // ADD A
                    // copy.append('.nk-chat-panel');
                    // $('.nk-chat-panel')
                    // Check if there are existing chats
                    var chatPanel = $('.nk-chat-panel');
                    var existingChats = chatPanel.find('.chat');
                    var hiddenDiv = chatPanel.find('#hiddenChat');

                    if (existingChats.length > 0) {
                        // If there are existing chats, append the new message after the last chat
                        var lastChat = existingChats.last();
                        lastChat.after(copy);
                    } else {
                        // If there are no existing chats, append the new message as the first chat
                        hiddenDiv.after(copy);
                    }

                }
            });
        } else {
            alert('Please enter a message');
        }
    }

</script>
@endpush
