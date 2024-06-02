<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @yield('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>@yield('title', 'Home')</title>
</head>

<body>
    <nav class="w-full bg-[rgb(0,0,0)]/[.1] fixed top-0 w-full shadow-lg">
        <div class="container mx-auto">
            <div class="flex justify-between text-white items-center">
                <div class="py-3">Logo</div>
                <div class="py-3 hidden md:block">
                    <a href="">Home</a>
                    <a href="">Home</a>
                    <a href="">Home</a>
                    <a href="">Home</a>
                </div>
                <div class="py-3">
                    <div class="hidden md:block">
                        Login
                    </div>
                    <div class="block md:hidden" id="hamburger">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="mobile-nav" class="bg-red-900 hidden text-white w-full text-center flex flex-col md:hidden">
            <a href="" class="p-3">Home</a>
            <a href="" class="p-3">Home</a>
            <a href="" class="p-3">Home</a>
            <a href="" class="p-3">Home</a>
        </div>
    </nav>
    @yield('content')

    <footer class="bg-[#2A2A2A] mt-5 text-white p-5">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15864.752872235924!2d106.8127452417022!3d-6.238906112439859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f160aff42497%3A0xf981c046e0c8529f!2sCharisma%20Best%20Cut%20Salon!5e0!3m2!1sen!2sid!4v1717351855223!5m2!1sen!2sid"
                    class="border-0 rounded-lg w-full" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

                <div class="flex flex-col gap-2">
                    <h5 class="text-2xl">Charisma Salon</h5>
                    <div class="flex flex-row items-center gap-3">
                        <i class="fa-regular fa-map"></i>
                        Jl. Wolter Monginsidi No.81 Kebayoran Baru, Jakarta Selatan.
                    </div>
                    <div class="flex flex-row items-center gap-3">
                        <i class="fa-brands fa-facebook-f"></i>
                        Charisma.salon
                    </div>
                    <div class="flex flex-row items-center gap-3">
                        <i class="fa-brands fa-instagram"></i>
                        Charisma.salon
                    </div>
                </div>

                <div class="about-us">
                    <h5 class="text-2xl mb-2">Tentang kami</h5>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, illo fuga. Voluptatem possimus necessitatibus distinctio aperiam nostrum dolorum optio earum, laboriosam, deserunt rem rerum mollitia iusto reiciendis voluptas. Alias, beatae.
                </div>
            </div>
        </div>
    </footer>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script>
        const button = document.querySelector('#hamburger');
        const mobileNav = document.querySelector('#mobile-nav');
        button.addEventListener('click', function () {
            button.classList.toggle('change')
            mobileNav.classList.toggle('hidden')
        })

    </script>
    @stack('js')
</body>

</html>
