@extends('template.app')

@section('title', 'BestCut Salon')

@section('content')
<div style="background-image: url('{{asset('assets/img/hero2.jpg')}}');" class="w-full h-[70vh] bg-center bg-no-repeat bg-cover before:content-[''] before:block before:w-full before:h-full before:bg-cover"></div>

<section id="categories" class="mt-10">
    <div class="container mx-auto">
        <div class="flex items-center justify-between w-full md:w-1/2 mx-auto gap-5">
            <i class="fa-solid fa-arrow-left text-2xl cursor-pointer text-primary leftArrow !hidden"></i>
            <div class="flex gap-5 overflow-x-auto [&::-webkit-scrollbar]:hidden snap-x scrollbar scroll-smooth">
                @foreach ($categories as $category)
                    <a href="{{route('catalogue', $category->id)}}" class="py-1 px-5 rounded-lg border cursor-pointer snap-center shadow-md">{{$category->title}}</a>
                @endforeach
            </div>
            <i class="fa-solid fa-arrow-right text-2xl cursor-pointer text-primary rightArrow"></i>
        </div>


        <div class="grid grid-cols-2 md:grid-cols-4 mt-10 gap-5">
            @foreach ($catalogues as $catalogue)
                <div class="relative rounded-lg overflow-hidden">
                    <img src="{{asset('storage/'.$catalogue->image)}}" class="w-full" alt="catalogue">
                    <div class="absolute top-1 left-1 bg-white px-5 py-1 font-semibold rounded-lg">
                        {{$catalogue->title}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('js')
    <script>
        const nextCategory = document.querySelector('.rightArrow');
        const prevCategory = document.querySelector('.leftArrow');
        const scrollContainer = document.querySelector('.scrollbar');

        const manageIcon = () => {
            if(scrollContainer.scrollLeft >= 20){
                prevCategory.classList.remove('!hidden');
            }else{
                prevCategory.classList.add('!hidden');
            }

            let maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth - 20;

            if(scrollContainer.scrollLeft >= maxScroll){
                nextCategory.classList.add('!hidden');
            }else{
                nextCategory.classList.remove('!hidden');
            }

            console.log('Scroll width: ', scrollContainer.scrollWidth)
            console.log('Client width: ', scrollContainer.clientWidth)
        }

        nextCategory.addEventListener('click', function() {
            scrollContainer.scrollLeft += 100;
            manageIcon();
        });
        prevCategory.addEventListener('click', function() {
            scrollContainer.scrollLeft -= 100;
            manageIcon();
        });

        scrollContainer.addEventListener('scroll', manageIcon);
    </script>
@endpush