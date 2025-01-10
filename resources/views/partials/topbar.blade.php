<nav class="navbar" id="main-nav">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" id="sidebarCollapse" class="navbar-btn">
						<i class="glyphicon glyphicon-tasks"></i>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right main-ul">
						<form id="logout-form" method="POST" action="{{ route('logout') }}">
							@csrf
							<button type="submit">Logout <i class="fa fa-sign-out-alt"></i></button>
						</form>
						<a href="">
						<!-- <img src="https://abnauk.com/wp-content/uploads/2024/01/law.png" class="img-circle img-responsive" width="56px" height="56px"> -->
						</a>
					</ul>
				</div>
			</div>
		</nav>
