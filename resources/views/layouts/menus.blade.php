<div class="nk-sidebar-element">
    <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>
            <ul class="nk-menu">
                @if (auth()->user()->contact->is_admin)
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Main</h6>
                </li>
                {{-- <li class="nk-menu-item">
                    <a href="{{ route('dashboard') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                        <span class="nk-menu-text">Dashboard</span>
                    </a>
                </li> --}}
                <li class="nk-menu-item">
                    <a href="{{ route('school-years.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-pen-fill"></em></span>
                        <span class="nk-menu-text">School Years</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="{{ route('events.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-calendar-fill"></em></span>
                        <span class="nk-menu-text">Events</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="{{ route('messages.index') }}?special=1" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-chat-fill"></em></span>
                        <span class="nk-menu-text">Messages</span>
                    </a>
                </li>


                {{-- <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Curriculum</h6>
                </li>

                <li class="nk-menu-item">
                    <a href="{{ route('classrooms.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-book-fill"></em></span>
                        <span class="nk-menu-text">Classroom</span>
                    </a>
                </li> --}}

                {{-- <li class="nk-menu-item">
                    <a href="{{ route('sections.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-book-read"></em></span>
                        <span class="nk-menu-text">Classes</span>
                    </a>
                </li> --}}


                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Users</h6>
                </li>
                <li class="nk-menu-item">
                    <a href="{{ route('contacts.index') }}?is_teacher=1" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-user-fill"></em></span>
                        <span class="nk-menu-text">Teachers</span>
                    </a>
                </li>
                <li class="nk-menu-item active current-page">
                    <a href="{{ route('contacts.index') }}?is_student=1" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                        <span class="nk-menu-text">Students</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="{{ route('contacts.index') }}?is_admin=1" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-account-setting-fill"></em></span>
                        <span class="nk-menu-text">Admins</span>
                    </a>
                </li>


                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Logs</h6>
                </li>
                <li class="nk-menu-item">
                    <a href="{{ route('logs.admin') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-list-fill"></em></span>
                        <span class="nk-menu-text">Admin Activities</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="{{ route('logs.user') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-view-group-fill"></em></span>
                        <span class="nk-menu-text">User Login Activities</span>
                    </a>
                </li>
                @endif

                @if (!auth()->user()->contact->is_admin)
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Main</h6>
                </li>


                <li class="nk-menu-item">
                    <a href="{{ route('classrooms.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-book-fill"></em></span>
                        <span class="nk-menu-text">Classroom</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="{{ route('messages.index') }}?special=1" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-chat-fill"></em></span>
                        <span class="nk-menu-text">Messages</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="{{ route('events.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-calendar-fill"></em></span>
                        <span class="nk-menu-text">Events</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
