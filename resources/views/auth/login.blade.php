
@extends('layouts.guest')
@section('title', 'Login')
@section('content')

@if ($errors->has('email'))
    <div class="alert alert-danger">
        {{ $errors->first('email') }}
    </div>
@endif

<h3 class="form-title">Login Here</h3>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <label for="email">Email *</label>
    <input id="email" class="form-field" type="email" name="email" value="{{old('email')}}"  required placeholder="Enter email"/>
    <br><br>
    <label for="password1">Password *</label>
    <input id="password1" class="form-field" type="password" name="password" required placeholder="Enter password"/>
    <br>
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" name="remember">
        <span class="">{{ __('Keep me logged in') }}</span>
    </label>

    <br><br>
    @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
    @endif
    <button class="primary-btn pull-right"> {{ __('Log in') }} </button>
</form>
@endsection


