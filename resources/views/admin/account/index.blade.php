@extends('admin.template.app')

@section('title', 'Admin Gallery')

@section('content')
<a href="{{route('admin.account.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
    Tambah Akun
</a>
<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
    <div class="container mx-auto">
        <table id="workerTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>No. Phone</th>
                    <th>Address</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                <tr>
                    <td>{{$worker->name}}</td>
                    <td>{{$worker->email}}</td>
                    <td>{{$worker->worker ? $worker->worker->phone : "-"}}</td>
                    <td>{{$worker->worker ? $worker->worker->address : "-"}}</td>
                    <td>{{$worker->worker ? $worker->worker->price : "-"}}</td>
                    <td>
                        <img src="{{$worker->worker ? asset('storage/'.$worker->worker->image) : asset('assets/img/no_image.png')}}" alt="thumb">
                    </td>
                    <td>
                        <div class="flex gap-3">
                            <a href="{{route('admin.account.edit', $worker->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                Edit
                            </a>
                            <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>No. Phone</th>
                    <th>Address</th>
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
