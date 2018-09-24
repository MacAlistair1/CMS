@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
            <h1>Welcome to Sub<sup>TM</sup></h1>

            <p>This is Home Page.</p>
    <p>
        <a class="btn btn-primary btn lg" href="/login" role="button">Login</a>
        <a class="btn btn-success btn lg" href="/register" role="button">Register</a>
    </p>
    <img src="{{ asset('img/bootstrap-themes.png') }}" height=200px alt="Theme">
    </div>
@endsection