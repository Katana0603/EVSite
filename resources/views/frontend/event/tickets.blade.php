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
		<h2 class="center">{{ __('template.tickets.header') }}</h2>

		<p class="center">{{ __('template.tickets.initalContent') }}</p>
		<hr />
		@foreach ($sin->tickets as $ticket)
		<div class="ticketcol">
			<ul class="ticketprice">
				<li class="ticketheader">{{ $ticket->name }}
				</li>
				<li class="grey"> {{ number_format($ticket->prices, 2 )}} €
				</li>
				{{-- ToDo --}}

				<li class="">{!! $ticket->description !!}
				</li>
				<li class="grey">
					<button data-toggle="modal" data-target="#cashPayModal" class="button">
						<span class="fas fa-money-bill-alt"></span>
					</button >
					<a href="{{ config('paypal.paypal_pay_url') }}" target="_blank" class="button">
						<span class="fab fa-paypal">
						</a>
					</li>
				</ul>	

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
	<!-- Modal -->
	<div id="cashPayModal" class="modal" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Überweisung</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<img src="{{ asset('img/event/ueberweisung.jpg') }}" alt="no img found">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
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

	@append