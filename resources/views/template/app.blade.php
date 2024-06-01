<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @yield('css')
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
