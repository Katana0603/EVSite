@extends('frontend.layout.app')

@section('title')

Title
@endsection

@section('content')

<div class="center">
	<h1 class="center">{{ __('template.forum.title') }}</h1><small class="center">{{ __('template.forum.subtitle') }}</small>
</div>

<div class="box">
	<div class="row">
		<div class="col-xs-12 col-12">
			@foreach ($forum as $cat)
			<div class="box">
				<div class="row">
					<div class="col-xs-12 col-12 center">
						<b >{{ $cat->title }}</b>
						<hr />
					</div>
				</div>
				<div class="row forumHeader"> 
					<div class="col-xs-2 col-1 col-sm-1 table-col hidden-sm media-hidden">
						{{ __('template.forum.tableHeader.read') }}
					</div>
					<div class="col-sm-4 col-12 col-xs-7 table-col ">
						{{ __('template.forum.tableHeader.subcategorie') }}
					</div>
					<div class="col-sm-2 col-2 hidden-sm table-col media-hidden">
						{{ __('template.forum.tableHeader.countThreads') }}
					</div>
					<div class="col-sm-2 col-2 hidden-xs table-col media-hidden">
						{{ __('template.forum.tableHeader.countPosts') }}
					</div>
					<div class="col-sm-3 col-3 hidden-xs table-col media-hidden">
						{{ __('template.forum.tableHeader.lastPost') }}
					</div>
				</div>
				@foreach ($cat->sub as $sub)
				<div class="row">

					<a href="{{ route('forum.sub', $sub->id) }}" class="width100">

						<div class="col-xs-2 col-1 col-sm-1 hidden-sm hidden-xs left media-hidden">
							-
						</div>
						<div class="col-sm-4 col-12 col-xs-7 table-col left">
							{{ $sub->title }}
						</div>
						<div class="col-sm-2 col-2 hidden-sm table-col left media-hidden">
							{{ $sub->countThreads }}
						</div>
						<div class="col-sm-2 col-2 hidden-xs table-col left media-hidden">
							{{ $sub->countPosts }}
						</div>
						<div class="col-sm-3 col-3 hidden-xs table-col left media-hidden">
							...
						</div>
					</a>
				</div>
				@endforeach

				<hr>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection