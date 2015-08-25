@extends('plain_layout')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Register</h2>
            <p>Please register for an account. You will need a special registration code to create your account.</p>
            <form method="POST" action="/auth/register">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                </div>

                <div class="form-group">
                    <label for="code">Registration Code:</label>
                    <p>Check the Facebook group or an email for the confirmation code.</p>
                    <input type="text" class="form-control" name="registration_code" id="registration_code" required>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection