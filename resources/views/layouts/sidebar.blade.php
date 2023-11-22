<div class=" my-4">
    {{-- Pages --}}
    <div class=" my-3">
        <h5>Pages</h5>
        <div class="list-group my-3">
            <a href="{{route("page.home")}}" class="  list-group-item list-group-item-action">Home </a>
            <a href="{{route("page.dashboard")}}" class="  list-group-item list-group-item-action">Dashboard </a>
        </div>
    </div>

    {{-- Users  --}}

    @can('viewAny', App\Models\User::class)
        <div class=" my-3">
            <h5>User Management</h5>
            <div class="list-group my-3">
                <a href="{{ route('users.index') }}" class="  list-group-item list-group-item-action">User List </a>

            </div>
        </div>
    @endcan

    {{-- Article Controller --}}
    <div class=" my-3">
        <h5>Articles</h5>
        <div class="list-group my-3">
            <a href="{{route("article.create")}}" class="  list-group-item list-group-item-action">Create New Article </a>
            <a href="{{route("article.index")}}" class="  list-group-item list-group-item-action">Created Articles </a>
        </div>
    </div>

    {{-- Category Controller --}}
    @can('viewAny', App\Models\Category::class)
    <div class=" my-3">
        <h5>Categories</h5>
        <div class="list-group my-3">
            <a href="{{route("category.create")}}" class="  list-group-item list-group-item-action">Create New Category</a>
            <a href="{{route("category.index")}}" class="  list-group-item list-group-item-action">Created Categories</a>
        </div>
    </div>
    @endcan

    {{-- Profile --}}
    <div class=" my-3">
        <h5>Profile Management</h5>
        <div class="list-group my-3">
            <a href="{{ route('users.profile') }}"
                class=" d-flex align-items-center gap-3  list-group-item list-group-item-action">Profile

                @if (is_null(Auth::user()->email_verified_at))
                    <span class=" badge bg-danger">Need Verify!</span>
                @endif

            </a>
            <a href="{{route("users.password")}}" class="  list-group-item list-group-item-action">Change Password </a>
        </div>
    </div>
    {{-- Logout --}}
    <div class=" my-3">
        <div class="list-group my-3">

            <a class="list-group-item-danger bg-danger text-white  list-group-item list-group-item-action" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

    </div>
</div>
