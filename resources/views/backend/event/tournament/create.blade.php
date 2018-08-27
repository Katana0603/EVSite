{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Tournament Create')

@section('content-header')

<section class="content-header">
	<h1>
		Tournament
		<small>Create</small>
	</h1>
	<ol class="breadcrumb">

	</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => 'eventTournament.store', 'files' => true)) }}

<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }}

		</div>

		<div class="form-group">
			{{ Form::label('event', 'Event') }}
			<select class="form-control" name="event" required>
				@forelse ($events as $event)
				<option value="{{ $event->id }}">{{$event->name }}</option>
				@endforeach         
			</select>
		</div>
		<div class="form-group">
			{{ Form::label('game', 'Game') }}
			<select class="form-control" name="game" required>
				@forelse ($games as $game)
				<option value="{{ $game->id }}">{{$game->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{{ Form::label('type', 'Type') }}
			<select class="form-control" name="type" required>
				@forelse ($types as $type)
				<option value="{{ $type->id }}">{{$type->name }}</option>
				@endforeach         
			</select>
		</div>
		<div class="form-group">
			{{ Form::label('maxTeams', 'Max. Teams') }}
			<select name="maxTeams" required class="form-control">
				<option value="2">2</option>
				<option value="4">4</option>
				<option value="8">8</option>
				<option value="16">16</option>
				<option value="32">32</option>
				<option value="64">64</option>
				<option value="128">128</option>
			</select>
		</div>
		<div class="form-group">
			{{ Form::label('playerPerTeam', 'Player / Team') }}
			{{ Form::number('playerPerTeam', null, array('class' => 'form-control', 'required' => 'required')) }}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('startTime', 'Start Time') }}
			<input id="datetimepicker" type="text" name="start_datetime"  required class="form-control">

		</div>
		<div class="form-group">
			{{ Form::label('endTime', 'End Time') }}
			<input id="datetimepicker2" type="text" name="end_datetime"  required class="form-control">
		</div>

		<div class="form-group">
			{{ Form::label('watcher1', 'Watcher') }}
			<select class="select2 form-control" name="watcher1" required>
				@foreach ($users as $user)
				<option value="{{ $user->id }}">{{ $user->username }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{{ Form::label('watcher2', 'Watcher 2') }}
			<select class="select2 form-control" name="watcher2">
				@foreach ($users as $user)
				<option value="{{ $user->id }}">{{ $user->username }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

{{ Form::submit('Create Tournament', array('class' => 'btn btn-success btn-lg btn-block')) }}
{{ Form::close() }}

@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminEvent");
		tag.className += " active";
	});
</script>

{{-- Media Upload Script --}}
<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#image_upload_preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#background-graphic").change(function () {
		readURL(this);
	});
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
				]
			}
		},
		step:30,
		weeks:true,
		format:'d.m.Y H:i'
	});
</script>


<script>

	jQuery('#datetimepicker2').datetimepicker({
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

@append