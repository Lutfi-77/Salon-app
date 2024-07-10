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
                <button onclick="addTreatmentList()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Tambah List
                </button>
            </div>

            <div class="md:col-span-4 col-span-12 bg-white shadow-lg p-3">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure neque quae rerum quas. Neque et iste tenetur sit maiores, in alias sed numquam quis temporibus consequatur, enim non? Commodi, temporibus.
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
        async function reqWorker(e){
            const url = `{{ url('user/appointment/getWorker') }}/${encodeURIComponent(e.value)}`;
            let result = await fetch(url).then(response => response.json())
            // console.log(result)
            createOption(result)
        }

        function createOption(data) {
            const select = document.querySelector('#workerSelect');
            select.innerHTML = '';
            if (data.length == 0) {
                select.innerHTML = '';
                return;
            }
            data.forEach(worker => {
                // console.log(worker)
                let opt = document.createElement('option');
                opt.value = worker.id;
                opt.innerHTML = worker.user.name+" - "+format_rupiah(worker.price);
                select.appendChild(opt);
            });
        }

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

        function setCurrentTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const currentTime = `${hours}:${minutes}`;
            
            const timeInput = document.getElementById('appointment_time');
            timeInput.value = currentTime;
        }
        
        setCurrentTime();

        let treatmentList = [];

        function addTreatmentList() {
            const treatment = document.querySelector('#treatment_option');
            const workerSelect = document.querySelector('#workerSelect');

            let objectTreatment = {
                id: Date.now(),
                treatmentId: treatment.value,
                treatmentName: treatment.options[treatment.selectedIndex].text,
                workerId: workerSelect.value,
                workerName: workerSelect.options[workerSelect.selectedIndex].text,
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

            tbody.innerHTML = "";
            
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
                td3.innerText = 10000;
                // td4.innerText = 10000;

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);

                tbody.appendChild(tr);
            } )
        }

        // const hapus = document.getElementById("#hapusRow");
        // hapus.addEventListener("click", function(){
        //     console.log(hapus.getAttribute('data-treatmentId'));
        // })
        function hapusRow(e){
            const idList = e.getAttribute('data-treatmentId').toString();
            let newTreatmentList = treatmentList.filter(item => item.id.toString() !== idList);
            treatmentList = newTreatmentList;
            addToTable(treatmentList);
        }

    </script>
</body>
</html>