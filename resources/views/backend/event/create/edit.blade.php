{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event Edit')

@section('content-header')

<section class="content-header">
	<h1>
		Event
		<small>Edit</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')


{{ Form::open(array('route' => ['admin.event.update',$event->id], 'files' => true,  'method' => 'POST')) }}

<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('name', 'Event Name') }}
			{{ Form::text('name', $event->name, array('class' => 'form-control', 'required' => 'required')) }}

		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('maxUser', 'Max. User') }}
			{{ Form::number('maxUser', $event->allowedUser, array('class' => 'form-control', 'required' => 'required')) }}

		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">

			@if ($event->active)

			{{ Form::label('active', 'Activ') }}
			{{ Form::checkbox('active', 'active', true) }}

			@else
			{{ Form::label('active', 'Activ') }}
			{{ Form::checkbox('active', 'active', false) }}
			@endif  
			@if ($event->intern)

			{{ Form::label('intern', 'Internes Event') }}
			{{ Form::checkbox('intern', 'intern', true) }}

			@else
			{{ Form::label('intern', 'Internes Event') }}
			{{ Form::checkbox('intern', 'intern', false) }}
			@endif 
		</div> 
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('location', 'Location') }}
			<select class="form-control" name="location">
				@if (isset($event->location_id))
				<option value="{{ $event->location_id }}">{{ $event->location->name}}</option>
				@else
				<option value="" disabled selected>Select your option</option>
				@endif
				@forelse ($locations as $location)
				<option value="{{ $location->id }}">{{$location->name }}</option>
				@endforeach         
			</select>
		</div>
	</div>
</div>


{{-- DatePicker --}}
<div class="row">
	<div class="col-sm-6 ">
		<div class="form-group">
			<label>Event Start:</label>


			<input id="start_eventdatetime" type="text" name="start_eventdatetime" class="form-control"  required value="{{ date("d.m.Y H:i:s",strtotime($event->event_start))}}">
			<!-- /.input group -->
		</div>
		<!-- /.form group -->
	</div>
	<div class="col-sm-6 ">
		<div class="form-group">
			<label>Event End:</label>


			<input id="end_eventdatetime" type="text" name="end_eventdatetime" class="form-control"  required value="{{ date("d.m.Y H:i:s",strtotime($event->event_end))}}">
			<!-- /.input group -->
		</div>
		<!-- /.form group -->
	</div>
</div>

{{-- DatePicker --}}
<div class="row">
	<div class="col-sm-6 ">
		<div class="form-group">
			<label>Signup Start:</label>


			<input id="start_signupdatetime" type="text" name="start_signupdatetime" class="form-control" value="{{ date("d.m.Y H:i:s",strtotime($event->signup_start))}}">
			<!-- /.input group -->
		</div>
		<!-- /.form group -->
	</div>
	<div class="col-sm-6 ">
		<div class="form-group">
			<label>Signup End:</label>


			<input id="end_signupdatetime" type="text" name="end_signupdatetime" class="form-control" value="{{ date("d.m.Y H:i:s",strtotime($event->signup_end))}}">
			<!-- /.input group -->
		</div>
		<!-- /.form group -->
	</div>
</div>

{{-- DatePicker --}}
<div class="row">
	<div class="col-sm-6 ">
		<div class="form-group">
			<label>Seatplan Start:</label>


			<input id="start_seatplandatetime" type="text" name="start_seatplandatetime" class="form-control" value="{{ date("d.m.Y H:i:s",strtotime($event->seatReserve_start))}}">
			<!-- /.input group -->
		</div>
		<!-- /.form group -->
	</div>
	<div class="col-sm-6 ">
		<div class="form-group">
			<label>Seatplan End:</label>


			<input id="end_seatplandatetime" type="text" name="end_seatplandatetime" class="form-control" value="{{ date("d.m.Y H:i:s",strtotime($event->seatReserve_end))}}">
			<!-- /.input group -->
		</div>
		<!-- /.form group -->
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('Image', 'Image') }}
			<input type='file' id="inputFile" name="inputFile" accept="image/*" />
			<img id="image_upload_preview" src="@if(isset($event->media))
			{{ $event->media->path }}
			@else
			{{ asset('img/preview.png') }}
			@endif" alt="your image" class="mapImage" />
		</div>

	</div>
</div> 




{{ Form::submit('Update Event', array('class' => 'btn btn-success btn-lg btn-block')) }}
{{ Form::close() }}

@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminEvent");
		tag.className += " active";
	});
</script>


<script>

	jQuery.datetimepicker.setLocale('de');

	jQuery('#start_datetime').datetimepicker({
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

	jQuery.datetimepicker.setLocale('de');

	jQuery('#start_eventdatetime').datetimepicker({
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

	jQuery.datetimepicker.setLocale('de');

	jQuery('#end_eventdatetime').datetimepicker({
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

	jQuery.datetimepicker.setLocale('de');

	jQuery('#start_signupdatetime').datetimepicker({
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

	jQuery.datetimepicker.setLocale('de');

	jQuery('#end_signupdatetime').datetimepicker({
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

	jQuery.datetimepicker.setLocale('de');

	jQuery('#start_seatplandatetime').datetimepicker({
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

	jQuery.datetimepicker.setLocale('de');

	jQuery('#end_seatplandatetime').datetimepicker({
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

	$("#inputFile").change(function () {
		readURL(this);
	});
</script>

@append


@section('css')

<link href="{{ asset('css/progress-wizard.min.css') }}" rel="stylesheet">
@append