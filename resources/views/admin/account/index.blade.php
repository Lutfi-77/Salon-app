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
                    <th>No. Phone</th>
                    <th>Address</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>
                        <div class="flex gap-3">
                            <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                Edit
                            </a>
                            <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>No. Phone</th>
                    <th>Address</th>
                    <th>Price</th>
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
