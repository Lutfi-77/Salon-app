@extends('admin.template.app')

@section('title', 'Admin Transaction')

@section('content')
{{-- <a href="{{route('admin.account.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
    Tambah Akun
</a> --}}
<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
    <div class="container mx-auto">
        <table id="transactionTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Treatment</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                <tr>
                    <td>{{$appointment->user->name}}</td>
                    <td>{{$appointment->detail->count()}} Treatment</td>
                    <td>{{$appointment->appointment_date}}</td>
                    <td>{{$appointment->appointment_time}}</td>
                    <td>{{$appointment->status == null ? "-" : $appointment->status}}</td>
                    <td>
                        <div class="flex gap-3">
                            <a href="{{route('admin.account.edit', $appointment->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                Edit
                            </a>
                            <a href="{{ route('admin.account.destroy', $appointment->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" data-confirm-delete="true">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Customer</th>
                    <th>Treatment</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@push('js')
    <script>
        let table = new DataTable('#transactionTable');
    </script>
@endpush
