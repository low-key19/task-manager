@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $task->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" required>{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" class="form-control" id="due_date" value="{{ $task->due_date->format('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <input type="checkbox" name="is_completed" {{ $task->is_completed ? 'checked' : '' }}>
            <label for="is_completed">Completed</label>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
@endsection
