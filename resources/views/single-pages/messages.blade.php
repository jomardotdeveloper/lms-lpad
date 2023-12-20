@extends('layouts.master')
@section('title', 'Admin Dashboard')

@section('special-content')
<div class="mt-5"></div>
<div class="mt-5"></div>
<div class="mt-5"></div>
<div class="alert alert-fill alert-warning alert-dismissible alert-icon">
    <em class="icon ni ni-cross-circle"></em> <strong>Warning</strong>!
    This feature was disabled for some issues.
    <button class="close" data-bs-dismiss="alert"></button>
</div>
{{-- <div class="nk-wrap ">
    <div class="nk-header nk-header-fixed is-light"></div>
    <div class="nk-content p-0">
        <div class="nk-content-inner">
            <div class="nk-content-body">
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
                                    <a href="#" class="btn btn-round btn-icon btn-light">
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
                                    @include('includes.chat-item')
                                </ul>
                            </div>
                        </div>
                    </div>
                    @include('includes.current-conversation')
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
