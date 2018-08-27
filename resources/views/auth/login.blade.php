@extends('frontend.layout.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 ">
			<div class="box">
				<div class="box-heading">Login</div>

				<div class="box-body">
					<form class="form-horizontal" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
									<label for="username" class="col-md-8 control-label">Username</label>

									<div class="col-md-12">
										<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

										@if ($errors->has('username'))
										<span class="help-block">
											<strong>{{ $errors->first('username') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="password" class="col-md-8 control-label">Password</label>

									<div class="col-md-12">
										<input id="password" type="password" class="form-control" name="password" required>

										@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
										@endif
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box login-info-box">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-8 offset-md-2">
								<div class="row no-gutters">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<a class="btn btn-link" href="{{ route('user.create') }}">Register</a>
								<a class="btn btn-link" href="{{ route('password.request') }}">
									Forgot Password?
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
