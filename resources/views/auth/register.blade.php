@extends('layouts.auth')

@section('title', 'Register')
@section('subtitle', 'Have an account?')
@section('button', 'Login')
@section('link', 'login')
@section('content')
    <form action="/register" method="POST" class="signin-form">
        @csrf
        <div class="form-group mb-3">
            <label class="label" for="name">Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group mb-3">
            <label class="label" for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary submit px-3">Register</button>
        </div>
    </form>
@endsection
