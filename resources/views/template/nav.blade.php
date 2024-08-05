@php
    $groupLink = [
        ['url' => route('home'), 'title' => 'Home'],
        ['url' => route('catalogue'), 'title' => 'Catalogue'],
        ['url' => route('gallery'), 'title' => 'Gallery'],
    ]
@endphp

<nav id="navbar" class="w-full bg-darkTransparent fixed top-0 w-full shadow-md z-10">
    <div class="container mx-auto">
        <div class="flex justify-between text-white items-center">
            <div class="py-5">
                <a href="{{route('home')}}">Charisma Salon</a>
            </div>
            <div class="py-5 hidden md:block">
                @foreach ($groupLink as $link)
                    <a href="{{$link['url']}}" class="mx-3">{{$link['title']}}</a>
                @endforeach
            </div>
            <div class="py-5">
                <a href="{{route('user.login')}}" class="hidden md:block">
                    Login
                </a>
                <div class="block md:hidden" id="hamburger">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Nav --}}
    <div id="mobile-nav" class="bg-darkTransparent hidden text-white w-full text-center flex flex-col md:hidden">
        @foreach ($groupLink as $link)
            <a href="{{$link['url']}}" class="p-3">{{$link['title']}}</a>
        @endforeach
        <a href="{{route('user.login')}}" class="p-3">
            Login
        </a>
    </div>
</nav>