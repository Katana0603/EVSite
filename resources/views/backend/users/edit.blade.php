{{-- create.blade.php --}}


@extends('backend.layout.app')

@section('title', '| Add User')

@section('content')

<div class='col-sm-12'>

	<h1><i class='fa fa-user-plus'></i> Edit User {{ $user->username }}</h1>
	<hr>
	{{ Form::open(array('route' => ['users.update',$user->id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal')) }}
	
	{{ csrf_field() }}
	{{-- Username --}}
	<div class="form-group">
		{{ Form::label('username', 'Username') }}
		{{ Form::label('username', $user->username, array('class' => 'form-control')) }}
	</div>
	{{-- Clan --}}
	<div class="form-group">
		<label>Clan</label>

		<select class="form-control select2" style="width: 100%;" name="clan_id">
			@if ($user->clan_id > 0)
			<option value="{{ $user->clan_id }}"> {{ $user->clan->name }} </option>
			@else
			<option disabled selected value> -- select an option -- </option>
			@endif
			@forelse ($clans as $clan)
			<option value="{{ $clan->id }}">{{ $clan->name }}</option>
			@endforeach 
		</select>
	</div>
	{{-- Email --}}
	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::text('email',  $user->email, array('class' => 'form-control')) }}
	</div>
	{{-- Password --}}
	<div class="form-group">
		{{ Form::label('userPassword', 'Password') }}<br>
		{{ Form::password('userPassword', array('class' => 'form-control')) }}

	</div>
	{{-- First/LastName --}}
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				{{ Form::label('firstname', 'Firstname') }}
				{{ Form::text('firstname', $user->firstname, array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('lastname', 'Lastname') }}
				{{ Form::text('lastname', $user->name, array('class' => 'form-control')) }}
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-sm-6">
			{{-- Avatar --}}
			<div class="form-group">
				<label for="avatar" class=" control-label">Avatar</label>
				<input type="file" accept="image/*" onchange="preview_image(event)" name="avatar">
				<img id="output_image" name="avatarImg" class="avatarPreview" src="{{ asset('storage/media/'.$user->avatar) }}" alt="User Avatar not found" />
			</div>
		</div>
		{{-- Birthdate --}}
		<div class="col-sm-6 ">
			<div class="form-group">

				{{ Form::label('birthDate', 'Birthdate') }}
				<input id="datetimepicker" type="text"  class="form-control" value="{{ date("d.m.Y",strtotime($user->birthdate))}}">
			</div>
		</div>

		<div class="col-sm-6 ">
			{{-- gender --}}
			<div class="form-group">
				<label>Gender</label>
				<select class="form-control select2" style="width: 100%;" name="gender">
					@if ($user->gender_id > 0)
					<option value="{{ $user->gender->id }}"> {{ $user->gender->value }} </option>
					@else
					<option disabled selected value> -- select an option -- </option>
					@endif
					@forelse ($genders as $gender)
					<option value="{{ $gender->id }}">{{ $gender->value }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		{{-- street --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('street', 'Street') }}
				{{ Form::text('street',  $user->street, array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Zip --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('zip', 'Zip') }}
				{{ Form::text('zip',  $user->zip, array('class' => 'form-control')) }}
			</div>
		</div>
	</div>
	<div class="row">
		{{-- City --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('city', 'City') }}
				{{ Form::text('city',  $user->city, array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Country --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('country', 'Country') }}
				{{ Form::text('country',  $user->country, array('class' => 'form-control')) }}
			</div>
		</div>
	</div>

	<div class="row">
		{{-- Phone --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('phone', 'Phone') }}
				{{ Form::text('phone',  $user->phone, array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Country --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('experiencePoints', 'Exp') }}
				{{ Form::text('experiencePoints',  $user->experiencepoints, array('class' => 'form-control')) }}
			</div>

		</div>
	</div>

	{{-- Signature --}}
	<div class="form-group">
		{{ Form::label('signature', 'Signature') }}
		<textarea id="contentEditor" name="signature" rows="10" cols="80" class="form-control" >
			{{{ $user->signature }}}
		</textarea>
	</div>
	<div class="row no-gutters">
		{{-- locked --}}
		<div class="col-md-3 no-gutters">
			{{-- comments --}}
			<div class="form-group">
				{{ Form::label('locked', 'User locked') }}
				@if ($user->locked)
				<div class="input-group">
					<input type="checkbox" name="lockCheck" checked>
				</div>
				@else
				<div class="input-group">
					<input type="checkbox" name="lockCheck">
				</div>
				@endif
			</div>
		</div>
	</div>
	{{-- EXP --}}
	<hr />
	<div class='form-group'>
		{{ Form::label('roles', 'Roles') }}
		<div class="row no-gutters" >
			@foreach ($roles as $role)
			@if ($user->hasRole($role))
			{{ Form::checkbox('roles[]',  $role->id , true) }}
			@else
			{{ Form::checkbox('roles[]',  $role->id ) }}
			@endif
			{{ Form::label($role->name, ucfirst($role->name)) }}<br>
			@endforeach
		</div>
	</div>
	<hr />
	{{ Form::submit('Update User', array('class' => 'btn btn-success btn-lg btn-block')) }}

	{{ Form::close() }}

</div>

@endsection

@section('scripts')

<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminUserControl");
		tag.className += " active";
	});
</script>
<script>
    //Initialize Select2 Elements
    $('.select2').select2()

</script>

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
				],
			}
		},

		timepicker:false,
		format:'d.m.Y'
	});
</script>
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

<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')
@append