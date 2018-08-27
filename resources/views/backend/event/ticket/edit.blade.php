{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Tickets Edit')

@section('content-header')

<section class="content-header">
	<h1>
		Tickets
		<small>Edit</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => ['admin.eventTickets.update',$ticket->id], 'files' => true, 'method' => 'PUT')) }}
<div class="form-group">
	{{ Form::label('name', 'Ticket Name') }}
	{{ Form::text('name', $ticket->name, array('class' => 'form-control', 'required' => 'required')) }}

</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			<textarea id="contentEditor" name="description" rows="10" cols="80"  required>{{ $ticket->description  }}
			</textarea>

		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('price', 'Price') }}
			<div class="input-group">
				<input type=number step=0.01  class="form-control" name="price" value="{{ $ticket->prices }}" />
				<span class="input-group-addon">€</span>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('event', 'Event') }}
			<select class="form-control" name="event">

				<option value="{{ $ticket->event_id }}">{{$ticket->event->name }}</option>
				@forelse ($events as $event)
				<option value="{{ $event->id }}">{{$event->name }}</option>
				@endforeach         
			</select>
		</div>

		<div class="form-group">
			{{ Form::label('startTime', 'Start Time') }}
			<input id="datetimepicker" type="text" name="start_datetime"  class="form-control" value="{{ date("d.m.Y H:i:s",strtotime($ticket->start_time)) }}">

		</div>
		<div class="form-group">
			{{ Form::label('endTime', 'End Time') }}
			<input id="datetimepicker2" type="text" name="end_datetime"  class="form-control" value="{{ date("d.m.Y H:i:s",strtotime($ticket->end_time)) }}">

		</div>
	</div>
</div>
<div class="row no-gutters">
	<div class="form-group">
		<div class="radio" id="radiobox" name="radiobox">
			<label>
				<input type="radio" name="optionsRadios" id="optionsRadios1" value="1" @if ($ticket->backgroundgraphic) checked	@endif >
				Ticket Background Image
			</label>

			<label>
				<input type="radio" name="optionsRadios" id="optionsRadios2" value="2" @if ($ticket->uploadedTicketImage) checked @endif>
				Full Ticket Image
			</label>
		</div>
	</div>
</div>
<div class="row">


	<div class="form-group " >
		<div class="col-xs-6">
			<div class="form-group">
				{{ Form::label('Background-graphic', 'Background Graphic') }}
				<input type='file' id="background-graphic" name="background-graphic" accept="image/*"  value=  @if ($ticket->backgroundgraphic)  {{  $ticket->backgroundgraphic}} @else {{  $ticket->uploadedTicketImage}} @endif  />
				@if ($ticket->backgroundgraphic)
				<img id="image_upload_preview" src="{{ asset('storage/media/' . $ticket->backgroundgraphic) }}" alt="your image" class="mapImage" />
				@else
				<img id="image_upload_preview" src="{{ asset('storage/media/' . $ticket->uploadedTicketImage) }}" alt="your image" class="mapImage" />
				@endif
			</div>
		</div>
	</div>

</div>


{{ Form::submit('Create Ticket', array('class' => 'btn btn-success btn-lg btn-block')) }}
{{ Form::close() }}

@endsection

@section('scripts')

<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')

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