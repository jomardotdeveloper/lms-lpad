<li class="dropdown notification-dropdown">
    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
        <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
    </a>
    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
        <div class="dropdown-head">
            <span class="sub-title nk-dropdown-title">Notifications</span>
        </div>
        <div class="dropdown-body">
            <div class="nk-notification">
                @foreach ($notifications as $notification)
                <div class="nk-notification-item dropdown-inner">
                    <div class="nk-notification-icon">
                        <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                    </div>
                    <div class="nk-notification-content">
                        <div class="nk-notification-text">{{ $notification->name  }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</li>
