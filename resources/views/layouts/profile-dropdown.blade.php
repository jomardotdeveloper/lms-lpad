<li class="dropdown user-dropdown">
    <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
        <div class="user-toggle">
            <div class="user-avatar sm">
                <em class="icon ni ni-user-alt"></em>
            </div>
            <div class="user-info d-none d-xl-block">
                <div class="user-status user-status-active">
                    @if (auth()->user()->contact->is_admin)
                    Administator
                    @elseif (auth()->user()->contact->is_teacher)
                    Teacher
                    @elseif (auth()->user()->contact->is_student)
                    Student
                    @endif
                </div>
                <div class="user-name dropdown-indicator">
                    {{ auth()->user()->contact->full_name }}
                </div>
            </div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
            <div class="user-card">
                <div class="user-avatar">
                    @if (auth()->user()->contact->profile_picture)
                        <img src="{{ auth()->user()->contact->profile_picture }}" alt="{{ auth()->user()->contact->full_name }}">
                    @else
                        <span>{{ auth()->user()->contact->two_letters }}</span>
                    @endif
                </div>
                <div class="user-info">
                    <span class="lead-text">
                        {{ auth()->user()->contact->full_name }}
                    </span>
                    <span class="sub-text">
                        {{ auth()->user()->email }}
                    </span>
                </div>
            </div>
        </div>
        <div class="dropdown-inner">
            <ul class="link-list">
                {{-- <li><a href="html/lms/admin-profile.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                <li><a href="html/lms/admin-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a>
                </li>
                <li><a href="html/lms/admin-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a>
                </li>
                <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li> --}}
                <li><a href="javascript:void(0)" onclick="logout()"><em class="icon ni ni-signout"></em><span>Sign out</span></a>
                </li>
            </ul>
        </div>
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            {{-- <input type="hidden" name="logout" value="1"> --}}
        </form>
        {{-- <div class="dropdown-inner">
            <ul class="link-list">
                <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign out</span></a>
                </li>
            </ul>
        </div> --}}
    </div>
</li>
