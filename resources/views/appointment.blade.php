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
    <div class="container mx-auto">
        <h1 class="text-2xl mt-5">Make Your Appointment</h1>
        <form action="{{route('admin.account.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4 py-3">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        {{-- <div class="form-group">
                            <label class="mb-2 block">Specialist</label>
                            <select name="specialist" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                                @foreach ($categories as $category)
                                    <option value="{{$category->title}}">{{ucfirst($category->title)}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label class="mb-2 block">Phone</label>
                            <input type="text" name="phone" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                                required />
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Address</label>
                            <textarea name="address" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Price</label>
                            <input type="text" name="price" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                                required />
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Image</label>
                            <input type="file" name="image" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5" />
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Treatment</label>
                            <select name="treatment" id="treatment_option" onchange="reqWorker(this)" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                                <option value="null" selected>Pilih Treatment...</option>
                                @foreach ($treatments as $treatment)
                                    <option value="{{$treatment->id}}">{{ucfirst($treatment->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Worker</label>
                            <select id="workerSelect" name="worker" onchange="reqWorker(this)" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Date</label>
                            <input type="date" name="date" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                        </div>
                        <div class="form-group">
                            <label class="mb-2 block">Time</label>
                            <input type="time" name="time" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                        </div>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const treatment = document.querySelector('#treatment_option');
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
                return;
            }
            data.forEach(worker => {
                console.log(worker)
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

    </script>
</body>
</html>