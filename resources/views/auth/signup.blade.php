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

    <div class="container mx-auto p-4 mt-4 w-[30%] shadow bg-gray-50 rounded-lg">
        <h3 class="font-bold text-2xl">Sign Up</h3>
        <form action="{{route('web.user.signup.post')}}" method="post" class="flex flex-col gap-2">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="shadow-sm focus:outline-none focus:ring focus:ring-offset-gray-200 focus:ring-indigo-500 block w-full px-2 py-1 rounded-md @error('name') border-red-500 @enderror" required>
                @error('name') <p class="mt-2 text-sm text-red-500">{{$message}}</p> @enderror

                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="shadow-sm focus:outline-none focus:ring focus:ring-offset-gray-200 focus:ring-indigo-500 block w-full px-2 py-1 rounded-md @error('email') border-red-500 @enderror" required>
                @error('email') <p class="mt-2 text-sm text-red-500">{{$message}}</p> @enderror


                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm focus:outline-none focus:ring focus:ring-offset-gray-200 focus:ring-indigo-500 block w-full px-2 py-1 rounded-md @error('password') border-red-500 @enderror" required>
                @error('password') <p class="mt-2 text-sm text-red-500">{{$message}}</p> @enderror


                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="shadow-sm focus:outline-none focus:ring focus:ring-offset-gray-200 focus:ring-indigo-500 block w-full px-2 py-1 rounded-md">

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm font-medium text-gray-700">Remember Me</label>
                </div>

                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-all">Create Account</button>
            </div>
        </form>
        <a href="{{route('web.user.login')}}" class="block text-sm font-medium text-gray-700 underline mt-4">Login Instead</a>
    </div>
</body>
</html>
