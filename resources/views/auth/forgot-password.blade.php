
@extends('layouts.guest')
@section('title', 'Login')
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($errors->has('email'))
    <div class="alert alert-danger">
        {{ $errors->first('email') }}
    </div>
@endif


<h3 class="form-title">Forgot Password?</h3>
<p>No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label for="email">Email *</label>
    <input id="email" class="form-field" type="email" name="email" :value="old('email')" placeholder="Enter your email" autofocus />
    <br><br>
    <button class="primary-btn"> {{ __('Submit') }} </button>
    </form>
@endsection