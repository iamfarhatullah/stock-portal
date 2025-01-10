
@extends('layouts.guest')
@section('title', 'Login')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<h3 class="form-title">Create new account</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Name *</label>
        <input id="name" class="form-field" type="text" name="name" value="{{old('name')}}" autofocus autocomplete="name"  placeholder="Enter name"/>

        <label for="email">Email *</label>
        <input id="email" class="form-field" type="email" name="email" value="{{old('email')}}" autocomplete="username"  placeholder="Enter email"/>

        <label for="password1">Password *</label>
        <input id="password1" class="form-field" type="password" name="password" placeholder="Enter password"/>
        
        <label for="password_confirmation">Confirm Password *</label>
        <input id="password_confirmation" class="form-field" type="password" name="password_confirmation" placeholder="Confirm password"/>
        <br><br>
        <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
        <button class="primary-btn pull-right">{{ __('Register') }}</button>
    </form>
@endsection
