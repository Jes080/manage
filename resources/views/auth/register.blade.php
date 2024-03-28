@extends('layouts.app')
@section('register')
<div class="card mx-auto mt-3 border border-dark-subtle border-2 shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 50%">
    <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="mb-3 me-3 ms-3 mt-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
    </div>

        <!-- Email Address -->
    <div class="mb-3 me-3 ms-3 mt-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
    </div>

    <!-- Password -->
    <div class="mb-3 me-3 ms-3 mt-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" name="password" class="form-control" aria-describedby="passwordHelpBlock" required autocomplete="new-password">
        <div id="passwordHelpBlock" class="form-text">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
        </div>
    </div>

    <!-- Confirm Password -->
    <div class="mb-3 me-3 ms-3 mt-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary mb-3">Register</button>
    </div>
    </form>
</div>
@endsection

