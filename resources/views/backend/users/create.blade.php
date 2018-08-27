{{-- create.blade.php --}}


@extends('backend.layout.app')

@section('title', '| Add User')

@section('content')

<div class='col-sm-12 col'>

	<h1><i class='fa fa-user-plus'></i> Add User</h1>
	<hr>
	{{ Form::open(array('route' => 'users.store', 'files' => true, 'class' => 'form-horizontal')) }}
	{{ csrf_field() }}
	{{-- Username --}}
	<div class="form-group">
		{{ Form::label('username', 'Username') }}
		{{ Form::text('username', '', array('class' => 'form-control', 'required' => 'required')) }}
	</div>
	{{-- Clan --}}
	<div class="form-group">
		<label>Clan</label> 
		<select class="form-control select2" style="width: 100%;" name="clan_id">
			<option disabled selected value> -- select an option -- </option>
			@forelse ($clans as $clan)
			<option value="{{ $clan->id }}">{{ $clan->name }}</option>
			@endforeach
		</select>
	</div>
	{{-- Email --}}
	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', '', array('class' => 'form-control', 'required' => 'required')) }}
	</div>
	{{-- Password --}}
	<div class="form-group">
		{{ Form::label('userPassword', 'Password') }}<br>
		{{ Form::password('userPassword', array('class' => 'form-control')) }}

	</div>
	{{-- First/LastName --}}
	<div class="row">
		<div class="col-sm-6 col">
			<div class="form-group">
				{{ Form::label('firstname', 'Firstname') }}
				{{ Form::text('firstname', '', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="col-sm-6 col">
			<div class="form-group">
				{{ Form::label('lastname', 'Lastname') }}
				{{ Form::text('lastname', '', array('class' => 'form-control')) }}
			</div>
		</div>
	</div>



	<div class="row">
		{{-- Birthdate --}}
		{{-- User Avatar --}}
		<div class="col-sm-6 col ">
			<div class="form-group">
				<label for="avatar" class=" control-label">Avatar</label>
				<input type="file" accept="image/*" onchange="preview_image(event)" name="avatar">
				<img id="output_image" name="avatarImg" class="avatarPreview" />
			</div>
		</div>
		<div class="col-sm-6 col">
			<div class="form-group">

				{{ Form::label('birthDate', 'Birthdate') }}
				<input id="datetimepicker" type="text"  class="form-control">
			</div>
			{{-- gender --}}
			<div class="form-group">
				<label>Gender</label>
				<select class="form-control select2" style="width: 100%;" name="gender" >
					<option disabled selected value> -- select an option -- </option>
					@forelse ($genders as $gender)
					<option value="{{ $gender->id }}">{{ $gender->value }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		{{-- street --}}
		<div class="col-sm-6 col">
			<div class="form-group">
				{{ Form::label('street', 'Street') }}
				{{ Form::text('street', '', array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Zip --}}
		<div class="col-sm-6 col">
			<div class="form-group">
				{{ Form::label('zip', 'Zip') }}
				{{ Form::text('zip', '', array('class' => 'form-control')) }}
			</div>
		</div>
	</div>
	<div class="row">
		{{-- City --}}
		<div class="col-sm-6 col">
			<div class="form-group">
				{{ Form::label('city', 'City') }}
				{{ Form::text('city', '', array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Country --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('country', 'Country') }}
				{{ Form::text('country', '', array('class' => 'form-control')) }}
			</div>
		</div>
	</div>

	<div class="row">
		{{-- Phone --}}
		<div class="col-sm-6 col">
			<div class="form-group">
				{{ Form::label('phone', 'Phone') }}
				{{ Form::text('phone', '', array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Country --}}
		<div class="col-sm-6 col">


		</div>
	</div>

	{{-- Signature --}}
	<div class="form-group">
		{{ Form::label('signature', 'Signature') }}
		<textarea id="contentEditor" name="signature" rows="10" cols="80" class="form-control" >
		</textarea>
	</div>
	<div class="row no-gutters">
		{{-- locked --}}
		<div class="col-md-3 col no-gutters">
			{{-- comments --}}
			<div class="form-group">

				{{ Form::label('locked', 'User locked') }}
				<div class="input-group">
					<input type="checkbox" name="lockCheck">
				</div>
			</div>
		</div>
	</div>
	{{-- EXP --}}
	<hr />
	<div class='form-group'>
		{{ Form::label('roles', 'Roles') }}
		<div class="row no-gutters" >
			@foreach ($roles as $role)
			{{ Form::checkbox('roles[]',  $role->id ) }}
			{{ Form::label($role->name, ucfirst($role->name)) }}<br>

			@endforeach
		</div>
	</div>
	<hr />
	{{ Form::submit('Create User', array('class' => 'btn btn-success btn-lg btn-block')) }}

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