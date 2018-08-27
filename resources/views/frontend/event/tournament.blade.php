@extends('frontend.layout.app')

@section('title')

Tournament

@endsection

@section('content')

<div class="box center">
	<select class="form-control select2" name="choose-event" id="choose-event" onchange="eventSelectSwitch()">
		@foreach ($event as $sin)
		<option value="{{ $sin->id }}">{{ $sin->name }}</option>
		@endforeach
	</select>

	<hr>
	@foreach ($event as $sin)
	<div id="event-{{ $sin->id }}">

		<div class="col-12 col-md-3">
			@include('frontend.event.tournament.selector')
		</div>
		<div class="col-12 col-md-8">
		</div>

		{{ $sin->tournaments }}


	</div>


	@endforeach
</div>
@endsection

@section('scripts')

<script>
	$(document).ready(function() {
		var optionValues = [];
		var x = document.getElementById("choose-event");
		var i;
		// Hide selected Value
		for(i = 0;i < x.length; i++){
			$("#event-" + x.options[i].value).hide();
		}
		var selectedOption = x.options[x.selectedIndex].value;

		$("#event-" + selectedOption).show();
	});


	function eventSelectSwitch(){
		var x = document.getElementById("choose-event");
		var selectedOption = x.options[x.selectedIndex].value;


		var i;
		for(i = 0;i < x.length; i++){
			$("#event-" + x.options[i].value).hide();
		}
		$("#event-" + selectedOption).show();
	}
</script>


@append