@extends('template.app')

@section('title', 'BestCut Salon')
@section('content')
    <div style="background-image: url('{{asset('assets/img/hero.jpg')}}');" class="w-full h-[100vh] bg-no-repeat bg-cover">
        <div class="container mx-auto h-full relative">
            <div class="absolute text-white top-1/2 left-1/2 md:left-auto md:-translate-x-0 -translate-y-1/2 -translate-x-1/2 text-center md:text-left">
                <h1 class="text-4xl w-60 md:text-7xl md:w-[600px] mx-auto md:mx-0 mb-3">Get Treatment You Deserve</h1>
                <button class="text-white px-3 py-2 rounded-md bg-[#9F2B2B] mb-3">Book Appointment</button>
                <p class="w-72">
                    Our professional team will give you the best treatment you want, with best product and relaxing environment.
                </p>
            </div>
        </div>
    </div>

    {{-- Treatment section --}}
    <section id="treatment">
        <div class="container mx-auto">
            <h2 class="font-bold text-4xl pt-10 pb-3">Our Treatment</h2>
            <p class="w-[400px]">
                WE ARE COMMITED TO BRINGING THE BEST PRODUCT SERVICE AND ADVICE TO OUR CUSTOMERS.
            </p>
        </div>
    </section>
@endsection