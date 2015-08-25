<!DOCTYPE html>
<html>
<head>
    <title>TSNY Student Notes</title>

    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/sweetalert.css">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">TSNY Student Notes</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="/auth/register">Register</a></li>
            <li><a href="/auth/login">Login</a></li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>

@if(count($errors) > 0 )
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('content')

{{--<script src="/js/bootstrap.js"></script>--}}
<script src="/js/sweetalert.js"></script>

@if(session()->has('flash_message'))
<script>
    swal({
        title: "{{ session('flash_message.title') }}",
        text: "{{ session('flash_message.message') }}",
        type: "{{ session('flash_message.level') }}",
        confirmButtonText: "Cool",
    });
</script>
@endif

</body>
</html>
