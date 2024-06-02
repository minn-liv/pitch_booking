<header class="header z-20">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between py-2">
            <div class=" menu-wrapper flex items-center text-sm text-white ">
                <div class="menu-item">
                    <a class="menu-item__title active" href="/">Trang chủ</a>
                </div>
                <div class="menu-item">
                    <a class="menu-item__title" href="/">Danh sách sân bãi</a>
                </div>
                <div class="menu-item">
                    <a class="menu-item__title" href="/">Giới thiệu về Đặt sân 247</a>
                </div>
                <div class="menu-item">
                    <a class="menu-item__title" href="/">Chính sách</a>
                </div>
                <div class="menu-item">
                    <a class="menu-item__title" href="/">Điều khoản</a>
                </div>
                <div class="menu-item">
                    <a class="menu-item__title" href="/">Liên hệ</a>
                </div>
            </div>
            <div class="flex items-center text-sm text-white">
                @guest
                    <div class="authentication-button">
                        <a class="menu-item__title px-4" onclick="modal_register.showModal()">Đăng ký</a>
                        <button class="menu-item__title px-4" type="button" data-modal-toggle="login-modal">Đăng
                            nhập</button>
                    </div>
                @endguest

                @auth
                    <form method="GET" action="/dang-xuat">
                        <button type="submit">Đăng xuất</button>
                    </form>
                @endauth

                <div class="show-search-button">
                    <span class="menu-item__search px-4">Tìm kiếm</span>
                    <i></i>
                </div>
            </div>
        </div>
    </div>

</header>

@include('customer.partials.login')
