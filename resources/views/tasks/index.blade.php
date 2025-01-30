@extends('layouts.app')

@section('content')
    <h1>Your Tasks</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->due_date->format('Y-m-d') }}</td>
                    <td>{{ $task->is_completed ? 'Completed' : 'Pending' }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-info">View</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
