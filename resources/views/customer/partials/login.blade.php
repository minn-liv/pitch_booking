<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />

<!-- This is an example component -->
<div class="max-w-2xl mx-auto">

    <!-- Main modal -->
    <div id="login-modal" aria-hidden="true"
        class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center" ">
        <div class="relative w-full max-w-md px-4 h-full md:h-auto">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
                <div class="flex justify-end p-2">
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="login-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d=" M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414
        10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0
        010-1.414z" clip-rule="evenodd">
        </path>
        </svg>
        </button>
    </div>
    <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('/nguoi-dung/dang-nhap') }}">
        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Đăng nhập</h3>
        <div>
            <label for="email" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Tên đăng
                nhập</label>
            <input type="email" name="email" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="name@company.com" required="">
            @error('username')
                <span>
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div>
            <label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Mật
                khẩu</label>
            <input type="password" name="password" id="password" placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                required="">
            @error('password')
                <span>
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="flex justify-between">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" aria-describedby="remember" type="checkbox"
                        class="bg-gray-50 border border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        required="">
                </div>
                <div class="text-sm ml-3">
                    <label for="remember" class="font-medium text-gray-900 dark:text-gray-300">Remember
                        me</label>
                </div>
            </div>
            <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Quên mật khẩu?</a>
        </div>
        <button type="submit"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ĐĂNG
            NHẬP</button>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">Chưa có tài khoản? <a href="#"
                class="text-blue-700 hover:underline dark:text-blue-500">
                Đăng ký ngay</a>
        </div>
    </form>
</div>
</div>
</div>

</div>

<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
