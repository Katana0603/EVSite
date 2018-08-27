@extends('frontend.layout.app')

@section('title')

Event Users

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
		<h2 class="center">{{ __('template.users.header') }}</h2>

		<p class="center">{{ __('template.users.initalContent') }}</p>
		<hr />


		<div class="row">
			<div class="col-md-6">
				<input type="text" id="filterBox" placeholder="Search for names..">
			</div>
			<div class="col-md-12">
				<table id="pmTable">
					<thead>
						<tr class="table-header">
							<th id="username" class="col-username">Username</th>
							<th id="clan" class="col-clan">Clan</th>
							<th id="status" class="col-status">Status</th>
							<th id="seat" class="col-seat">Seat</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($sin->users as $user)
						<tr class="clickable-row" data-href="#" >
							<td>{{ $user->user->username }}</td>
							@if (isset($user->user->clan->name))
							<td>{{ $user->user->clan->name }}</td>
							@else
							<td></td>
							@endif
							<td> {{ $user->status }}</td>
							@if ($user->seat)

							<td>{{ $user->seat->name }}</td>
							@else
							<td></td>
							@endif

						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>




	</div>
	@endforeach
	<div class="clearfix">
	</div>


	<p id="result"></p>
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


<script>
	function filterTable(event) {
		var filter = event.target.value.toUpperCase();
		var rows = document.querySelector("#pmTable tbody").rows;

		for (var i = 0; i < rows.length; i++) {
			var firstCol = rows[i].cells[0].textContent.toUpperCase();
			var secondCol = rows[i].cells[1].textContent.toUpperCase();
			var thirdCol = rows[i].cells[2].textContent.toUpperCase();
			var fourthCol = rows[i].cells[3].textContent.toUpperCase();
			if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1|| thirdCol.indexOf(filter) > -1 || fourthCol.indexOf(filter) > -1) {
				rows[i].style.display = "";
			} else {
				rows[i].style.display = "none";
			}      
		}
	}

	document.querySelector('#filterBox').addEventListener('keyup', filterTable, false);
</script>



@append