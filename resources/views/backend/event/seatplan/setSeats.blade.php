{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event Seatplans')

@section('content-header')

<section class="content-header">
	<h1>
		Event
		<small>Seatplans</small>
	</h1>
	<ol class="breadcrumb">
{{--        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-6">
		<div class="interactiveImg" id="seatMapImg" name="seatMapImg" style="background-image: url({{ asset('storage/media/' . $seatplan->media_path)}});" >
			<div class="seats">

				@foreach ($seatplan->seats as $seat)
				<div class="chair" id="seat{{ $seat->id }}" style="left:{{ $seat->x }}%; top:{{ $seat->y }}%;" >{{ $seat->name }}</div>
				@endforeach
			</div>
		</div>
	</div>
</div>


<!-- Create Modal -->
<div class="modal fade" id="newSeatModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title center">New Seat</h4>
			</div>

			{{ Form::open(array('route' => 'eventSeatplan.storeSeat')) }}
			<div class="modal-body">
				<p>Place a new Seat on Position</p>

{{-- 				<div class="form-group">
					<label>{{ __('template.event.seatplan.newSeat.name') }}</label>
					<input type="number" name="name" id="seatName" class="form-control" min="1" max="{{ $event->allowedUser }}">
				</div> --}}
				<div class="form-group">
					<label>{{ __('template.event.seatplan.newSeat.x') }}</label>
					<input type="text" name="x" id="seatX" class="form-control">
				</div>
				<div class="form-group">
					<label>{{ __('template.event.seatplan.newSeat.y') }}</label>
					<input type="text" name="y" id="seatY" class="form-control">
				</div>
			</div>
			<input type="hidden" value="{{ $seatplan->id }}" name="seatplan_id">

			<div class="modal-footer">
				{{ Form::submit('Create Seat', array('class' => 'btn btn-success btn-lg btn-block')) }}
			</div>
		</div>


		{{ Form::close() }}
	</div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSeatModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title center">Edit Seat</h4>
				{{ Form::open(['method' => 'DELETE', 'route' => ['eventSeatplan.deleteSeat']]) }}
				<input type="hidden" name="deleteSeatNr" id="deleteSeatNr">
				<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>
				{{ Form::close() }}
			</div>

			{{ Form::open(array('route' => ['eventSeatplan.editSeat'])) }}
			<div class="modal-body">
				<div class="form-group">
					<label>{{ __('template.event.seatplan.newSeat.name') }}</label>
					<input type="text" name="name" id="editseatName" class="form-control">
				</div>
				<div class="form-group">
					<label>{{ __('template.event.seatplan.newSeat.x') }}</label>
					<input type="text"  name="x" id="editseatX" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label>{{ __('template.event.seatplan.newSeat.y') }}</label>
					<input type="text" name="y" id="editseatY" class="form-control" readonly>
				</div>
			</div>
			<input type="hidden" value="{{ $seatplan->id }}" name="seatplan_id">
			<input type="hidden" value="" name="seat_id" id="seat_id">

			<div class="modal-footer">
				{{ Form::submit('Edit Seat', array('class' => 'btn btn-success btn-lg btn-block')) }}
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminEvent");
		tag.className += " active";
	});
</script>
<script>
	$(document).ready(function() {
		$('#ticketstable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 1, "asc" ]]
		} );

		$('#seatMapImg').on("click", function(e){
			@if ($seatplan->seats->count() < $event->allowedUser)
				// Calculate the Click Position on the Div Image
				var x =  (e.pageX - $('#seatMapImg').offset().left) + $(window).scrollLeft();
				var y = (e.pageY - $('#seatMapImg').offset().top) + $(window).scrollTop();
				//Calculate the Div  Size
				var imgWidth =  document.getElementById("seatMapImg").clientWidth; 
				var imgHeight =  document.getElementById("seatMapImg").clientHeight;
				//Calculates the Percentages of the Click to be Responsiv in the End
				var xperc = (((x * 100) / imgWidth).toFixed(0));
				var yperc = (((y * 100) / imgHeight).toFixed(0));


				$inputFieldX = document.getElementById("seatX");
				$inputFieldX.value = xperc;
				$inputFieldY = document.getElementById("seatY");
				$inputFieldY.value = yperc -1;
				$("#newSeatModal").modal();


				@else
				alert('max erreicht');
				@endif


			});

		@foreach ($seatplan->seats as $seat)
		$('#seat' + {{ $seat->id }}).on("click", function(e){
			//Do it
			//Change Seat in Sight or Even Delete it
			document.getElementById("seat_id").value = "{{ $seat->id }}";
			document.getElementById("deleteSeatNr").value = "{{ $seat->id }}";
			document.getElementById("editseatY").value = "{{ $seat->y }}";
			document.getElementById("editseatX").value = "{{ $seat->x }}";
			document.getElementById("editseatName").value = "{{ $seat->name }}";
			$("#editSeatModal").modal();

		    // A cross browser compatible way to stop propagation of the event:
		    if (!e) var e = window.event;
		    e.cancelBubble = true;
		    if (e.stopPropagation) e.stopPropagation();
		});
		@endforeach


	});



</script>





@append
