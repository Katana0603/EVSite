@extends('frontend.layout.app')

@section('title')

Title
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12 col-12 center">
		<h1>{{ __('template.articel.title') }}</h1><small>{{ __('template.articel.subtitle') }}</small>
	</div>

	<div class="col-xs-12 col-12">
		@foreach ($articel as $singleArticel)

		<div class="box">
			<div class="row">
				<div class="col-12">
					<a href="{{  route('articel.show',['id' => $singleArticel->id]) }}">
						<div class="col-xs-12 col-12 center">
							<h3 class="center">{{ $singleArticel->title }}</h3>
						</div>
					</a>
					<div class="right ">
						<small class="news-date">{{ date("d.m.Y H:i:s",strtotime($singleArticel->updated_at)) }}</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class=" col-xs-12 col-12">
					{!!($singleArticel->content) !!}
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-12">
					<div class="right">
						<a href="{{  route('articel.show',['id' => $singleArticel->id]) }}">
							{{ __('template.articel.comments') }}
							{{ $singleArticel->comments->count() }}
						</a>
						@if (Auth::check())
						@can('Articel-Admin')
						<a href="{{ route('articel.edit', $singleArticel->id) }}" target="_blank"><span class="fa fa-edit"></span></a>
						@endif
						@endcan
					</div>
				</div>
			</div>

		</div>
		@endforeach

		{{ $articel->links() }}
	</div>
</div>


@endsection