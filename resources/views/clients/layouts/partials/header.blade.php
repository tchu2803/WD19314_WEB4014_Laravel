<div class="hero_area">
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.html">
          <span>
            TechShop
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('clients.home') }}">Trang chủ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/clients/products">
                Sản phẩm
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/clients/posts">
                Bài viết
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/clients/contact">
                Liên hệ
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Tại sao chọn chúng tôi</a>
            </li>
          </ul>
          <div class="user_option">
            @if (!Auth::check())
            <a href="{{ route('login')}}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                Đăng nhập
              </span>
            </a>
            @else
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm mr-3 mt-1">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </button>
            </form>
            @endif
            <a href="{{ route('clients.carts.index') }}">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </a>
            <form class="form-inline ">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </div>
        </div>
      </nav>
    </header>