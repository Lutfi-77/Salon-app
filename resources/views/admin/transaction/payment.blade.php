@php
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('sweetalert::alert')
    <div class="container mx-auto">
        <h1 class="text-2xl my-5">Make Your Appointment</h1>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">{{ $error }}</span>
                </div>
            @endforeach
        @endif
        <div class="grid md:grid-cols-12 justify-center gap-4 mb-5">
            <div class="rounded-sm shadow-lg border border-stroke bg-white dark:border-strokedark dark:bg-boxdark xl:col-span-8 col-span-12 p-3">
                <table class="w-full text-left divide-y divide-gray-200" id="treatmentTable">
                    <thead>
                        <tr>
                            <th class="p-3">Treatment</th>
                            <th class="p-3">Worker</th>
                            <th class="p-3">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="tbody">
                        @foreach ($appointment->detail as $detailAppointment)
                        <tr>
                            <td class="p-3">{{$detailAppointment->detailTreatment->name}}</td>
                            <td class="p-3">{{$detailAppointment->worker}}</td>
                            <td class="p-3">{{format_rupiah($detailAppointment->price)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="md:col-span-4 col-span-12 bg-white shadow-lg p-3">
                <form action="{{route('admin.transaction.store', $appointment->id)}}" method="post">
                    @csrf
                    <div class="text-group mt-5 flex justify-between flex-col md:flex-row mb-5 text-lg">
                        <h4 class="mb-3">Customer:</h4>
                        <h5 class="font-bold mb-3" id="total_price">{{$appointment->user->name}}</h5>
                    </div>
                    <div class="text-group mt-5 flex justify-between flex-col md:flex-row mb-5 text-2xl">
                        <h4 class="mb-3">Total:</h4>
                        <h5 class="font-bold mb-3" id="total_price">{{format_rupiah($appointment->detail->sum('price'))}}</h5>
                        <input type="hidden" name="total_price" value="{{$appointment->detail->sum('price')}}">
                    </div>
                    <div class="input-group grid grid-cols-2" id="inputGroup"></div>
                    <button class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Bayar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>