{{-- create.blade.php --}}


@extends('backend.layout.app')

@section('title', '| User')

@section('content')

<div class='col-sm-12'>

	<h1><i class='fa fa-user-plus'></i> Add User</h1>
	<hr>

	{{ Form::open(array('route' => 'users.store')) }}
	{{-- Username --}}
	<div class="form-group">
		{{ Form::label('username', 'Username') }}
		{{ Form::label('username', $user->username, array('class' => 'form-control')) }}
	</div>

	@if ($user->clan)
	{{-- Clan --}}
	<div class="form-group">
		<label>Clan</label>

		{{ Form::label('email', $user->clan->name, array('class' => 'form-control')) }}
	</div>
	@endif
	{{-- Email --}}
	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::label('email', $user->email, array('class' => 'form-control')) }}
	</div>
	{{-- Password --}}
	{{-- First/LastName --}}
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				{{ Form::label('firstname', 'Firstname') }}
				{{ Form::label('firstname', $user->firstname, array('class' => 'form-control', 'required' => 'required')) }}
			</div>
		</div>
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('lastname', 'Lastname') }}
				{{ Form::label('lastname', $user->name, array('class' => 'form-control', 'required' => 'required')) }}
			</div>
		</div>
	</div>


	{{-- Avatar --}}
	<div class="form-group">
		{{ Form::label('avatar', 'Avatar') }}
		Not available yet
	</div>
	<div class="row">
		{{-- Birthdate --}}

		<div class="col-sm-6 ">
			<div class="form-group">

				{{ Form::label('birthDate', 'Birthdate') }}
				{{ Form::label('birthdate', $user->birthdate, array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="col-sm-6 ">
			{{-- gender --}}
			<div class="form-group">
				<label>Gender</label>
				@if ($user->gender)
				
				{{ Form::label('gender', $user->gender->value, array('class' => 'form-control')) }}
				@endif
			</div>
		</div>
	</div>
	<div class="row">
		{{-- street --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('street', 'Street') }}
				{{ Form::label('street', $user->street, array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Zip --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('zip', 'Zip') }}
				{{ Form::label('zip', $user->zip, array('class' => 'form-control')) }}
			</div>
		</div>
	</div>
	<div class="row">
		{{-- City --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('city', 'City') }}
				{{ Form::label('city', $user->city, array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Country --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('country', 'Country') }}
				{{ Form::label('country', $user->country, array('class' => 'form-control')) }}
			</div>
		</div>
	</div>

	<div class="row">
		{{-- Phone --}}
		<div class="col-sm-6 ">
			<div class="form-group">
				{{ Form::label('phone', 'Phone') }}
				{{ Form::label('phone', $user->phone, array('class' => 'form-control')) }}
			</div>
		</div>
		{{-- Country --}}
		<div class="col-sm-6 ">


		</div>
	</div>

	{{-- Signature --}}
	<div class="form-group">
		{{ Form::label('signature', 'Signature') }}
		{!! $user->signature !!}
	</div>

	{{-- EXP --}}
	<hr />

	<hr />

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
@append