@extends('layouts.main')
@section('title')
    Tasks
@endsection

@section('content')
    <div class="container pt-3">
        <form class="form-inline" action="{{ route('tasks.index') }}">
            <input class="form-control flex-grow-1" name="query" placeholder="search ..." aria-label="Search" value="{{ $query }}">
            <select class="form-control mx-lg-2 my-2" name="status">
                <option value="all" @selected($status == 'all')>All</option>
                <option value="pending" @selected($status == 'pending')>Pending</option>
                <option value="completed" @selected($status == 'completed')>Completed</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <hr />
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
            <div class="d-flex justify-content-center mt-4">
                {{ $tasks->links() }}
            </div>
        @else
            <p>No tasks found.</p>
        @endif
    </div>
@endsection
