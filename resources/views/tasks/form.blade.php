@extends('layouts.main')
@section('title')
    Task Form
@endsection

@section('content')
    <div class="container pt-3">
        <form method="POST" action="{{ $task->id ? route('tasks.update', $task->id) : route('tasks.store') }}">
            @csrf
            @if ($task->id)
                @method('PUT')
                <h3>Edit Task</h3>
            @else
                <h3>Create Task</h3>
            @endif
            <div class="form-group">
                <label for="title">Name:</label>
                <input type="text" class="form-control" id="title" placeholder="Name" name="title" required value="{{ $task->id? $task->title : old('title') }}">
                @error('title')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" placeholder="Description" name="description" required>{{ $task->id? $task->description : old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Select list:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" @selected($task->status ? $task->status == 'pending' : old('status') == 'pending')>Pending</option>
                    <option value="completed" @selected($task->status ? $task->status == 'completed' : old('status') == 'completed')>Completed</option>
                </select>
                @error('status')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
