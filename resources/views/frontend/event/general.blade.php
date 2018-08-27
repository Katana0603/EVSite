@extends('frontend.layout.app')

@section('title')

- Event Info's

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

		<div class="center">
			<h1>{{ $sin->name }}</h1>
		</div>
		{{-- if user is registered testing, dann ausblenden --}}
		@if ($sin->userRegisterd == Null)
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<a href="{{ route('event.register.now', $sin->id) }}" class="btn btn-success btn-block">
					<span class="">Register Now</span>
				</a>
			</div>
		</div>
		@endif

		<hr>
		<div class="row">
			<div class="col-md-6">
				@if ($sin->media_path)
				<img src="{{ asset('storage/media/'. $sin->media_path) }}" alt="{{ $sin->name }} Logo not found">
				@endif
			</div>

			<div class="col-md-6">
				<h3>{{ __('template.event.times') }}</h3>


				<div class="row">
					<div class="col-md-6">
						{{ __('template.event.starttime') }}
					</div>
					<div class="col-md-6">
						{{ date('d.m.Y h:m',strtotime($sin->event_start)) }} {{ __('template.time.affix') }}
					</div>
					<div class="col-md-6">
						{{ __('template.event.endtime') }}
					</div>
					<div class="col-md-6">
						{{ date('d.m.Y h:m',strtotime($sin->event_end)) }} {{ __('template.time.affix') }}
					</div>
				</div>
				<hr />
				<h3>{{ __('template.event.tickets') }}</h3>

				@foreach ($sin->tickets as $ticket)
				<div class="row">
					<div class="col-md-12">
						<a href="{{ route('tickets.index') }}">

							<div class="row">
								<div class="col-md-6">
									{{ $ticket->name }}
								</div>
								<div class="col-md-6">
									{{ $ticket->prices }} €
								</div>

							</div>
						</a>
					</div>
				</div>

				@endforeach
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="card">
					<a href="{{ route('event.tickets') }}">
						<div class="event-card-img">
							<img data-src="holder.js/100px280/thumb" alt="100%x280" style="height: auto; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16219da9de2%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16219da9de2%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.23333358764648%22%20y%3D%22148.4%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
							<h2><span>Tickets<span class='spacer'></span><br /><span class='spacer'></span>Out Now</span></h2>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="card ">
					<a href="#">

						<div class="event-card-img">
							<img data-src="holder.js/100px280/thumb" alt="100%x280" style="height: auto; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16219da9de2%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16219da9de2%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.23333358764648%22%20y%3D%22148.4%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">

							<h2><span>Tournaments<span class='spacer'></span><br /><span class='spacer'></span>Holo Deck</span></h2>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="card ">
					<a href="#">
						<div class="event-card-img">
							<img data-src="holder.js/100px280/thumb" alt="100%x280" style="height: auto; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16219da9de2%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16219da9de2%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.23333358764648%22%20y%3D%22148.4%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
							<h2><span>Seatplan<span class='spacer'></span><br /><span class='spacer'></span>Take it keep it</span></h2>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="card ">
					<a href="#">
						<div class="event-card-img">
							<img data-src="holder.js/100px280/thumb" alt="100%x280" style="height: auto; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16219da9de2%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16219da9de2%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.23333358764648%22%20y%3D%22148.4%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
							<h2><span>Users<span class='spacer'></span><br /><span class='spacer'></span>Git Gud</span></h2>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="card ">
					<a href="#">
						<div class="event-card-img">
							<img data-src="holder.js/100px280/thumb" alt="100%x280" style="height: auto; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16219da9de2%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16219da9de2%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.23333358764648%22%20y%3D%22148.4%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
							<h2><span>Arrival<span class='spacer'></span><br /><span class='spacer'></span>The Way</span></h2>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="card ">
					<a href="#">
						<div class="event-card-img">
							<img data-src="holder.js/100px280/thumb" alt="100%x280" style="height: auto; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16219da9de2%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16219da9de2%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.23333358764648%22%20y%3D%22148.4%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
							<h2><span>Sponsor<span class='spacer'></span><br /><span class='spacer'></span>Supporter</span></h2>
						</div>
					</a>
				</div>
			</div>




			<div class="clearfix">
			</div>
		</div>

	</div>
	@endforeach

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

	$(function() {

		$("h2")
		.wrapInner("<span>")

		$("h2 br")
		.before("<span class='spacer'>")
		.after("<span class='spacer'>");

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