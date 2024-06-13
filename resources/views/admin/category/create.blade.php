@extends('admin.template.app')

@section('title', 'Admin Category Add')

@section('content')
<form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4 py-3">
        <div class="container mx-auto">
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    @foreach ($errors->all() as $error)
                    <span class="font-medium">{{ $error }}</span>
                    @endforeach
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="form-group">
                    <label class="mb-2 block">Title</label>
                    <input type="text" name="title" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection