@extends('admin.template.app')

@section('title', 'Admin treatment')

@section('content')
<a href="{{route('admin.treatment.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
    Tambah Treatment
</a>
<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
    <div class="container mx-auto">
        <table id="workerTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($treatments as $treatment)
                <tr>
                    <td>{{$treatment->name}}</td>
                    <td>{{$treatment->desc}}</td>
                    <td>{{$treatment->price}}</td>
                    <td>
                        <img src="{{$treatment->image ? asset('storage/'.$treatment->image) : asset('assets/img/no_image.png')}}" alt="thumb" class="w-28">
                    </td>
                    <td>
                        <div class="flex gap-3 flex-col text-center">
                            <a href="{{route('admin.treatment.edit', $treatment->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                Edit
                            </a>
                            <a href="{{ route('admin.treatment.destroy', $treatment->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" data-confirm-delete="true">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
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
