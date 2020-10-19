<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Task Manager</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <a class="navbar-brand" href="{{ route('home') }}">Task Manager</a>
</nav>

<div class="container">
    <div class="row mt-3 mb-3">
        <div class="col-md-12">

            @yield('content')

        </div><!-- ./col-md-12-->

    </div><!-- ./row-->

</div><!-- ./container-->


</body>
</html>
