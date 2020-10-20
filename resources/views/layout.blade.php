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
                @if(count($subtasks))
                    <th scope="col">Sub Tasks</th>
                @endif
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                @if(count($subtasks))
                    <td>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">description</th>
                                        <th scope="col">priority</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subtasks as $subtask)
                                        <tr>
                                            @if($subtask->main_task_id == $task->id)
                                                <td>{{ $subtask->name}}</td>
                                                <td>{{ $subtask->description}}</td>
                                                <td>{{ $subtask->priority}}</td>
                                                <td>
                                                    <form action="{{ route('delete_subtask') }}" >
                                                        <input type="hidden" name="subtask_id" value="{{ $subtask->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm font-sm">Delete task</button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                @endif
                <td>
                    <form action="{{ route('create_subtask') }}">
                        <div class="form-group">
                            <div class="col-1">
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <input type="text" name="subtask_name" placeholder="Sub task name">
                                <input type="text" name="subtask_desc" placeholder="Sub task desc">
                                <select name="subtask_priority" id="">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary font-xs text-nowrap">Create sub task</button>
                            </div>

                        </div>
                    </form>
                </td>
                <td>
                    <form action="{{ route('delete') }}" >
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <button type="submit" class="btn btn-danger font-sm">Delete task</button>
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
