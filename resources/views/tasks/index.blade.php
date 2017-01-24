<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasklist</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <div class="row">
                <h1>Tasklist</h1>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Success:</strong>
                        {{Session::get('success')}}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <string>Error:</string>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                <form action="{{ route('tasks.store') }}" method="post">
                    {{csrf_field()}}

                    <div class="col-md-9">
                        <input type="text" name="new_task_name" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-primary btn-block" value="Add Task">
                    </div>
                </form>
            </div>
            @if(count($stored_tasks)>0)
                <table class="table" style="margin-top: 15px">
                    <tbody>
                        @foreach($stored_tasks as $stored_task)
                            <tr>
                                <th class="col-md-8">{{$stored_task->name}}</th>
                                <td class="col-md-2"><a href="{{route('tasks.edit', ['tasks' => $stored_task -> id])}}" class="btn btn-default">Edit</a></td>
                                <td>
                                    <form onclick = "return confirm('Are you sure you wish to delete this task?')" class="col-md-2" action="{{route('tasks.destroy', ['tasks'=>$stored_task->id])}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete Task" class="btn btn-danger ">
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="row text-center">
                {{ $stored_tasks->links() }}
            </div>
        </div>
    </div>
</body>
</html>