<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit | Users</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class='flex items-center justify-center'>
    <section class='w-fit p-4 my-4 rounded-md shadow bg-gray-50 flex flex-col gap-2'>
        <a href="{{route('web.task.index')}}" class='font-bold text-2xl p-2 bg-gray-200 rounded-md'><</a>
        <h3 class='font-bold text-2xl'>Edit User</h3>
        <form action="{{route('web.user.update', ['user' => $user->id])}}" method="post" class='flex flex-col gap-2'>
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-1 ">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{old('name', $user->name)}}"                    
                    class="bg-white focus:outline-none focus:ring focus:ring-offset-gray-200 focus:ring-indigo-500 block w-full px-2 py-1 rounded-md"
                    placeholder="Name"
                    required
                >
            </div>

            <div class="flex flex-col gap-1 ">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{old('email', $user->email)}}"
                    class="bg-white focus:outline-none focus:ring focus:ring-offset-gray-200 focus:ring-indigo-500 block w-full px-2 py-1 rounded-md"
                    placeholder="Email"
                    required
                >

            <button type="submit" class='p-2 rounded-md bg-green-500 text-white cursor-pointer hover:bg-green-600 transition-all'>Update</button>
        </form>
    </section>
</body>
</html>