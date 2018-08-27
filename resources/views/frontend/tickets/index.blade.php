{{-- @extends('frontend.layout.app')

@section('title')

Team

@endsection

@section('content')
<div class="box ">
	<div class="row no-gutters">
		{{-- {{ $team }} --}}
		<h2 class="center">{{ __('template.tickets.header') }}</h2>

		<p class="center">{{ __('template.ticket.initalContent') }}</p>

		@if (isset($tickets))
		<h3 class="center">	{{ __('template.ticket.ticketsheader') }}</h3>
		<div class="row">
		</div>
		@endif
		@if (isset($events))

		{{-- <h3 class="center">{{ __('template.ticket.eventticketsheader') }}</h3> --}}
		<div class="row no-gutters">
			@foreach ($events as $event)
			@if ($event->active)
				<h4>{{ $event->name }}</h4>
			@endif

			<div class="tickets" >
				@foreach ($event->tickets as $ticket)

				<div class="ticketcol">
					<ul class="ticketprice">
						<li class="header">{{ $ticket->name }}</li>
						<li class="grey">{{ $ticket->price }} €</li>
						{{-- ToDo --}}
						@foreach ($ticket->content as $content)
						@foreach ($content as $singleContent)
						<li><a href="#" data-toggle="tooltip" title="{{ $singleContent->description }}"> {{ $singleContent->name }}</a><br>
							<small>{{ $singleContent->description }}</small>
						</li>
						@endforeach
						@endforeach
						<li class="grey">
							<a href="#" class="button">
								Buy
							</a>
						</li>
					</ul>	

				</div>	
				@endforeach
				@endforeach
			</div>
		</div>
		@endif
	</div>
</div>
{{ $events }}
@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
@endsection --}}