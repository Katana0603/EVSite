

{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event -  Seatplan')

@section('content-header')

<section class="content-header">
	<h1>
		{{ $event->name }}
		<small>Seatplan</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
<div class="right">
	<!-- Rounded switch -->
	<label class="switch">
		<input type="checkbox" id="switchCheckBox" onclick="switchCheckbox()">
		<span class="slider round"></span>
	</label>
</div>
</section>
@endsection

@section('content')

<div id="graphicDiv">
	@foreach ($seatplans as $seatplan)
	<div class="row">
		<div class="col-6">
			<div class="interactiveImg" id="seatMapImg" name="seatMapImg" style="background-image: url({{ asset('storage/media/' . $seatplan->media_path)}});" >
				<div class="seats">

					@foreach ($seatplan->seats as $seat)
					<div class="chair @if ($seat->status_id == 3) belegt @elseif ($seat->status_id == 2) reserviert @else frei @endif" id="seat{{ $seat->id }}" style="left:{{ $seat->x }}%; top:{{ $seat->y }}%;" >{{ $seat->name }}</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	@endforeach

</div>
<div id="tablesDiv">

	<div class="row">
		<div class="col-md-12">

			@foreach ($seatplans as $seatplan)
			<h3>{{ $seatplan->name }}</h3>
			<div class="row">
				<div class="row">
					<div class="col-md-2">
						<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#addUser">
							<span class="fa fa-plus"></span>
						</button>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table id="seats-{{ $seatplan->id }}" class="display">
					<thead>
						<tr>
							<th>Name</th>
							<th>User</th>
							<th>Status</th>
							<th>Buttons</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($seatplan->seats as $seat)
						<tr>		
							<td>{{ $seat->name }}	</td>
							@if (isset($seat->eventuser->user->username))
							<td>{{ $seat->eventuser->user->username }}</td>
							@else
							<td>None</td>
							@endif
							<td>@if ($seat->status){{ $seat->status->name}}@endif</td>
							<td>

								<a href="{{ route('activeEvents.freeSeat',[$event->id, $seat->id]) }}"><i class="fas fa-times"></i></a>
									<a href="#" id="seatTable{{ $seat->id }}" ><i class="fas fa-wrench"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endforeach


			</div>
		</div>
	</div>
	@endsection



	@section('modals')
	<!-- Edit Modal -->
	<div class="modal fade" id="editSeatModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title center">Edit Seat</h4>
				</div>

				{{ Form::open(array('route' => ['activeEvents.saveSeat',$event->id])) }}
				<div class="modal-body">
					<div class="form-group">
						<label>{{ __('template.event.seatplan.newSeat.name') }}</label>
						<input type="text" name="name" id="editseatName" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>{{ __('template.event.seatplan.newSeat.user') }}</label>
						<select class="form-control"  name="user">
							<option  selected value="0" id="userOption"> -- select an option -- </option>
							@foreach ($eventUsers as $eventUser)
							<option value="{{ $eventUser->id }}">{{ $eventUser->user->username }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>{{ __('template.event.seatplan.newSeat.status') }}</label>
						<select class="form-control" required name="status">
							<option  selected value id="statusOption"> -- select an option -- </option>
							@foreach($sitzplatzStatus as $status)
							<option value="{{ $status->id }}">{{ $status->name }}</option>
							@endforeach
						</select> 
					</div>
				</div>
				<input type="hidden" value="" name="seatplan_id" id="seatplan_id">
				<input type="hidden" value="" name="seat_id" id="seat_id">
				<div class="modal-footer">
					{{ Form::submit('Edit Seat', array('class' => 'btn btn-success btn-lg btn-block')) }}
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	@append

	@section('scripts')

	<script>
		$( document ).ready(function() {
			var tag =  document.getElementById("adminEvent");
			tag.className += " active";
		});
	</script>

	@foreach ($seatplans as $seatplan)
	<script>
		$(document).ready(function() {
			$('#seats-{{ $seatplan->id }}').DataTable( {
				dom: 'Bfrtip',
				lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
				],
				buttons: [
				'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
				],
				"order": [[ 0, "asc" ]],
				stateSave: true,
			} );
		} );
	</script>
	@endforeach

	<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
	$('.select_2').select2();
});

</script>

<script>

	$(document).ready(function(){
		if (document.getElementById('switchCheckBox').checked) {
			document.getElementById('graphicDiv').style.display='none';
			document.getElementById('tablesDiv').style.display='block';
		}	
		else
		{
			document.getElementById('tablesDiv').style.display='none';
			document.getElementById('graphicDiv').style.display='block';
		}
	});

	function switchCheckbox()
	{
		if (document.getElementById('switchCheckBox').checked) {
			document.getElementById('graphicDiv').style.display='none';
			document.getElementById('tablesDiv').style.display='block';
		}	
		else
		{
			document.getElementById('tablesDiv').style.display='none';
			document.getElementById('graphicDiv').style.display='block';
		}

	}
</script>

<script>

	$(document).ready(function() {
		@foreach ($seatplans as $seatplan)
		@foreach ($seatplan->seats as $seat)
		$('#seat' + {{ $seat->id }}).on("click", function(e){
			//Do it
			//Change Seat in Sight or Even Delete it
			document.getElementById("seatplan_id").value = "{{ $seatplan->id }}";
			document.getElementById("seat_id").value = "{{ $seat->id }}";
			document.getElementById("editseatName").value = "{{ $seat->name }}";
			@if (isset($seat->eventuser->user->username))
			document.getElementById("userOption").value = "{{ $seat->eventuser_id }}";
			document.getElementById("userOption").text = "{{ $seat->eventuser->user->username }}";
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
				$('#seatTable' + {{ $seat->id }}).on("click", function(e){
			//Do it
			//Change Seat in Sight or Even Delete it
			document.getElementById("seatplan_id").value = "{{ $seatplan->id }}";
			document.getElementById("seat_id").value = "{{ $seat->id }}";
			document.getElementById("editseatName").value = "{{ $seat->name }}";
			@if (isset($seat->eventuser->user->username))
			document.getElementById("userOption").value = "{{ $seat->eventuser_id }}";
			document.getElementById("userOption").text = "{{ $seat->eventuser->user->username }}";
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
	});
</script>



@append

