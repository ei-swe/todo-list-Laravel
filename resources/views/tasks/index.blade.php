@extends('layout')

@section('content')
<h1>Todo List</h1>

<!-- Add Task Form -->
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" name="title" class="form-control" placeholder="Task Title" required>
    </div>
    <div class="form-group">
        <textarea name="description" class="form-control" placeholder="Task Description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Task</button>
</form>

<!-- Task List -->
<ul class="list-group mt-3">
    @foreach($tasks as $task)
        <li class="list-group-item">
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : '' }} onChange="this.form.submit();">
                {{ $task->title }}
                <span class="float-right">
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </span>
            </form>
        </li>
    @endforeach
</ul>
@endsection
