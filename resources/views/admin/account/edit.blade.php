@extends('admin.template.app')

@section('title', 'Admin Account Edit')

@section('content')
<form action="{{route('admin.account.update', $worker->id)}}" method="POST" enctype="multipart/form-data">
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
            <small class="text-red-500">*Kosongkan bagian password dan foto jika tidak ingin diubah</small>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="form-group">
                    <label class="mb-2 block">Name</label>
                    <input type="text" name="name" value="{{$worker->name}}" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Email</label>
                    <input type="email" name="email" value="{{$worker->email}}" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Password</label>
                    <input type="password" id="password" name="password" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        />
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Confirm Password</label>
                    <input type="password" id="cpassword" name="password_confirmation" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        />

                    <div class="flex items-center justify-end">
                        <input type="checkbox" id="showPass"
                            class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="showPass">
                            Show Password
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Role</label>
                    <select name="role" class="border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-primary mb-5">
                        <option value="worker" {{$worker->role == "worker" ? "selected" : ""}}>Worker</option>
                        <option value="admin" {{$worker->role == "admin" ? "selected" : ""}}>Admin</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4 py-3">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="form-group">
                    <label class="mb-2 block">Phone</label>
                    <input type="text" name="phone" value="{{$worker->worker ? $worker->worker->phone : ''}}" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Address</label>
                    <textarea name="address" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5">{{$worker->worker ? $worker->worker->address : ''}}</textarea>
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Price</label>
                    <input type="text" name="price" value="{{$worker->worker ? $worker->worker->price : ''}}" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                        required />
                </div>
                <div class="form-group">
                    <label class="mb-2 block">Image</label>
                    <input type="file" name="image" class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5" />
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
