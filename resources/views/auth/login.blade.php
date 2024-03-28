@extends('layouts.app')
@section('log')
<div class="card mx-auto mt-3 border border-dark-subtle border-2 shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 40%">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3 me-3 ms-3 mt-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
        </div>

        <!-- Password -->
        <div class="mb-3 me-3 ms-3 mt-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" aria-describedby="passwordHelpBlock" required autocomplete="current-password">
            <div id="passwordHelpBlock" class="form-text">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mb-3">Login</button>
        </div>
    </form>
</div>
@endsection
