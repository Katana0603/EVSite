@extends('frontend.layout.app')

@section('title')

Create User
@endsection

@section('content')
<div class="box">
	{{ Form::open(array('route' => 'user.store', 'files' => true, 'class' => 'form-horizontal')) }}
	{{ csrf_field() }}

	<div class="form-group">

		{{-- User Data --}}
		<div class="col-xs-8">

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="col-sm-4">
					<label for="username">{{ __('template.user.username') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="username" name="username" class="form-control" id="username"  value="">

					@if ($errors->has('username'))
					<span class="help-block">
						<strong>{{ $errors->first('username') }}</strong>
					</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="col-sm-4">
					<label for="password" ">Password</label>
				</div>
				<div class="col-md-8">
					<input id="password" type="password" class="form-control" name="password" >

					@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-4">
					<label for="password-confirm" >Confirm Password</label>
				</div>
				<div class="col-md-8 ">
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
					@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="col-sm-4">
					<label for="email">{{ __('template.user.email') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="email" name="email" class="form-control" id="email"  value="">
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="firstname">{{ __('template.user.firstname') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="firstname" class="form-control" id="firstname"  value="">
					@if ($errors->has('firstname'))
					<span class="help-block">
						<strong>{{ $errors->first('firstname') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="lastname">{{ __('template.user.lastname') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="lastname" class="form-control" id="lastname"  value="">
					@if ($errors->has('lastname'))
					<span class="help-block">
						<strong>{{ $errors->first('lastname') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-4">
					<label for="clan">{{ __('template.user.clan') }}</label>
				</div>
				<div class="col-sm-8">

					<div class="input-group">

						<select class="form-control select2" name="clan">
							<option selected value=""></option>
							@foreach ($clans as $clan)
							<option value="{{ $clan->id }}" >{{ $clan->name }}</option>
							@endforeach
						</select>

						<span class="input-group-addon addClan-btn">
							<a class="" data-toggle="modal" data-target="#clanModal" style="cursor: pointer;"><span class="fa fa-plus"></span></a>
						</span>
					</div>
				</div>
			</div>
		</div>
		{{-- User Pic --}}

		<div class="col-xs-4">
			<div class="form-group">
				<div class="col-sm-12">
					<label for="avatar" class=" control-label">Avatar</label>
					<input type="file" accept="image/*" onchange="preview_image(event)" name="avatar">
					<img id="output_image" name="avatarImg" class="avatarPreview" />
				</div>
			</div>
		</div>

	</div>
	<br>
	<div class="row">
		<div class="col-sm-5">

			<div class="form-group">
				<div class="col-sm-4  col-xs-5">
					<label for="birthdate">{{ __('template.user.birthdate') }}</label>
				</div>
				<div class="col-sm-8  col-xs-7">
					<input type="date" class="form-control"  data-name="birthdate"  name="birthdate"
					value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4  col-xs-5">
					<label for="gender">{{ __('template.user.gender') }}</label>
				</div>
				<div class="col-sm-8 col-xs-7">
					<select class="form-control select2" name="gender">
						<option selected value=""></option>
						@foreach ($genders as $gender)
						<option value="{{ $gender->id }}"> {{ $gender->value }}</option>
						@endforeach
					</select>
				</div>
			</div> 
			<div class="form-group">
				<div class="col-sm-4">
					<label for="phone">{{ __('template.user.phone') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="phone" class="form-control" id="phone"  value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="handy">{{ __('template.user.handy') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="handy" class="form-control" id="handy"  value="">
				</div>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="form-group">
				<div class="col-sm-4">
					<label for="street">{{ __('template.user.street') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="street" class="form-control" id="street"  value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="zip">{{ __('template.user.zip') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="zip" class="form-control" id="zip"  value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="city">{{ __('template.user.city') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="city" class="form-control" id="city"  value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="country">{{ __('template.user.country') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="country" class="form-control" id="country"  value="">
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-4">
			<label for="signature">{{ __('template.user.signature') }}</label>
		</div>
		<div class="col-sm-12"> 
			<textarea class="form-control richTextBox" data-name="signature"  name="signature" id="signature" >

			</textarea> 
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-block btn-success"><span class="fa fa-plus"></span></button>

		</form>

	</div>
</div>
</form>
@endsection

@section('modals')
<!-- Modal -->
<div id="clanModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 login-modal">
						
						<div class="panel-heading"><h2 class="center">Create Clan</h2></div>

						<div class="box-body">

							{{ Form::open(array('route' => 'store.clan', 'files' => true, 'class' => 'form-horizontal')) }}
							{{ csrf_field() }}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Clan - Name</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

									@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
								<label for="website" class="col-md-4 control-label">Clan - Website</label>

								<div class="col-md-6">
									<input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}">

									@if ($errors->has('website'))
									<span class="help-block">
										<strong>{{ $errors->first('website') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="form-group">

								<label for="avatar" class="col-md-4 control-label">Avatar</label>
								<div class="col-md-6">
									<input type="file" accept="image/*" onchange="preview_image2(event)" name="avatar">
									<img id="output_image2" name="avatarImg" class="avatarPreview" />
								</div>
							</div>
							<div class="col-md-6 col-md-offset-3" >

								{{ Form::submit('Store Clan', array('class' => 'btn btn-success btn-lg')) }}
								{{ Form::close() }}
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

<script type='text/javascript'>
	function preview_image(event) 
	{
		var reader = new FileReader();
		reader.onload = function()
		{
			var output = document.getElementById('output_image');
			output.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);
	}
</script>
<script type='text/javascript'>
	function preview_image2(event) 
	{
		var reader = new FileReader();
		reader.onload = function()
		{
			var output = document.getElementById('output_image2');
			output.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);
	}
</script>
@append