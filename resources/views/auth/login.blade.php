@extends('plain_layout')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Login</h1>
            <p>Please login to use the app.</p>
            <form method="post" action="/auth/login">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="remember" id="remember"> Remember Me
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a class="btn btn-link" href="/auth/register">Register for a new account</a>
                    <a class="btn btn-link btn-danger" href="/password/email">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
@endsection