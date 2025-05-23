<nav class="navbar navbar-light bg-light p-3 fst-italic">
    <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
        <a class="navbar-brand" href="{{ route('admins.dashboard') }}">
            Trang quản trị
        </a>
        <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar"
            aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle fst-italic" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-expanded="false">
                @if (Auth::check())
                    Hello, {{ Auth::user()->name }}
                @else
                    Hello, Guest
                @endif
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Messages</a></li>
                <li><a href="{{ route('login')}}" class=" dropdown-item">Login</a></li>
                <form action="{{ route('logout')}}" method="POST">
                    @csrf
                    <li><button type="submit" style="border:none; background: none;">
                        <i class="fas fa-sign-out-alt me-2 ml-2">Logout</i>
                    </button></li>
                </form>
            </ul>
        </div>
    </div>
</nav>
