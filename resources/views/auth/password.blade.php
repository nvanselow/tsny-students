@extends('plain_layout')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            @if(isset($status))
                {{ $status }}
            @endif

            <h1>Forgot password?</h1>
            <p>Enter your email below and we can send a link to reset your password.</p>

            <form method="POST" action="/password/email">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        Send Password Reset Link
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection