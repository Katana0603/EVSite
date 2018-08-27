{{-- Party Status | Teamspeak |  --}}

<div class="col-xs-12 no-gutters">

{{-- 	@if ( setting('right-sitebar.rightsitebarstatus') == 1)

	@if (setting('right-sitebar.partyboxstatus'))
	<div class="sitebarbox">
		<div class="sitebarbox-header">
			{{ __('template.rightsitebar.partyHeader') }}
		</div>
		<div class="sitebarbox-content">
			{{ __('template.rightsitebar.partyContent') }}
		</div>
	</div>
	@endif
	@if (setting('right-sitebar.teamspeakboxstatus'))
	<div class="sitebarbox">
		<div class="sitebarbox-header">
			{{ __('template.rightsitebar.teamspeakHeader') }}
		</div>
		<div class="sitebarbox-content">
			
			{{ __('template.rightsitebar.teamspeakContent') }}
		</div>
	</div>
	@endif
	@endif --}}
</div>




@section('scripts')
{{-- <script>
	var rightIndex = 0;
	rightCarousel();

	function rightCarousel() {
		var i;
		var x = document.getElementsByClassName("sponsorLogo");
		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";  
		}
		rightIndex++;
		if (rightIndex > x.length) {rightIndex = 1}    
			x[rightIndex-1].style.display = "block";  
		setTimeout(rightCarousel, 9000);    
	}
</script> --}}
@append