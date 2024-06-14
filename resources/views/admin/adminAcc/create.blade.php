@extends('admin.template.app')

@section('title', 'Admin Account Add')

@section('content')
<form action="{{route('admin.manage.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4 py-3">
        <div class="container mx-auto">
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    @foreach ($errors->all() as $error)
                    <span class="font-medium">{{ $error }}</span>
                    @endforeach
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="form-group">
                    <label class="mb-2 block">Name</label>
                    <input type="text" name="name" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Email</label>
                    <input type="email" name="email" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Password</label>
                    <input type="password" id="password" name="password" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Confirm Password</label>
                    <input type="password" id="cpassword" name="password_confirmation" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />

                    <div class="flex items-center justify-end">
                        <input type="checkbox" id="showPass"
                            class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="showPass">
                            Show Password
                        </label>
                    </div>
                </div>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Simpan
            </button>
        </div>
    </div>
</form>
@endsection

@push('js')
<script>
    let password = document.querySelector('#password');
    let cpassword = document.querySelector('#cpassword');
    let checkbox = document.querySelector('#showPass');
    console.log(checkbox)
    checkbox.addEventListener('click', function () {
        if (password.type == "password" && cpassword.type == "password") {
            password.type = 'text';
            cpassword.type = 'text';
        } else {
            password.type = 'password';
            cpassword.type = 'password';
        }
    })

</script>
@endpush
