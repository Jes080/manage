<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('pictures/logo.png') }}"
                 class="block fill-current text-gray-800 dark:text-gray-200"
                 alt="Logo"
                 width="150" height="150">
        </a>

        <!-- Navbar Toggler -->
        <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>-->

        <!-- Navigation Links -->
        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">-->

        <!-- Navigation Links -->
        <div class="navbar-nav mx-3">
            <div class="row">
                <div class="col">
                    <ul class="nav nav-underline mx-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="nav nav-underline mx-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('taskfunc') ? 'active' : '' }}" href="{{ route('taskfunc') }}">{{ __('Task') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Settings Dropdown -->
        <!-- Auth Links -->
        <div class="navbar-nav ms-auto">
            @guest
                <!-- Login Link -->
                <a class="btn btn-primary me-2" href="{{ route('login') }}">{{ __('Login') }}</a>

                <!-- Register Link -->
                <a class="btn btn-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endguest

            @auth
                <!-- User Dropdown Menu -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <!-- Profile Link -->
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>

                        <!-- Logout Form -->
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" id="logoutButton">{{ __('Log Out') }}</button>
                            </form>
                        </li>

                        <!-- Toast Notification -->
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">Success</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    You have successfully logged out.
                                </div>
                            </div>
                        </div>

                    </ul>
                </div>
            @endauth
        </div>
    </div>
    <script>
        const logoutButton = document.getElementById('logoutButton');
        const toastLiveExample = document.getElementById('liveToast');

        if (logoutButton) {
            logoutButton.addEventListener('click', () => {
                const toastBootstrap = new bootstrap.Toast(toastLiveExample);
                toastBootstrap.show();

                // Hide the toast after 2 seconds
                setTimeout(() => {
                    toastBootstrap.hide();
                }, 2000);
            });
        }
    </script>

</nav>
