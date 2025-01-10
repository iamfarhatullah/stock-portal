
@extends('layouts.guest')
@section('title', 'Login')
@section('content')

@if ($errors->has('email'))
    <div class="alert alert-danger">
        {{ $errors->first('email') }}
    </div>
@endif

<h3 class="form-title">Reset Password</h3>
<form method="POST" action="{{ route('password.store') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <label for="email">Email *</label>
    <input id="email" class="form-field" type="email" name="email" value="{{old('email', $request->email)}}" required/>
    
    <label for="password1">New Password *</label>
    <input id="password1" class="form-field" type="password" name="password" placeholder="Enter new password" required/>
    
    <label for="password_confirmation">Confirm Password *</label>
    <input id="password_confirmation" class="form-field" type="password" name="password_confirmation" placeholder="Confirm new password" required/>
    <br><br>
    <button class="primary-btn"> {{ __('Reset Password') }} </button>
</form>
@endsection