<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="login-page container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
                <!-- <div>
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif
                </div> -->

                @yield('content')
					<!-- <h3 class="form-title">Login Here</h3><br>
					<form action="verifyUser.php" method="post">
						<label>Username</label>
						<input type="text" class="form-field" name="username" placeholder="Username" required><br><br>
						<label>Password</label>
						<input type="password" class="form-field" name="password" placeholder="Enter password" required><br>
						<hr>
						<input type="submit" name="login" class="success-btn" value="Login">
						<a id="myBtn" class="forgot-link">Forgot password</a><hr>
					</form> -->
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
