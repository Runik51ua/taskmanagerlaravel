@extends('index')

@section('content')
    <form action="{{ route('create') }}">
        <div class="form-row ">
            <div class="form-group col-md-6">
                <input type="text" placeholder="Task name" id="c" name="task_name">
                <input type="text" placeholder="Task description" id="c" name="task_desc">
                <button type="submit" class="btn btn-primary">Create task</button>
            </div>
        </div>
    </form>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(count($tasks))
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">description</th>
                <th scope="col">Time</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->created_at }}</td>
                <td>
                    <form action="{{ route('delete') }}" >
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <button type="submit" class="btn btn-danger">Delete task</button>
                    </form>
                    <form action="{{ route('edit') }}">
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <button type="submit" class="btn btn-warning">Edit task</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
        {{ $tasks->links() }}
    @endif
@endsection
