{{-- NEWS | Partner | Sponsoren --}}

@if (isset($sitebarnews))
<div class="sitebarbox">
	<div class="sitebar-header" id="sitebar-news-header">
		<h3 class="center">News</h3>
	</div>
	<div class="sitebar-content center" id="sitebar-news-content">
		@foreach ($sitebarnews as $sSNews)
		<a class="subnews-header" href="{{ route('news.show', $sSNews->id) }}" > {{ $sSNews->title }}</a>
		@endforeach
	</div>
</div>
@endif

@if (isset($sitebarPartner) && $sitebarPartner->count() > 0)
<div class="sitebarbox">
	<div class="sitebar-header" id="sitebar-partner-header">
		<h3 class="center">Partner</h3>
	</div>
	<div class="sitebar-content center" id="sitebar-partner-content">
		<div id="sitebar-partner-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				@foreach ($sitebarPartner as $sPartner)
				<div class="carousel-item">
					<img class="d-block w-100 " src="{{ asset('storage/media/'.$sPartner->media_path)  }}" alt="{{ $sPartner->name }}">
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endif  

@if (isset($sitebarSponsors) && $sitebarSponsors->count() > 0)
<div class="sitebarbox">
	<div class="sitebar-header" id="sitebar-sponsor-header">
		<h3 class="center">Sponsoren</h3>
	</div>
	<div class="sitebar-content center" id="sitebar-sponsor-content">
		<div id="sitebar-sponsor-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">

				@foreach ($sitebarSponsors as $sSponsoren)
				<div class="carousel-item">
					<img class="d-block w-100 " src="{{ asset('storage/media/'.$sSponsoren->media_path)  }}" alt="{{ $sSponsoren->name }}">
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endif 



@section('scripts')

<script> 
	$(document).ready(function(){
		$("#sitebar-news-header").click(function(){
			$("#sitebar-news-content").slideToggle("slow");
		});
		$("#sitebar-partner-header").click(function(){
			$("#sitebar-partner-content").slideToggle("slow");
		});
		$("#sitebar-sponsor-header").click(function(){
			$("#sitebar-sponsor-content").slideToggle("slow");
		});

		$('#sitebar-partner-carousel').find('.carousel-item').first().addClass('active');
		$('#sitebar-sponsor-carousel').find('.carousel-item').first().addClass('active');
	});
</script>
@append
