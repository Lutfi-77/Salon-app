@extends('admin.template.app')

@section('title', 'Admin Category')

@section('content')
<a href="{{route('admin.category.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
    Tambah Category
</a>
<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
    <div class="container mx-auto">
        <table id="workerTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->title}}</td>
                    <td>
                        <div class="flex gap-3">
                            <a href="{{route('admin.category.edit', $category->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                Edit
                            </a>
                            <a href="{{ route('admin.category.destroy', $category->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" data-confirm-delete="true">
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
