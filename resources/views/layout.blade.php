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
                <th scope="col">Sub Tasks</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                    <td>
                        <div class="table-responsive">
                            <table class="current" data-id="{{ $task->id }}">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">description</th>
                                        <th scope="col"></th>

                                    </tr>
                                </thead>
                                <tbody data-id="{{ $task->id }}" class="position">
                                    @foreach($task->subtask as $stask)
                                        <tr data-id="{{ $stask->id }}" class="subtask">
                                                <td>{{ $stask->id}}</td>
                                                <td>{{ $stask->name}}</td>
                                                <td>{{ $stask->description}}</td>
                                                <td>
                                                    <form action="{{ route('delete_subtask') }}" >
                                                        <input type="hidden" name="subtask_id" value="{{ $stask->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm font-sm">Delete task</button>
                                                    </form>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                <td>
                    <form action="{{ route('create_subtask') }}">
                        <div class="form-group">
                            <div class="col-1">
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <input type="text" name="subtask_name" placeholder="Sub task name">
                                <input type="text" name="subtask_desc" placeholder="Sub task desc">
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
    @endif
    <script>
        $(document).ready(function(){

            function updateOrder($mainId){
                var items = $mainId.sortable('toArray', {attribute: 'data-id'})
                $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});

                $.ajax({
                    url:'{{url('update-order')}}',
                    method:'POST',
                    data:{
                        ids:items,
                        task_id: $mainId.data('id')
                    },
                    success:function(){
                        return;
                    }
                })
            }

            var target = $('.position');

            target.sortable({
                axis: "y",
                stop: function (event, ui){
                    var sortData = target.sortable('toArray',{ attribute: 'data-id'})
                    updateOrder($(event.target))
                    // updateOrder(sortData.join(','))
                }
            })

        })
    </script>
@endsection
