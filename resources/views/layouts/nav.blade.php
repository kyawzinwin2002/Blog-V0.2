<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route("page.home") }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                <li class="nav-item ">
                    <a  class="nav-link " href="{{route("users.profile")}}" role="button">
                        <img src="@if (!is_null(Auth::user()->photo))
                        {{asset('storage/' . Auth::user()->photo)}}
                        @else
                        {{asset("storage/photos/profile.jpg")}}
                        @endif" class="rounded-5" width="30" alt="">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li class=" nav-item">
                    <a href="{{route("page.dashboard")}}" class=" text-bold nav-link">Dashboard</a>
                </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
