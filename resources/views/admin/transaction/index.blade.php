@php
    function getStatusClass($status) {
        switch ($status) {
            case 'belum terbayar':
                return 'bg-red-500 text-white';
            case 'sudah terbayar':
                return 'bg-green-500 text-white';
            default:
                return '';
        }
    }

    function format_rupiah($str) {
        if ($str === null) {
            return 'Rp. 0';
        }
        $str = (string) $str;
        $x = explode(',', $str);
        $x1 = $x[0];
        $x2 = count($x) > 1 ? ',' . $x[1] : '';
        $rgx = '/(\d+)(\d{3})/';
        while (preg_match($rgx, $x1)) {
            $x1 = preg_replace($rgx, '$1' . ',' . '$2', $x1);
        }
        return 'Rp. ' . $x1 . $x2;
    }
@endphp
@extends('admin.template.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.3/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.dataTables.css">
    <style>
        body.dt-print-view h1{
            text-align: center;
        }
    </style>
@endsection

@section('title', 'Admin Appointment')

@section('content')
<div class="flex gap-3">
    {{-- <a href="{{route('admin.appointment.index')}}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
        Semua Appointment
    </a>
    <a href="{{route('admin.appointment.index', 'sudah_selesai')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
        Sudah Selesai
    </a> --}}
</div>
<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
    <div class="container mx-auto">
        {{-- {{dd($transactions[0]->appointment->detail)}} --}}
        <table border="0" cellspacing="5" cellpadding="5">
            <tbody>
                <tr>
                    <td>Minimum date:</td>
                    <td><input class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary" type="text" id="min" name="min"></td>
                </tr>
                <tr>
                    <td>Maximum date:</td>
                    <td><input class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary" type="text" id="max" name="max"></td>
                </tr>
            </tbody>
        </table>
        <table id="transactionTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Treatment</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th class="print:hidden">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{$transaction->user->name}}</td>
                    <td>
                        @php
                            $treatments = $transaction->appointment->detail->pluck('treatment');
                            $treatmentList = $treatments->implode(', ');
                        @endphp
                        {{ $treatmentList }}
                    </td>
                    <td>{{format_rupiah($transaction->total_price)}}</td>
                    <td>{{$transaction->created_at->toDateString()}}</td>
                    <td>
                        <div class="font-bold px-2 py-1 rounded-lg text-center {{getStatusClass($transaction->status)}}">
                            {{$transaction->status}}
                        </div>
                    </td>
                    <td class="print:hidden">
                        <a href="{{ route('admin.transaction.invoice', $transaction->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                            Cetak
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Customer</th>
                    <th>Treatment</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th class="print:hidden">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@push('js')
    {{-- <script src="https://cdn.datatables.net/plug-ins/2.1.3/filtering/row-based/range_dates.js"></script> --}}
    <script src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.0.1/js/dataTables.searchBuilder.min.js"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
    <script>
        let minDate, maxDate;
 
        // Custom filtering function which will search data in column four between two values
        DataTable.ext.search.push(function (settings, data, dataIndex) {
            let min = minDate.val();
            let max = maxDate.val();
            let date = new Date(data[2]);
        
            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });
        
        // Create date inputs
        minDate = new DateTime('#min', {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime('#max', {
            format: 'MMMM Do YYYY'
        });
        
        // DataTables initialisation
        let table = new DataTable('#transactionTable',{
            responsive: true,
            layout: {
                topStart: {
                    buttons: [
                        {
                            extend: 'print',
                            className: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                    ]
                }
            }
        });
        
        // Refilter the table
        document.querySelectorAll('#min, #max').forEach((el) => {
            el.addEventListener('change', () => table.draw());
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
    </script> --}}
@endpush
