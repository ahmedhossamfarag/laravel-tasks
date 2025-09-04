@extends('layouts.main')
@section('title')
    Tasks
@endsection

@section('content')
    <div class="container pt-3">
        <a href="{{ route('tasks.create') }}">Create Task</a>
        <hr>
        @unless ($tasks->isEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr class="{{ $task->status == 'pending' ? 'table-primary' : 'table-success' }}">
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->created_at->format('Y-m-d') }}</td>
                            <td>{{ $task->status == 'pending' ? 'Pending' : 'Completed' }}</td>
                            <td><a href="{{ route('tasks.show', $task->id) }}">Show</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tasks found.</p>
        @endif
    </div>
@endsection
