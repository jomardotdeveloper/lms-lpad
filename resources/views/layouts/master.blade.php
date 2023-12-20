<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="{{ asset('logos/logo.png') }}">
    <title>
        SFAC - @yield('title')
    </title>
    @include('layouts.styles')
    @stack('styles')
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="#" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('logos/logo1.png') }}" srcset="{{ asset('logos/logo2x.png') }} 2x" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('logos/logo1.png') }}" srcset="{{ asset('logos/logo1.png') }} 2x" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="{{ asset('logos/logo.png') }}" srcset="{{ asset('logos/logo.png') }} 2x" alt="logo-small">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div>
                @include('layouts.menus')
            </div>
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('logos/logo1.png') }}" srcset="{{ asset('logos/logo12x.png') }} 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('logos/logo1.png') }}" srcset="{{ asset('logos/logo1.png') }} 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    @include('layouts.chats')
                                    @include('layouts.notifications')
                                    @include('layouts.profile-dropdown')
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!isset($_GET['special']))
                <div class="nk-content ">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @endif

                @yield('special-content')
                @include('layouts.footer')
            </div>
        </div>
    </div>
    @include('layouts.scripts')
    <script src="{{ asset('assets/js/apps/chats.js?ver=3.2.2') }}"></script>
    @stack('scripts')
    <script>
        function logout() {
            document.getElementById('logoutForm').submit();
        }
    </script>
</body>

</html>
