@extends('template.app')

@section('title', 'BestCut Salon')

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

        <div class="grid grid-cols-3 justify-center gap-2">
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-bold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-bold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-bold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-bold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-bold rounded-lg">
                    Haircut
                </div>
            </div>
            <div class="card w-full rounded-lg overflow-hidden relative">
                <img src="{{asset('assets/img/haircut.jpg')}}" class="w-full" alt="Haircut">
                <div class="absolute top-1 left-1 bg-white px-5 py-1 font-bold rounded-lg">
                    Haircut
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Pricelist section --}}
<section class="bg-[#2A2A2A]" id="pice-list">
    <div class="container">
        <h2 class="font-bold text-center text-4xl pt-10 pb-3 text-white mb-5">Price List</h2>
        <div class="grid grid-cols-2 gap-3 text-white">
            <div class="relative mb-2">
                <div class="after:content-[''] after:block after:w-full after:h-1 after:bg-white after:mt-2 after:mb-3">
                    <div class="flex justify-between">
                        <div class="title text-2xl">Haircut</div>
                        <div class="price text-2xl">120-150k</div>
                    </div>
                </div>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo aspernatur fugiat temporibus aliquid
                culpa, reiciendis autem blanditiis illo accusantium perferendis odit animi sed, est facilis. Asperiores
                voluptatibus nostrum labore nulla.
            </div>
            <div class="relative mb-2">
                <div class="after:content-[''] after:block after:w-full after:h-1 after:bg-white after:mt-2 after:mb-3">
                    <div class="flex justify-between">
                        <div class="title text-2xl">Haircut</div>
                        <div class="price text-2xl">120-150k</div>
                    </div>
                </div>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo aspernatur fugiat temporibus aliquid
                culpa, reiciendis autem blanditiis illo accusantium perferendis odit animi sed, est facilis. Asperiores
                voluptatibus nostrum labore nulla.
            </div>
            <div class="relative mb-2">
                <div class="after:content-[''] after:block after:w-full after:h-1 after:bg-white after:mt-2 after:mb-3">
                    <div class="flex justify-between">
                        <div class="title text-2xl">Haircut</div>
                        <div class="price text-2xl">120-150k</div>
                    </div>
                </div>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo aspernatur fugiat temporibus aliquid
                culpa, reiciendis autem blanditiis illo accusantium perferendis odit animi sed, est facilis. Asperiores
                voluptatibus nostrum labore nulla.
            </div>
            <div class="relative mb-2">
                <div class="after:content-[''] after:block after:w-full after:h-1 after:bg-white after:mt-2 after:mb-3">
                    <div class="flex justify-between">
                        <div class="title text-2xl">Haircut</div>
                        <div class="price text-2xl">120-150k</div>
                    </div>
                </div>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo aspernatur fugiat temporibus aliquid
                culpa, reiciendis autem blanditiis illo accusantium perferendis odit animi sed, est facilis. Asperiores
                voluptatibus nostrum labore nulla.
            </div>
        </div>
    </div>
</section>
@endsection
