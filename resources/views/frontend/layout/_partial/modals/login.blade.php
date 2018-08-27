<a class="header-user-message-notif header-user-button" data-toggle="modal" data-target="#loginModal" style="cursor: pointer;"><span class="fas fa-sign-in-alt"></span></a>


@section('modals')
<!-- Modal -->
<div id="loginModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">

			<div class="container">
				<div class="row">
					<div class="col-md-12 login-modal">
						
						<div class="box-heading"><h1 class="center">Login</h1></div>

						<div class="box-body">
							<form class="form-horizontal" method="POST" action="{{ route('login') }}">
								{{ csrf_field() }}
								<div class="row">
									@if (isset($errors))

									<div class="col-md-6 ">
										<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
											<label for="username" class="control-label">Username</label>

											<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

											@if ($errors->has('username'))
											<span class="help-block">
												<strong>{{ $errors->first('username') }}</strong>
											</span>
											@endif
										</div>

										<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
											<label for="password" class="control-label">Password</label>

											<input id="password" type="password" class="form-control" name="password" required>

											@if ($errors->has('password'))
											<span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
											@endif
										</div>

									</div>
									@else

									<div class="col-md-6">

										<div class="form-group">
											<label for="username" class="control-label">Username</label>
											<input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
										</div>

										<div class="form-group">
											<label for="password" class="control-label">Password</label>
											<input id="password" type="password" class="form-control" name="password" required>
										</div>
									</div>
									
									@endif
									<div class="col-md-6">
										<div class="box login-info-box">
											@isset ($startUpNewsDisplay->text)
											{!! $startUpNewsDisplay->text !!}
											@endif
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
	</div>
</div>

@append

@section('scripts')



@endsection