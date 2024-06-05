@extends('template.app')

@section('title', 'BestCut Salon')

@section('content')
<div style="background-image: url('{{asset('assets/img/hero2.jpg')}}');" class="w-full h-[70vh] bg-center bg-no-repeat bg-cover before:content-[''] before:block before:w-full before:h-full before:bg-cover"></div>

<section id="categories" class="mt-10">
    <div class="container mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 mt-10 gap-5">
            <div class="relative rounded-lg overflow-hidden">
                <img src="{{asset('assets/img/wolfcut.png')}}" class="w-full" alt="gallery">
            </div>
            <div class="relative rounded-lg overflow-hidden">
                <img src="{{asset('assets/img/wolfcut.png')}}" class="w-full" alt="gallery">
            </div>
            <div class="relative rounded-lg overflow-hidden">
                <img src="{{asset('assets/img/wolfcut.png')}}" class="w-full" alt="gallery">
            </div>
            <div class="relative rounded-lg overflow-hidden">
                <img src="{{asset('assets/img/wolfcut.png')}}" class="w-full" alt="gallery">
            </div>
            <div class="relative rounded-lg overflow-hidden">
                <img src="{{asset('assets/img/wolfcut.png')}}" class="w-full" alt="gallery">
            </div>
        </div>
    </div>
</section>
@endsection