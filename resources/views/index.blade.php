<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if(session('message'))
        <span class='block text-center text-sm text-white bg-blue-500 rounded-xl py-2 px-4 w-fit mx-auto my-6 transition-all'>{{session('message')}}</span>
    @endif

    <section class='w-fit p-4 m-auto my-4 rounded-md shadow bg-gray-50'>
        <div class='flex items-center justify-between pb-4'>
            <h1 class='font-bold text-3xl  pl-2'>All Tasks</h1>
            <form action="{{route('web.user.logout')}}" method="post" class='flex items-center'>
                @csrf
                <button id='logoutBtn' class='px-2 bg-gray-200 rounded-md cursor-pointer hover:bg-red-500 transition-all' type="submit"><</button>
            </form>
        </div>

        <a href="{{route('web.user.show', ['user' => auth()->user()->id])}}" class='bg-gray-200 rounded-md px-4 py-1 w-full block my-4 hover:bg-gray-300 transition-all'>{{auth()->user()->name}} ({{auth()->user()->email}})</a>
    
        <ul class='flex flex-col gap-2  w-full'>
            @if($task->isEmpty() || $task->where('completed', false)->count() == 0)
                <span class='text-center text-md font-semibold text-black rounded-xl py-1 px-2'>Chill !</span>
            @endif
            @foreach($task as $item)
                <a href="{{route('web.task.show', ['task' => $item->id])}}" class='flex justify-between items-center gap-2 rounded-md bg-gray-200 px-4 py-2 hover:bg-gray-300 transition-all'>
                    <div class='flex items-center gap-2'>
                        <form action="{{route('web.task.toggle', ['id' => $item->id])}}" method="GET" class='flex items-center'>
                            <button class='p-2 rounded {{$item->completed == true ? 'bg-green-500' : 'bg-orange-500'}}' type="submit"></button>
                        </form>
                        <span >{{$item->title}}</span>
                    </div>

                    <form action="{{route('web.task.destroy', ['task' => $item->id])}}" method="POST" class='flex items-center'>
                        @csrf
                        @method('DELETE')
                        <button class='p-2 rounded border-2 border-red-500 hover:bg-red-500 transition-all cursor-pointer' type="submit"></button>
                    </form>
                </a>
            @endforeach
        </ul>

        <form action="{{route('web.task.store')}}" method="post" class='rounded-md shadow flex items-center gap-2 mt-4 bg-gray-200 px-4 py-2'>
            @csrf
            <input type="text" name="title" id="title" placeholder="Title" required class='w-full px-2 py-1 rounded-md focus:outline-none focus:border-0 focus:bg-gray-300'>
            <button type="submit" id='newTaskBtn' class='p-2 rounded-md bg-blue-500 text-white'></button>
        </form>
    </section>
    <script>
        // FOCUS IN INPUT
        const inputFiled = document.getElementById('title');
        inputFiled.focus();

        // ALERT ON LOGOUT
        const logoutBtn = document.getElementById('logoutBtn');
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            let sure = confirm('Are you sure want to Logout?');
            if (!sure) return;
            logoutBtn.closest('form').submit();
        });

        // LOCK INPUT ON ONE ENTRY 
        const newTaskBtn = document.getElementById('newTaskBtn');
        newTaskBtn.addEventListener('click', (e) => {
            e.preventDefault();
            newTaskBtn.disabled = true;
            newTaskBtn.closest('form').submit();
        });

    </script>
</body>
</html>