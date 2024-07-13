@php
    $times = ["09:00", "11:00", "13:00", "15:00", "17:00", "19:00", "21:00"];
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="form-group">
                        <label class="mb-2 block">Treatment</label>
                        <select name="treatment" id="treatment_option" onchange="reqWorker(this)" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                            <option value="" selected>Pilih Treatment...</option>
                            @foreach ($treatments as $treatment)
                                <option value="{{$treatment->id}}">{{ucfirst($treatment->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mb-2 block">Worker</label>
                        <select id="workerSelect" name="worker" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                            <option value="" selected>Pilih Worker...</option>
                        </select>
                        <input type="hidden" id="price">
                    </div>
                </div>
                <button onclick="addTreatmentList()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Tambah List
                </button>
            </div>

            <div class="md:col-span-4 col-span-12 bg-white shadow-lg p-3">
                <form action="{{route('user.appointment.store')}}" method="post">
                    @csrf
                    <div class="grid grid-cols-1">
                        <div class="form-group">
                            <label class="mb-2 block">Date</label>
                            <input type="date" min="{{date("Y-m-d")}}" name="date" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Time</label>
                            {{-- <input type="time" id="appointment_time" name="time" min="07:00" max="21:00" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary">
                            <small class="text-red-500">*Jam kerja dimulai jam 07:00 sampai 21:00</small> --}}
                            <div class="grid md:grid-cols-4 grid-cols-2 gap-2">
                                @foreach ($times as $key => $time)
                                <div class="time-group">
                                    <input type="radio" id="time-{{$key}}" name="time" value="{{$time}}" class="hidden peer" required />
                                    <label for="time-{{$key}}" class="inline-flex items-center justify-center w-full py-3 px-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 peer-checked:bg-blue-600 peer-checked:text-white hover:text-gray-600 hover:bg-gray-100">                           
                                        {{$time}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="text-group mt-5 flex justify-between flex-col md:flex-row mb-5 text-2xl">
                        <h4 class="mb-3">Total:</h4>
                        <h5 class="font-bold mb-3" id="total_price">Rp. 0</h5>
                    </div>
                    <div class="input-group grid grid-cols-2" id="inputGroup"></div>
                    <button class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Bayar</button>
                </form>
            </div>
        </div>

        <table class="w-full text-left divide-y divide-gray-200" id="treatmentTable">
            <thead>
                <tr>
                    <th class="p-3">Treatment</th>
                    <th class="p-3">Worker</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200" id="tbody"></tbody>
        </table>
        {{-- <form action="{{route('user.appointment.store')}}" method="POST">
            @csrf
            <div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4 py-3">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="form-group">
                            <label class="mb-2 block">Treatment</label>
                            <select name="treatment" id="treatment_option" onchange="reqWorker(this)" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                                <option value="" selected>Pilih Treatment...</option>
                                @foreach ($treatments as $treatment)
                                    <option value="{{$treatment->id}}">{{ucfirst($treatment->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Worker</label>
                            <select id="workerSelect" name="worker" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Date</label>
                            <input type="date" min="{{date("Y-m-d")}}" name="date" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Time</label>
                            <input type="time" id="appointment_time" name="time" min="07:00" max="21:00" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary">
                            <small class="text-red-500">*Jam kerja dimulai jam 07:00 sampai 21:00</small>
                        </div>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Simpan
                    </button>
                </div>
            </div>
        </form> --}}
    </div>

    <script>
        const priceTreatment = document.querySelector('#price');

        function format_rupiah(nStr) {
            if (nStr === null) {
                return 'Rp. 0';
            }
            nStr += '';
            x = nStr.split(',');
            x1 = x[0];
            x2 = x.length > 1 ? ',' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return 'Rp. ' + x1 + x2;
        }

        async function reqWorker(e){
            const url = `{{ url('user/appointment/getWorker') }}/${encodeURIComponent(e.value)}`;
            let result = await fetch(url).then(response => response.json())
            // console.log(result)
            priceTreatment.value = "";
            createOption(result)
        }

        function createOption(data) {
            const select = document.querySelector('#workerSelect');
            select.innerHTML = '<option value="" selected>Pilih Worker...</option>';
            if (data.length == 0) {
                select.innerHTML = '';
                return;
            }

            data.forEach(worker => {
                // console.log(worker)
                let opt = document.createElement('option');
                opt.setAttribute('data-price', worker.price);
                opt.value = worker.id;
                opt.innerHTML = worker.user.name+" - "+format_rupiah(worker.price);
                select.appendChild(opt);
            });

            select.addEventListener('change', displayWorkerPrice);
        }

        function displayWorkerPrice() {
            const select = document.querySelector('#workerSelect');

            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            priceTreatment.value = price;
            // You can display the price in an element on the page if needed
        }


        let treatmentList = [];

        function addTreatmentList() {
            const treatment = document.querySelector('#treatment_option');
            const workerSelect = document.querySelector('#workerSelect');

            if(treatment.value == "" || workerSelect.value == ""){
                alert("silahkan pilih treatment dan worker yang tersedia");
                return;
            }

            let objectTreatment = {
                id: Date.now(),
                treatmentId: treatment.value,
                treatmentName: treatment.options[treatment.selectedIndex].text,
                workerId: workerSelect.value,
                workerName: workerSelect.options[workerSelect.selectedIndex].text,
                price: parseInt(priceTreatment.value),
            }
            
            let index = treatmentList.find((item) => item.treatmentId === treatment.value && item.workerId === workerSelect.value);
            if(!index){
                treatmentList.push(objectTreatment);
                addToTable(treatmentList);
            }else{
                alert('data sudah ada');
            }
            // console.log(index);
            console.log(treatmentList);


            treatment.selectedIndex = -1;
            workerSelect.selectedIndex = -1;
            // console.log(objectTreatment);
        }

        function addToTable(data) {
            let treatmentTable = document.querySelector('#treatmentTable');
            let tbody = document.querySelector('#tbody');
            const inputGroup = document.querySelector('#inputGroup');

            tbody.innerHTML = "";
            inputGroup.innerHTML = "";
            
            let inputIndex = 0;
            data.forEach( (value, index) => {
                let tr = document.createElement('tr');

                let td1 = document.createElement('td');
                let td2 = document.createElement('td');
                let td3 = document.createElement('td');
                let td4 = document.createElement('td');

                td4.innerHTML = `<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" id="hapusRow" data-treatmentId="${value.id}" onclick="hapusRow(this)">Hapus</button>`;

                td1.classList.add('p-3');
                td2.classList.add('p-3');
                td3.classList.add('p-3');
                td4.classList.add('p-3');

                td1.innerText = value.treatmentName;
                td2.innerText = value.workerName;
                td3.innerText = format_rupiah(value.price);
                // td4.innerText = 10000;

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);

                tbody.appendChild(tr);

                // create input
                let treatment_id = document.createElement("input");
                let worker_id = document.createElement("input");
                treatment_id.setAttribute('type', 'text');
                // treatment_id.setAttribute('name', `appointment[${inputIndex}]`);
                treatment_id.setAttribute('name', `appointment[${inputIndex}]`);
                treatment_id.setAttribute("value", JSON.stringify({"treatmentId" : value.treatmentId, "workerId" : value.workerId}));
                
                inputGroup.append(treatment_id);
                inputIndex++;

                // Get total price
                document.querySelector('#total_price').innerText = format_rupiah(data.reduce((sum, treatment) => sum + treatment.price, 0));
            } )
        }
        
        function hapusRow(e){
            const idList = e.getAttribute('data-treatmentId').toString();
            let newTreatmentList = treatmentList.filter(item => item.id.toString() !== idList);
            treatmentList = newTreatmentList;
            addToTable(treatmentList);
        }

        // function setCurrentTime() {
        //     const now = new Date();
        //     const hours = String(now.getHours()).padStart(2, '0');
        //     const minutes = String(now.getMinutes()).padStart(2, '0');
        //     const currentTime = `${hours}:${minutes}`;
            
        //     const timeInput = document.getElementById('appointment_time');
        //     timeInput.value = currentTime;
        // }
        
        // setCurrentTime();

    </script>
</body>
</html>