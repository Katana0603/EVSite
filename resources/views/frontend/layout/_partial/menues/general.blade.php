<nav class="sub-navigation" id="nav-general">
	<div class="desktop">
		<div class="row">
			<div class="col-12">
				<ul>				
					<li class="" id="nav-articel">
						<a href="{{ route('articel.index') }}" target="_self" style="">

							<span>Articel</span>
						</a>
					</li>
{{-- 					<li class="" id="nav-tickets">
						<a href="{{ route('tickets.index') }}" target="_self" style="" class="disabled">

							<span>Tickets</span>
						</a>
					</li> --}}

					<li class="" id="nav-city">
						<a href="{{ route('city.index') }}" target="_self" style="">

							<span>Cuxhaven</span>
						</a>
					</li>


					<li class="" id="nav-downloads">
						<a href="{{ route('download.index') }}" target="_self" style="">

							<span>Downloads</span>
						</a>
					</li>


					<li class="" id="nav-team">
						<a href="{{ route('team.index') }}" target="_self" style="">

							<span>Team</span>
						</a>
					</li>


					<li class="" id="nav-teamspeak">
						<a href="{{ route('teamspeak.index')}}" target="_self" style="" class="disabled">

							<span>Teamspeak</span>
						</a>
					</li>

					<li class="" id="nav-partner">
						<a href="{{ route('partner.general') }}" target="_self" style="" class="">

							<span>Partner</span>
						</a>
					</li>


					<li class="" id="nav-media">
						<a href="{{ route('media.index') }}" target="_self" style="" class="">

							<span>Media</span>
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
    $suburl = location.pathname.split('/')[1];


    if ($suburl == 'articel') {
    	document.getElementById('nav-articel').classList.add('active');
    }
    else if($suburl == 'tickets')
    {
    	document.getElementById('nav-tickets').classList.add('active');

    }
    else if($suburl == 'city')
    {
    	document.getElementById('nav-city').classList.add('active');

    }
    else if($suburl == 'downloads')
    {
    	document.getElementById('nav-downloads').classList.add('active');

    }
    else if($suburl == 'team')
    {
    	document.getElementById('nav-team').classList.add('active');

    }
    else if($suburl == 'partner')
    {
    	document.getElementById('nav-partner').classList.add('active');

    }
    else if($suburl == 'teamspeak')
    {
    	document.getElementById('nav-teamspeak').classList.add('active');

    }
    else if($suburl == 'media')
    {
    	document.getElementById('nav-media').classList.add('active');

    }
    else
    {

    	document.getElementById('nav-general').classList.add('active');
    }

});
</script>
@append