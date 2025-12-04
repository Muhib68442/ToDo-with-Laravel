<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @if(session('message'))
        <span class='block text-center text-sm text-white bg-blue-500 rounded-xl py-2 px-4 w-fit mx-auto my-6 transition-all'>{{session('message')}}</span>
    @endif

    <div class="container mx-auto p-4 mt-4 w-[30%] shadow bg-gray-50 rounded-lg">
        <h3 class="font-bold text-2xl">Log In</h3>
        <form action="{{route('web.user.login.post')}}" method="post" class="flex flex-col gap-2">
            @csrf
            <div class="flex flex-col gap-1">

                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="someone@example.com" class="bg-white focus:outline-none focus:ring focus:ring-offset-gray-200 focus:ring-indigo-500 block w-full px-2 py-1 rounded-md @error('email') border-red-500 @enderror" required>
                @error('email') <p class="mt-2 text-sm text-red-500">{{$message}}</p> @enderror

                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="****" class="bg-white focus:outline-none focus:ring focus:ring-offset-gray-200 focus:ring-indigo-500 block w-full px-2 py-1 rounded-md @error('password') border-red-500 @enderror" required>
                @error('password') <p class="mt-2 text-sm text-red-500">{{$message}}</p> @enderror

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm font-medium text-gray-700">Remember Me</label>
                </div>

                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-all">Login</button>
            </div>
        </form>
        <a href="{{route('web.user.signup')}}" class="block text-sm font-medium text-gray-700 underline mt-4">Create an Account</a>
    </div>
</body>
</html>
