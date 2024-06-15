@extends('template.app')

@section('title', 'BestCut Salon')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* .swiper-slide{
        width: 100% !important;
        margin: 0 !important;
    } */

</style>
@endsection

@section('content')
<div style="background-image: url('{{asset('assets/img/hero.jpg')}}');" class="w-full h-[100vh] bg-no-repeat bg-cover">
    <div class="container mx-auto h-full relative">
        <div
            class="absolute text-white top-1/2 left-1/2 md:left-auto md:-translate-x-0 -translate-y-1/2 -translate-x-1/2 text-center md:text-left">
            <h1 class="text-4xl w-60 md:text-7xl md:w-[600px] mx-auto md:mx-0 mb-3">Get Treatment You Deserve</h1>
            <button class="text-white px-3 py-2 rounded-md bg-[#9F2B2B] mb-3">Book Appointment</button>
            <p class="w-72">
                Our professional team will give you the best treatment you want, with best product and relaxing
                environment.
            </p>
        </div>
    </div>
</div>

{{-- Treatment section --}}
<section id="treatment" class="mb-10">
    <div class="container mx-auto">
        <h2 class="font-bold text-4xl pt-10 pb-5">Our Treatment</h2>
        <p class="w-[400px] pb-5">
            WE ARE COMMITED TO BRINGING THE BEST PRODUCT SERVICE AND ADVICE TO OUR CUSTOMERS.
        </p>

        <div class="grid grid-cols-2 md:grid-cols-3 justify-center gap-2">
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-semibold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-semibold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-semibold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-semibold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-semibold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-semibold rounded-lg">
                    Haircut
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Pricelist section --}}
<section class="bg-secondary py-10 mb-10" id="pice-list">
    <div class="container">
        <h2 class="font-bold text-center text-4xl pb-3 text-white mb-5">Price List</h2>
        <div class="grid grid-cols-2 gap-3 text-white">
            <div class="relative mb-2">
                <div class="after:content-[''] after:block after:w-full after:h-1 after:bg-white after:mt-2 after:mb-3">
                    <div class="flex justify-between">
                        <div class="title text-base md:text-2xl">Haircut</div>
                        <div class="price text-base md:text-2xl">120-150k</div>
                    </div>
                </div>
                <div class="text-base">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet deserunt eum, recusandae a
                    architecto, rerum ad excepturi placeat iusto maiores voluptas saepe consequatur, magni ullam.
                    Accusantium harum vitae alias repellendus?
                </div>
            </div>
            <div class="relative mb-2">
                <div class="after:content-[''] after:block after:w-full after:h-1 after:bg-white after:mt-2 after:mb-3">
                    <div class="flex justify-between">
                        <div class="title text-base md:text-2xl">Haircut</div>
                        <div class="price text-base md:text-2xl">120-150k</div>
                    </div>
                </div>
                <div class="text-base">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet deserunt eum, recusandae a
                    architecto, rerum ad excepturi placeat iusto maiores voluptas saepe consequatur, magni ullam.
                    Accusantium harum vitae alias repellendus?
                </div>
            </div>
            <div class="relative mb-2">
                <div class="after:content-[''] after:block after:w-full after:h-1 after:bg-white after:mt-2 after:mb-3">
                    <div class="flex justify-between">
                        <div class="title text-base md:text-2xl">Haircut</div>
                        <div class="price text-base md:text-2xl">120-150k</div>
                    </div>
                </div>
                <div class="text-base">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet deserunt eum, recusandae a
                    architecto, rerum ad excepturi placeat iusto maiores voluptas saepe consequatur, magni ullam.
                    Accusantium harum vitae alias repellendus?
                </div>
            </div>
            <div class="relative mb-2">
                <div class="after:content-[''] after:block after:w-full after:h-1 after:bg-white after:mt-2 after:mb-3">
                    <div class="flex justify-between">
                        <div class="title text-base md:text-2xl">Haircut</div>
                        <div class="price text-base md:text-2xl">120-150k</div>
                    </div>
                </div>
                <div class="text-base">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet deserunt eum, recusandae a
                    architecto, rerum ad excepturi placeat iusto maiores voluptas saepe consequatur, magni ullam.
                    Accusantium harum vitae alias repellendus?
                </div>
            </div>
        </div>
    </div>
</section>

<section id="worker" class="py-10">
    {{-- <div class="flex w-full h-full">
        <div class="bg-white">
            <div class="container">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores incidunt enim laboriosam eius delectus cumque? Provident, magnam expedita voluptatum minima pariatur nam eius repellat. Molestiae vitae cumque laboriosam quae voluptatem?
            </div>
        </div>
        <div class="bg-primary">
            <div class="container">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis dignissimos quibusdam cum, accusantium ut earum beatae nostrum quam esse, explicabo in veritatis illum assumenda nihil voluptates animi? Ut, dignissimos sint.
            </div>
        </div>
    </div> --}}
    <div class="container mx-auto">

        <div class="grid md:grid-cols-6 grid-cols-1 items-center">
            <div class="w-full col-span-2">
                <h2 class="font-bold text-4xl pt-10 pb-5">Our Worker</h2>
                <p class="pb-5">
                    WE COLLABORATE WITH EXPERIENCED PROFESSIONALS IN THEIR RESPECTIVE FIELDS.
                </p>
            </div>
            <div class="w-full col-span-4">
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    {{-- <div class="w-full"> --}}
                        <div class="flex gap-3 mb-2 justify-end">
                            <i class="fa-solid fa-arrow-left text-2xl cursor-pointer text-primary prev"></i>
                            <i class="fa-solid fa-arrow-right text-2xl cursor-pointer text-primary next"></i>
                        </div>
                        <div class="swiper-wrapper p-3">
                            <!-- Slides -->
                            @foreach ($workers as $worker)
                                <div class="swiper-slide max-w-fit">
                                    <div
                                        class="card max-w-fit shadow-lg rounded-md overflow-hidden">
                                        <div class="card-image w-32 h-32 md:w-64 md:h-64">
                                            <img src="{{asset('storage/'.$worker->worker->image)}}"  class="w-full h-full" alt="worker">
                                        </div>
                                        <h3 class="text-black font-semibold p-3 text-center">{{$worker->name}}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    {{-- </div> --}}
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: false,

        // If we need pagination
        // pagination: {
        //     el: '.swiper-pagination',
        // },

        slidesPerView: 2,
        spaceBetween: 10,

        // Navigation arrows
        navigation: {
            nextEl: '.next',
            prevEl: '.prev',
        },

        // And if we need scrollbar
        // scrollbar: {
        //     el: '.swiper-scrollbar',
        // },
    });

</script>
@endpush
