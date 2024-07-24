@php
    function getStatusClass($status) {
        switch ($status) {
            case 'Batal':
                return 'bg-red-500 text-white';
            case 'Selesai':
                return 'bg-green-500 text-white';
            default:
                return '';
        }
    }
@endphp
@extends('admin.template.app')

@section('title', 'Admin Appointment')

@section('content')
<div class="flex gap-3">
    <a href="{{route('admin.appointment.index')}}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
        Semua Appointment
    </a>
    <a href="{{route('admin.appointment.index', 'sudah_selesai')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
        Sudah Selesai
    </a>
</div>
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
                    <td>
                        <div class="font-bold px-2 py-1 rounded-lg text-center {{getStatusClass($appointment->status)}}">
                            {{$appointment->status == null ? "-" : $appointment->status}}
                        </div>
                    </td>
                    <td>
                        <div class="flex gap-3">
                            {{-- <a href="{{route('admin.account.edit', $appointment->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                Edit
                            </a> --}}
                            {{-- <a href="{{ route('admin.account.destroy', $appointment->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" data-confirm-delete="true">
                                Delete
                            </a> --}}
                            @if ($appointment->status == null || $appointment->status == '')
                                <a href="{{ route('admin.complete.appointment', $appointment->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm" data-confirm-finish="true">
                                    Selesaikan Appointment
                                </a>

                            @else
                            <a href="{{ route('admin.transaction.payment', $appointment->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Bayar
                            </a>
                            @endif
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        document.addEventListener('click', function(event) {
            if (event.target.matches('[data-confirm-finish]')) {
                event.preventDefault();
                Swal.fire({"title":"Selesaikan Appointment!","text":"Selesaikan Appointment Ini?","background":"#fff","width":"32rem","heightAuto":true,"padding":"1.25rem","showCloseButton":false,"confirmButtonText":"Yes, complete it!","cancelButtonText":"Cancel","timerProgressBar":false,"customClass":{"container":null,"popup":null,"header":null,"title":null,"closeButton":null,"icon":null,"image":null,"content":null,"input":null,"actions":null,"confirmButton":null,"cancelButton":null,"footer":null},"showCancelButton":true,"confirmButtonColor":null,"icon":"warning","showLoaderOnConfirm":true,"allowEscapeKey":false,"allowOutsideClick":false}).then(function(result) {
                    if (result.isConfirmed) {
                        window.location.href = event.target.href;
                    }
                });
            }
        });
    </script>
@endpush
