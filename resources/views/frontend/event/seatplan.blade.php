@extends('frontend.layout.app')

@section('title')

Event Info's

@endsection

@section('content')

<div class="box">
	<select class="form-control select2" name="choose-event" id="choose-event" onchange="eventSelectSwitch()">
		@foreach ($event as $sin)
		<option value="{{ $sin->id }}">{{ $sin->name }}</option>
		@endforeach

	</select>

	<hr>

	@foreach ($event as $sin)
	<div id="event-{{ $sin->id }}">
		<h2 class="center">{{ __('template.seatplan.header') }}</h2>

		<p class="center">{{ __('template.seatplan.initalContent') }}</p>
		<hr />
		@foreach ($sin->seatplan as $seatplan)
		<div class="interactiveImg" id="seatMapImg" name="seatMapImg" style="background-image: url({{ asset('storage/media/' . $seatplan->media_path)}});" >
			<div class="seats">

				@foreach ($seatplan->seats as $seat)
				<div class="chair" id="seat{{ $seat->id }}" style="left:{{ $seat->x }}%; top:{{ $seat->y }}%;" >{{ $seat->name }}</div>
				@endforeach
			</div>
		</div>
		@endforeach

	</div>
	@endforeach
	<div class="clearfix">
	</div>


	<p id="result"></p>
</div>
@endsection


@section('modals')
<!-- Edit Modal -->
<div class="modal" id="editSeatModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title center">Edit Seat</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			{{-- {{ Form::open(array('route' => ['activeEvents.saveSeat',$event->id])) }} --}}
			<div class="modal-body">
				<div class="form-group">
					<label>{{ __('template.event.seatplan.newSeat.name') }}</label>
					<input type="text" name="name" id="editseatName" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label>{{ __('template.event.seatplan.newSeat.status') }}</label>
					<select class="form-control" required name="status">
						<option disabled selected value id="statusOption"> -- select an option -- </option>
						@foreach($sitzplatzStatus as $status)
						<option value="{{ $status->id }}">{{ $status->name }}</option>
						@endforeach
					</select> 
				</div>
			</div>
			<input type="hidden" value="" name="seatplan_id" id="seatplan_id">
			<input type="hidden" value="" name="seat_id" id="seat_id">

			<div class="modal-footer">
				{{-- {{ Form::submit('Edit Seat', array('class' => 'btn btn-success btn-lg btn-block')) }} --}}
			</div>
			{{-- {{ Form::close() }} --}}
		</div>
	</div>
</div>
@append




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


<script>

	$(document).ready(function() {
		@foreach ($event as $sin)
		
		@foreach ($sin->seatplan as $seatplan)
		@foreach ($seatplan->seats as $seat)
		$('#seat' + {{ $seat->id }}).on("click", function(e){

			//Do it
			//Change Seat in Sight or Even Delete it
			document.getElementById("seatplan_id").value = "{{ $seatplan->id }}";
			document.getElementById("seat_id").value = "{{ $seat->id }}";
			document.getElementById("editseatName").value = "{{ $seat->name }}";
			@if (isset($seat->eventuser->username))
			document.getElementById("userOption").value = "{{ $seat->eventuser_id }}";
			document.getElementById("userOption").text = "{{ $seat->eventuser->username }}";
			@endif


			@if (isset($seat->status->name))
			document.getElementById("statusOption").value = "{{ $seat->status_id }}";
			document.getElementById("statusOption").text = "{{ $seat->status->name }}";
			@endif


			$("#editSeatModal").modal();
		    // A cross browser compatible way to stop propagation of the event:
		    if (!e) var e = window.event;
		    e.cancelBubble = true;
		    if (e.stopPropagation) e.stopPropagation();
		});
		@endforeach
		@endforeach
		@endforeach
	});
</script>



@append