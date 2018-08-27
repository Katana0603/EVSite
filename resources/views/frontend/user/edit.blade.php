@extends('frontend.layout.app')

@section('title')

{{ $user->username }}
@endsection

@section('content')


<div class="box">


	<h1 class="center">Edit {{ $user->username }}</h1>

	{{ Form::open(array('route' => ['user.update',$user->id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal')) }}
	{{ csrf_field() }}

	<div class="form-group">

		{{-- User Data --}}
		<div class="col-xs-8">

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="col-sm-4">
					<label for="username">{{ __('template.user.username') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="username" name="username" class="form-control" id="username"  value="{{ $user->username }}" readonly>

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
					<input type="email" name="email" class="form-control" id="email"  value="{{ $user->email }}">
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
					<input type="text" name="firstname" class="form-control" id="firstname"  value="{{ $user->firstname }}">
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
					<input type="text" name="lastname" class="form-control" id="lastname"  value="{{ $user->name }}">
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
							@if ($user->clan_id)
							<option selected value="{{ $user->clan_id }}">{{ $user->clan->name }}</option>
							@else
							<option selected value=""></option>
							@endif
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
					<img id="output_image" name="avatarImg" class="avatarPreview" src="{{ asset('storage/media/'.$user->avatar) }}" alt="User Avatar not found" />
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
					value="{{ $user->birthdate }}" id="datetimepicker">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4  col-xs-5">
					<label for="gender">{{ __('template.user.gender') }}</label>
				</div>
				<div class="col-sm-8 col-xs-7">
					<select class="form-control select2" name="gender">
						@if ($user->gender_id)
						<option selected value="{{ $user->gender_id }}">{{ $user->gender->value }}</option>
						@else
						<option selected value=""></option>
						@endif
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
					<input type="text" name="phone" class="form-control" id="phone"  value="{{ $user->phone }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="handy">{{ __('template.user.handy') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="handy" class="form-control" id="handy"  value="{{ $user->handy }}">
				</div>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="form-group">
				<div class="col-sm-4">
					<label for="street">{{ __('template.user.street') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="street" class="form-control" id="street"  value="{{ $user->street }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="zip">{{ __('template.user.zip') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="zip" class="form-control" id="zip"  value="{{ $user->zip }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="city">{{ __('template.user.city') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="city" class="form-control" id="city"  value="{{ $user->city }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					<label for="country">{{ __('template.user.country') }}</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="country" class="form-control" id="country"  value="{{ $user->country }}">
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
				{{{ $user->signature }}}
			</textarea> 
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-sm btn-success"><span class="fa fa-plus"></span></button>

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


@section('scripts')




<script src="{{ asset('js/admin/datetimepicker.js')}}"></script>

<script>

	jQuery.datetimepicker.setLocale('de');

	jQuery('#datetimepicker').datetimepicker({
		i18n:{
			de:{
				months:[
				'Januar','Februar','März','April',
				'Mai','Juni','Juli','August',
				'September','Oktober','November','Dezember',
				],
				dayOfWeek:[
				"So.", "Mo", "Di", "Mi", 
				"Do", "Fr", "Sa.",
				]
			}
		},
		step:30,
		weeks:true,
		format:'d.m.Y H:i'
	});
</script>
@append


@section('css')


<link rel="stylesheet" type="text/css" href="{{ asset('css/datetimepicker.css')}}"/>
@append