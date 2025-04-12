<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('admins.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admins/customers">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="ml-2">Customer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admins/categories">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-shopping-cart">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="ml-2">Category</span>
                </a>
                                <!-- Menu con -->
                                <ul class="nav flex-column sub-menu" id="productSubMenu">
                                    <li class="nav-item"><a class="nav-link" href="/admins/categories">Danh sách danh mục</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admins.categories.create')}}">Thêm danh mục</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admins.categories.thungrac')}}">Thùng rác</a></li>
                                </ul>
            </li>
            <!-- Thêm menu con cho sản phẩm -->
            <li class="nav-item">
                <a class="nav-link" href="/admins/products" id="productLink">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-file">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <polyline points="13 2 13 9 20 9"></polyline>
                    </svg>
                    <span class="ml-2">Product</span>
                </a>
                <!-- Menu con -->
                <ul class="nav flex-column sub-menu" id="productSubMenu">
                    <li class="nav-item"><a class="nav-link" href="/admins/products">Danh sách sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admins.products.create')}}">Thêm sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admins.products.thungrac')}}">Thùng rác</a></li>
                </ul>
            </li>
            <!-- Banner -->
            <li class="nav-item">
                <a class="nav-link" href="/admins/banners">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-bar-chart-2">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                    <span class="ml-2">Banner</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admins/contacts">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="ml-2">Contact</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admins/posts">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="ml-2">Post</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admins/reviews">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="ml-2">Review</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Thêm Bootstrap JS và Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- CSS để hiển thị menu con -->
<style>
    /* Menu con sẽ hiển thị như một thẻ li bên dưới "Product" */
    .sub-menu {
        display: none; /* Ẩn menu con ban đầu */
        margin-left: 20px; /* Tạo khoảng cách nhỏ bên trái */
        opacity: 0; /* Đảm bảo menu con không có hiệu ứng mờ khi hiển thị */
        transition: opacity 0.3s ease-in-out; /* Thêm hiệu ứng mờ */
    }

    /* Khi di chuột vào mục "Product", hiển thị menu con */
    #productLink:hover + #productSubMenu {
        display: block; /* Hiển thị menu con khi hover vào "Product" */
        opacity: 1; /* Hiển thị menu con dần dần */
    }

    /* Để tạo độ trễ cho việc ẩn và hiển thị menu */
    #productLink {
        position: relative; /* Để tạo không gian cho sự kiện hover */
    }

    /* Cải thiện khoảng cách giữa menu con và các mục khác */
    #productSubMenu li {
        list-style-type: none; /* Loại bỏ dấu chấm */
    }

    #productSubMenu li a {
        padding: 8px 16px; /* Tạo khoảng cách cho các mục con */
        color: #000; /* Màu chữ */
    }

    #productSubMenu li a:hover {
        background-color: #f1f1f1; /* Thêm hiệu ứng hover cho các mục con */
    }
</style>

<!-- JavaScript để giữ menu con hiển thị lâu hơn và tự động ẩn sau 5-10 giây -->
<script>
    let productLink = document.getElementById('productLink');
    let productSubMenu = document.getElementById('productSubMenu');

    let timer; // Biến để lưu bộ đếm thời gian

    // Khi di chuột vào menu "Product", hiển thị menu con và bắt đầu bộ đếm thời gian
    productLink.addEventListener('mouseenter', function() {
        clearTimeout(timer); // Hủy bỏ bộ đếm thời gian trước đó (nếu có)
        productSubMenu.style.display = 'block'; // Hiển thị menu con
        productSubMenu.style.opacity = 1; // Đảm bảo menu con hiển thị mượt mà

        // Đặt bộ đếm thời gian để ẩn menu con sau 5 giây
        timer = setTimeout(function() {
            productSubMenu.style.opacity = 0;
            setTimeout(function() {
                productSubMenu.style.display = 'none';
            }, 300); // Ẩn menu con sau khi mờ đi
        }, 1000); // Đợi 1 giây (1000ms) rồi ẩn menu
    });

    // Khi chuột rời khỏi "Product", giữ menu con hiển thị trong 5-10 giây trước khi ẩn
    productLink.addEventListener('mouseleave', function() {
        // Đặt bộ đếm thời gian lại để đảm bảo menu không tự động ẩn ngay lập tức
        clearTimeout(timer); // Hủy bỏ bộ đếm thời gian trước đó

        // Đặt bộ đếm thời gian để ẩn menu con sau 5 giây
        timer = setTimeout(function() {
            productSubMenu.style.opacity = 0;
            setTimeout(function() {
                productSubMenu.style.display = 'none';
            }, 300); // Ẩn menu con sau khi mờ đi
        }, 5000); // Đợi 5 giây (5000ms) rồi ẩn menu
    });
</script>
