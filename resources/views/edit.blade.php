<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View | To Do</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class='flex items-center justify-center'>
    <section class='w-fit p-4 my-4 rounded-md shadow bg-gray-50 flex flex-col gap-2'>
        <a href="{{route('web.task.index')}}" class='font-bold text-2xl p-2 bg-gray-200 rounded-md'><</a>
        <h3 class='font-bold text-2xl'>Edit Task</h3>
        <form action="{{route('web.task.update', ['task' => $old_task_data->id])}}" method="post" class='flex flex-col gap-2'>
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-1 ">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $old_task_data->title) }}" placeholder="Title" class='border-2 border-gray-200 w-full px-2 py-1 rounded-md focus:outline-none focus:border-0 focus:bg-gray-300'>
                @error('title') 
                    <span class='text-red-500'>{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class='p-2 rounded-md bg-green-500 text-white cursor-pointer hover:bg-green-600 transition-all'>Update</button>
        </form>
    </section>
</body>
</html>