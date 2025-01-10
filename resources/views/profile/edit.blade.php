
@extends('layouts.main')
@section('title', 'Edit Profile')
@section('content')

@section('content')

<div class="row">
    <div class="col-md-9">
        <div class="form-wrapper">
            <h3 class="form-title">Edit Profile</h3><br>
            <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <label>Name *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input id="name" type="text" class="form-field" name="name" value="{{ old('name', Auth::user()->name) }}" autofocus>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <label>Email *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input id="email" type="email" class="form-field" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
						<div class="pull-right">
							<button type="submit" class="success-btn">Update Profile</button><br><br>
						</div>
					</div>
				</div>
            </form>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-9">
        <div class="form-wrapper">
            <h3 class="form-title">Change Password</h3><br>
            <form action="{{ $action ?? route('password.update') }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <label>Current Password *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input class="form-field" name="current_password" type="password" placeholder="Enter current password"/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <label>New Password *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input class="form-field" name="password" type="password" placeholder="Enter new password"/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <label>Confirm Password *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input class="form-field" name="password_confirmation" type="password" placeholder="Re-enter new password"/>
                    </div>
                </div>
                <br>
                
                <hr>
                <div class="row">
                    <div class="col-md-3 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
						<div class="pull-right">
							<button type="submit" class="success-btn">Update Password</button><br><br>
						</div>
					</div>
				</div>
            </form>
        </div>
    </div>
</div>


@endsection
