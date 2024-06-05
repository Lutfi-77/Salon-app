@php
    $groupLink = [
        ['url' => '/', 'title' => 'Home'],
        ['url' => '/catalogue', 'title' => 'Catalogue'],
        ['url' => '/gallery', 'title' => 'Gallery'],
    ]
@endphp

<nav id="navbar" class="w-full bg-darkTransparent fixed top-0 w-full shadow-md z-10">
    <div class="container mx-auto">
        <div class="flex justify-between text-white items-center">
            <div class="py-5">Logo</div>
            <div class="py-5 hidden md:block">
                @foreach ($groupLink as $link)
                    <a href="{{$link['url']}}" class="mx-3">{{$link['title']}}</a>
                @endforeach
            </div>
            <div class="py-5">
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
        @foreach ($groupLink as $link)
            <a href="{{$link['url']}}" class="p-3">{{$link['title']}}</a>
        @endforeach
    </div>
</nav>