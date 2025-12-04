<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Information | To Do</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class='flex items-center justify-center'>
    <section class='w-fit p-4 my-4 rounded-md shadow bg-gray-50 flex flex-col gap-2'>
        <a href="{{route('web.task.index')}}" class='font-bold text-2xl p-2 bg-gray-200 rounded-md'><</a>
        <h3 class='font-bold text-2xl'>{{$user->name}}</h3>
        <p>Email: {{$user->email}}</p>
        
        <p>Created At: {{$user->created_at->format('d-m-Y h:i A')}}</p>
        <p>Updated At: {{$user->updated_at->format('d-m-Y h:i A')}}</p>
        <div class='flex gap-2 items-center'>
            {{-- <a href="{{route('web.user.toggle', ['id'=>$info->id])}}" class='rounded border-2 border-blue-500 px-3  py-1  hover:bg-blue-500 hover:text-white transition-all'>{{$task->completed == true ? 'UnTick' : 'Tick'}}</a> --}}
            <a href="{{route('web.user.edit', ['user'=>$user->id])}}" class='rounded border-2 border-gray-400 px-3  py-1  hover:bg-gray-400 hover:text-white transition-all'>Edit</a>
            <form action="{{route('web.user.logout')}}" method="post" class='flex items-center'>
                @csrf
                <button type="submit" class='rounded border-2 text-red-500 border-red-500 px-3  py-1  pointer hover:bg-red-500 hover:text-white transition-all'>Logout</button>
            </form>
        </div>
    </section>
</body>
</html>