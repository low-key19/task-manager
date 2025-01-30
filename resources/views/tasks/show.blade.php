@extends('layouts.app')

@section('content')
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <p>Due Date: {{ $task->due_date->format('Y-m-d') }}</p>
    <p>Status: {{ $task->is_completed ? 'Completed' : 'Pending' }}</p>
@endsection
