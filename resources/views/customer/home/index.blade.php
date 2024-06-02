<main class="main mt-14">
    <div class="main-wrap flex-auto w-full relative ">
        <div class="search-box">
            <div class="search-box__image">
                <img src="{{ url('/images/banner/banner-home.jpg') }}"
                    style="display: block; opacity: 1; transform: translate(-50%, 50px); max-width:none" alt="image" />
            </div>
            <div class="search-box__content z-10" style="height: 500px">
                <div class="container flex justify-center flex-col mx-auto max-w-6xl h-full  xl:pb-5 lg:pb-5">
                    <div class="home-intro flex flex-col items-center">
                        <div class="section-title-separator mb-3">
                            <span>
                                <i class="fa-solid fa-star" style="color: #d0dbdb;"></i>
                                <i class="fa-solid fa-star text-2xl" style="color: #f9b90f;"></i>
                                <i class="fa-solid fa-star" style="color: #d0dbdb;"></i>
                            </span>
                        </div>
                        <h2 class="text-center">HỆ THỐNG HỖ TRỢ TÌM KIẾM SÂN BÃI NHANH</h2>
                        <span class="section-separator"></span>
                        <h3 class="text-center">
                            Dữ liệu được Datsan247 cập nhật thường xuyên giúp cho người dùng tìm được sân một cách nhanh
                            nhất
                        </h3>
                    </div>
                    <div class="main-search-input-wrap w-4/6 mx-auto ">
                        <div class="flex flex-wrap ">
                            <div
                                class="main-search-input-item min-h-12 bg-white flex flex-auto  justify-between items-center px-3 cursor-pointer">
                                <div>Lọc theo loại sân</div>
                                <input name="pitch_type" hidden type="text" autocomplete="off" />
                                <i class="fa-solid fa-caret-down "></i>
                            </div>
                            <div class="main-search-input-item min-h-12 bg-white flex flex-auto items-center px-3">
                                <input class="w-full h-full outline-none"
                                    placeholder="Nhập tên sân hoặc địa chỉ để tìm kiếm..." />
                            </div>
                            <div class="main-search-input-item min-h-12 bg-white flex flex-auto items-center px-3">
                                <input class="w-full h-full outline-none" placeholder="Nhập khu vực" />
                            </div>
                            <a href="/" class="flex flex-auto">
                                <button class="main-search-input-button min-h-12 w-full px-8">
                                    <span class="text-white pr-2">Tìm kiếm</span>
                                    <i class="text-white fa-solid fa-magnifying-glass"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</main>

<div class="flex flex-auto flex-wrap">
    <div class="container mx-auto max-w-6xl">
        <div class="grid grid-cols-3 py-20">
            <div class="grid grid-row-3 place-items-center px-4">
                <img class="mb-5" src="{{ url('/images/image_find_pitch.png') }}" alt="img" width="86"
                    height="86" />
                <h3 class="font-bold text-2xl mb-6">Tìm kiếm vị trí sân</h3>
                <p class="text-center font-normal text-sm mb-8">Dữ liệu sân đấu dồi dào, liên tục cập nhật, giúp bạn dễ
                    dàng
                    tìm kiếm theo khu
                    vực mong muốn
                </p>
            </div>
            <div class="grid grid-row-3 place-items-center px-4"
                style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                <img class="mb-5" src="{{ url('/images/image_booking_online.png') }}" alt="img" width="86"
                    height="86" />
                <h3 class="font-bold text-2xl mb-6">Đặt lịch online</h3>
                <p class="text-center font-normal text-sm mb-8">Không cần đến trực tiếp, không cần gọi điện đặt lịch,
                    bạn
                    hoàn toàn có thể đặt
                    sân ở bất kì
                    đâu có internet
                </p>
            </div>
            <div class="grid grid-row-3 place-items-center px-4">
                <img class="mb-5" src="{{ url('/images/image_find_match.png') }}" alt="img" width="86"
                    height="86" />
                <h3 class="font-bold text-2xl mb-6">Tìm đối, bắt cặp đấu</h3>
                <p class="text-center font-normal text-sm mb-8">Tìm kiếm, giao lưu các đội thi đấu thể thao, kết nối,
                    xây
                    dựng cộng
                    đồng thể thao
                    sôi nổi,
                    mạnh mẽ
                </p>
            </div>
        </div>
    </div>
</div>
