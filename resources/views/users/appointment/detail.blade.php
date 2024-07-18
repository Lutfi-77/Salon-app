@extends('users.template.app')

@section('title', 'Dashboard')

@section('content')

@php
    function getStatusClass($status) {
        switch ($status) {
            case 'Menunggu':
                return 'bg-yellow-500 text-white';
            case 'Diterima':
                return 'bg-blue-500 text-white';
            case 'Batal':
                return 'bg-red-500 text-white';
            case 'Selesai':
                return 'bg-green-500 text-white';
            default:
                return '';
        }
    }
@endphp

<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 gap-5">
            @foreach ($detailAppointments as $detailAppointment)
            <div class="card w-full overflow-hidden shadow-[0.625rem_0.625rem_0.875rem_0_rgb(225,226,228),-0.5rem_-0.5rem_1.125rem_0_rgb(255,255,255)] rounded-lg bg-white">
                <div class="p-3">
                    <h3 class="text-md my-1">Worker: {{$detailAppointment->worker}}</h3>
                    <h3>Treatment: {{$detailAppointment->treatment}}</h3>
                    <div class="flex justify-between items-center mt-3">
                        <h3>Status:</h3>
                        <div class="font-bold px-2 py-1 rounded-lg text-white {{getStatusClass($detailAppointment->status_worker)}}">{{$detailAppointment->status_worker}}</div>
                    </div>
                    <div class="flex justify-between mt-3">
                        <div class="font-bold">Tanggal Reschedule:</div>
                        <div class="font-bold">{{$detailAppointment->reschedule_time || $detailAppointment->reschedule_date ? $detailAppointment->reschedule_date : "-"}}</div>
                    </div>
                    <div class="flex justify-between mt-3">
                        <div class="font-bold">Waktu Reschedule:</div>
                        <div class="font-bold">{{$detailAppointment->reschedule_time || $detailAppointment->reschedule_date ? $detailAppointment->reschedule_time : "-"}}</div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 w-full">
                    <a href="{{route('user.appointment.edit', $detailAppointment->id)}}" class="bg-blue-700 w-full text-white text-center px-2 py-2">Reschedule</a>
                    <a href="{{route('user.appointment.cancel', $detailAppointment->id)}}" class="block bg-red-700 w-full text-white text-center px-2 py-2" data-confirm-delete="true">Cancel Treatment</a>
                </div>
            </div>
            @endforeach
        </div>
        {{-- <table id="dataTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Treatment</th>
                    <th>Worker</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                <tr>
                    <td>{{$appointment->treatment}}</td>
                    <td>{{$appointment->worker->user->name}}</td>
                    <td>{{$appointment->date}}</td>
                    <td>{{$appointment->time}}</td>
                    <td>{{$appointment->status}}</td>
                    <td>
                        <div class="flex gap-3 flex-col text-center">
                            <a href="{{route('user.appointment.edit', $appointment->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Reschedule
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
                    <th>Treatment</th>
                    <th>Worker</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table> --}}
    </div>
</div>
@endsection

@push('js')
    {{-- <script>
        let table = new DataTable('#dataTable');
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        document.addEventListener('click', function(event) {
        if (event.target.matches('[data-confirm-delete]')) {
            event.preventDefault();
            Swal.fire({"title":"Cancel Treatment!","text":"Yakin mau dicancel?","background":"#fff","width":"32rem","heightAuto":true,"padding":"1.25rem","showCloseButton":false,"confirmButtonText":"Yes, cancel it!","cancelButtonText":"Cancel","timerProgressBar":false,"customClass":{"container":null,"popup":null,"header":null,"title":null,"closeButton":null,"icon":null,"image":null,"content":null,"input":null,"actions":null,"confirmButton":null,"cancelButton":null,"footer":null},"showCancelButton":true,"confirmButtonColor":null,"icon":"warning","showLoaderOnConfirm":true,"allowEscapeKey":false,"allowOutsideClick":false}).then(function(result) {
                if (result.isConfirmed) {
                    window.location.href = event.target.href;
                }
            });
        }
    });

    </script>
@endpush