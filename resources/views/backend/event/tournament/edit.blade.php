{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Tournament Edit')

@section('content-header')

<section class="content-header">
	<h1>
		Tournament
		<small>Edit</small>
	</h1>
	<ol class="breadcrumb">

	</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => ['eventTournament.update',$tournament->id], 'method' => 'PUT')) }}

<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name', $tournament->name, array('class' => 'form-control', 'required' => 'required')) }}

		</div>

		<div class="form-group">
			{{ Form::label('event', 'Event') }}
			<select class="form-control" name="event" required>
				<option value="{{ $tournament->event_id }}">{{$tournament->event->name }}</option>
				@forelse ($events as $event)
				<option value="{{ $event->id }}">{{$event->name }}</option>
				@endforeach         
			</select>
		</div>
		<div class="form-group">
			{{ Form::label('game', 'Game') }}
			<select class="form-control" name="game" required>
				<option value="{{ $tournament->games_id }}">{{$tournament->game->name }}</option>
				@forelse ($games as $game)
				<option value="{{ $game->id }}">{{$game->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{{ Form::label('type', 'Type') }}
			<select class="form-control" name="type" required>
				<option value="{{ $tournament->type_id }}">{{$tournament->type->name }}</option>
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
			{{ Form::number('playerPerTeam', $tournament->playerPerTeam, array('class' => 'form-control', 'required' => 'required')) }}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('startTime', 'Start Time') }}
			<input id="datetimepicker" type="text" name="start_datetime"  required class="form-control" value="{{ date("d.m.Y H:i:s",strtotime($tournament->start))}}">

		</div>
		<div class="form-group">
			{{ Form::label('endTime', 'End Time') }}
			<input id="datetimepicker2" type="text" name="end_datetime"  required class="form-control" value="{{ date("d.m.Y H:i:s",strtotime($tournament->end))}}">
		</div>

		<div class="form-group">
			{{ Form::label('watcher1', 'Watcher') }}
			<select class="select2 form-control" name="watcher1" required>
				<option value="{{ $tournament->watcher1_id }}">{{$tournament->watcher1->username }}</option>
				@foreach ($users as $user)
				<option value="{{ $user->id }}">{{ $user->username }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{{ Form::label('watcher2', 'Watcher 2') }}
			<select class="select2 form-control" name="watcher2">
				@if ($tournament->watcher2_id)

				<option value="{{ $tournament->watcher2_id }}">{{$tournament->watcher2->username }}</option>
				@endif
				@foreach ($users as $user)
				<option value="{{ $user->id }}">{{ $user->username }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

{{ Form::submit('Edit Tournament', array('class' => 'btn btn-success btn-lg btn-block')) }}
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