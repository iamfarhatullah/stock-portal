@extends('layouts.main')
@section('title', 'Profile')
@section('content')

@section('content')

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-wrapper">
						<div class="row"><br>
							<div class="col-md-3 col-sm-4">
								<center>
									<br>
									<img src="https://cdn-icons-png.flaticon.com/512/3364/3364044.png" class="img-circle img-responsive" width="120px" height="120px">
								</center>
							</div>
							<div class="col-md-9 col-sm-8">
								<h3 class="profile-name" style="color: black">{{ Auth::user()->name }}</h3>
								<p>Admin</p>
								<br>
								<span class="profile-data"><i class="far fa-envelope-open"></i> {{ Auth::user()->email }}</span><br><br>
								<span class="profile-data">Created on: {{ Auth::user()->created_at->format('F j, Y') }}</span><br><br>
								<br>
								<a href="{{ route('profile.edit') }}" class="primary-btn">Edit profile</a>
							</div>
						</div><br>
						<br>
					</div>
				</div>
			</div>


<!-- <div class="container mx-auto py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
        Profile Information
        <h1 class="text-2xl font-bold mb-4">Profile Information</h1>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Name</label>
            <p id="name" class="mt-1 text-gray-900">{{ Auth::user()->name }}</p>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium">Email</label>
            <p id="email" class="mt-1 text-gray-900">{{ Auth::user()->email }}</p>
        </div>

        <div class="mb-4">
            <label for="created_at" class="block text-gray-700 font-medium">Account Created</label>
            <p id="created_at" class="mt-1 text-gray-900">{{ Auth::user()->created_at->format('F j, Y') }}</p>
        </div>

        Edit Profile Button
        <div class="mt-6 flex justify-end">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                Edit Profile
            </a>
        </div>
    </div>
</div> -->
@endsection
