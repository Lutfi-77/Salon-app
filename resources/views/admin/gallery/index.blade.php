@extends('admin.template.app')

@section('title', 'Admin Gallery')

@section('content')
<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4 py-3 w-full h-full">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-3 grid-cols-2 gap-5">
            @foreach ($images as $image)
                <div class="w-full">
                    <img src="{{asset('storage/'.$image->url)}}" alt="thumb" class="w-full h-60 object-cover rounded-md">
                    <a href="{{ route('admin.gallery.destroy', $image->id) }}" class="text-white bg-red-700 px-3 py-1 rounded-lg mt-3 w-full block text-center" data-confirm-delete="true">Delete</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection