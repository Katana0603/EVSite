@extends('frontend.layout.app')

@section('title')

Title
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12 col-12 center">
		<h1 cl>{{ __('template.news.title') }}</h1><small>{{ __('template.news.subtitle') }}</small>
	</div>

	<div class="col-12">
		@foreach ($news as $singleNews)

		<div class="box">
			<div class="row">
				<div class="col-12">
					<a href="{{  route('news.show',['id' => $singleNews->id]) }}">
						<div class="center">
							<h3>{{ $singleNews->title }}</h3>
						</div>
					</a>
					<div class="right ">
						<small class="news-date">{{ date("d.m.Y H:i:s",strtotime($singleNews->updated_at)) }}</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class=" col-xs-12 col-12">
					{!!($singleNews->content) !!}
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-12">
					<div class="right">
						<a href="{{  route('news.show',['id' => $singleNews->id]) }}">
							{{ __('template.news.comments') }}
							{{ $singleNews->comments->count() }}
						</a>
						@if (Auth::check())
						@can('News-Admin')
						<a href="{{ route('news.edit', $singleNews->id) }}" target="_blank"><span class="fa fa-edit"></span></a>
						@endif
						@endcan
					</div>
				</div>
			</div>
		</div>
		@endforeach

		{{ $news->links() }}
	</div>
</div>
@endsection