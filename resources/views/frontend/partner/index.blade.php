

@extends('frontend.layout.app')

@section('title')

Team

@endsection

@section('content')


<h2 class="center">{{ __('template.partner.header') }}</h2>

<div class="box center">
	{{-- {{ $team }} --}}
	<div class="row">
		<div class="col-12 col-sm-12">
			<div class="row">
				@foreach ($partners as $partner)
				<div class="col-12 col-md-4">
					<div class="col-12">
						<h3>{{ $partner->name }}</h3>
					</div>
					<div class="col-12" >
						<div class="col-12 no-padding left">
							<div class="card">
								<img src="{{ asset('storage/media/'.$partner->media_path ) }}" alt="{{ $partner->name }} img" style="width:100%" class="img-circle">
								<h1>{{ $partner->name }}</h1>
								<p class="title">{!! $partner->description !!}</p>
								@if ($partner->website)

								<a href="{{ $partner->website }}" target="_blank"><i class="fab fa-internet-explorer"></i></a>
								@endif
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection