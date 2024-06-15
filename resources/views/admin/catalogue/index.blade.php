@extends('admin.template.app')

@section('title', 'Admin Category')

@section('content')
<a href="{{route('admin.catalogue.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
    Tambah Catalogue
</a>
<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
    <div class="container mx-auto">
        <table id="workerTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catalogues as $catalogue)
                <tr>
                    <td>{{ucfirst($catalogue->title)}}</td>
                    <td>
                        <img class="w-28 h-w-28" src="{{$catalogue->image && $catalogue->image != "" ? asset('storage/'.$catalogue->image) : asset('assets/img/no_image.png')}}" alt="thumb">
                    </td>
                    <td>
                        <div class="flex gap-3">
                            <a href="{{route('admin.catalogue.edit', $catalogue->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                Edit
                            </a>
                            <a href="{{ route('admin.catalogue.destroy', $catalogue->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" data-confirm-delete="true">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@push('js')
    <script>
        let table = new DataTable('#workerTable');
    </script>
@endpush
