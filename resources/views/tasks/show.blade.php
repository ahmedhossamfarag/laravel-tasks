@extends('layouts.main')
@section('title')
    Task Details
@endsection

@section('content')
    <div class="container">
        <h2>Task Details</h2>
        <hr />
        <div>
            <h4>Title</h4>
            <p>{{ $task->title }}</p>
        </div>
        <div>
            <h4>Description</h4>
            <p>{{ $task->description }}</p>
        </div>
        <div>
            <h4>Created At</h4>
            <p>{{ $task->created_at }}</p>
        </div>
        <div>
            <h4>Status</h4>
            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <select name="status" class="form-control">
                    <option value="pending" @selected($task->status == 'pending')>Pending</option>
                    <option value="completed" @selected($task->status == 'completed')>Completed</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Update Status</button>
            </form>
        </div>
        <div class="mt-4">
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
            <div class="modal" id="deleteModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Task</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this task?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="mt-4">
            <a href="{{ route('tasks.index') }}">Back to Tasks</a>
        </div>
    </div>
@endsection
