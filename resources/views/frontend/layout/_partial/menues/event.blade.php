<nav class="sub-navigation">
	<div class="desktop">
		<div class="row">
			<div class="col-12">
				<ul>
					<li class="" id="nav-general">
						<a href="{{ route('event.general') }}" target="_self" style="">

							<span>General</span>
						</a>
					</li>


					<li class="" id="nav-tickets">
						<a href="{{ route('event.tickets') }}" target="_self">

							<span>Tickets</span>
						</a>
					</li>


					<li class="" id="nav-tournaments">
						<a href="{{ route('event.tournaments') }}" target="_self" class="">

							<span>Turniere</span>
						</a>
					</li>


					<li class="" id="nav-seatplan">
						<a href="{{ route('event.seatplan') }}" target="_self" class="">

							<span>Sitzplan</span>
						</a>
					</li>


					<li class="" id="nav-user">
						<a href="{{ route('event.user') }}" target="_self" class="">

							<span>Teilnehmer</span>
						</a>
					</li>


					<li class="" id="nav-arrival">
						<a href="#" target="_self" class="disabled">

							<span>Anreise</span>
						</a>
					</li>


					<li class="" id="nav-sponsors">
						<a href="#" target="_self" class="disabled">

							<span>Sponsoren</span>
						</a>
					</li>


					<li class="" id="nav-downloads">
						<a href="#" target="_self" class="disabled">

							<span>Downloads</span>
						</a>
					</li>


					<li class="" id="nav-team">
						<a href="#" target="_self" class="disabled">

							<span>Team</span>
						</a>
					</li>


					<li class="" id="nav-halloffame">
						<a href="#" target="_self" class="disabled">

							<span>Hall of Fame</span>
						</a>
					</li>


					<li class="" id="nav-faq">
						<a href="{{ route('event.faq') }}" target="_self" class="">

							<span>FAQ</span>
						</a>
					</li>

				</ul>

			</div>
		</div>
	</div>
</nav>

@section('scripts')
<script>
	$(document).ready(function () {
    //if url contains event(fe.) -> mark id=mainnav-event
    $suburl = location.pathname.split('/')[2];


    if ($suburl == 'tickets') {
    	document.getElementById('nav-tickets').classList.add('active');
    }
    else if($suburl == 'tournaments')
    {
    	document.getElementById('nav-tournaments').classList.add('active');

    }
    else if($suburl == 'seatplan')
    {
    	document.getElementById('nav-seatplan').classList.add('active');

    }
    else if($suburl == 'user')
    {
    	document.getElementById('nav-user').classList.add('active');

    }
    else if($suburl == 'arrival')
    {
    	document.getElementById('nav-arrival').classList.add('active');

    }
    else if($suburl == 'sponsors')
    {
    	document.getElementById('nav-sponsors').classList.add('active');

    }
    else if($suburl == 'downloads')
    {
    	document.getElementById('nav-downloads').classList.add('active');

    }
    else if($suburl == 'team')
    {
    	document.getElementById('nav-team').classList.add('active');

    }
    else if($suburl == 'halloffame')
    {
    	document.getElementById('nav-halloffame').classList.add('active');

    }
    else if($suburl == 'faq')
    {
    	document.getElementById('nav-faq').classList.add('active');

    }
    else
    {

    	document.getElementById('nav-general').classList.add('active');
    }

});
</script>
@append