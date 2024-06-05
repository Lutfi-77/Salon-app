<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            background: #ebebeb;
        }

    </style>
</head>

<body>
    <div class="w-full h-full flex justify-center items-center">
        <div class="max-w-lg">
            <div class="container mx-auto">
                <div class="shadow-lg rounded-lg overflow-hidden">
                    <div class="signform p-5">
                        <h2 class="text-2xl mb-5">Sign Up</h2>

                        <form action="">
                            @csrf
                            <div class="flex gap-2">
                                <div class="form-group">
                                    <label class="mb-2 block">Username</label>
                                    <input type="text" name="username"
                                        class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                                        required />
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 block">Email</label>
                                    <input type="email" name="email"
                                        class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                                        required />
                                </div>
                            </div>

                            <label class="mb-2 block">Password</label>
                            <input type="password" id="password" name="password"
                                class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                                required />

                            <label class="mb-2 block">Confirm Password</label>
                            <input type="password" id="cpassword" name="confirm_password"
                                class="appearance-none border-2 border-gray-200 rounded-xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary mb-5"
                                required />

                            <div class="flex items-center">
                                <input type="checkbox" id="showPass"
                                    class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="showPass">
                                    Show Password
                                </label>
                            </div>

                            <button class="w-1/3 block ml-auto bg-primary py-2 text-white rounded-lg">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</body>

</html>
