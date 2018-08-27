@extends('frontend.layout.app')

@section('title')

Title
@endsection

@section('content')

<div class="center">
	<h1 class="center">{{ __('template.forum.title') }}</h1><small>{{ __('template.forum.subtitle') }}</small>
</div>
<div class="box">
	<div class="row">
		<div class="col-xs-12 col-12">

			<div class="row">
				<div class="col-xs-12  col-12 center">
					<b class="center">{{ $sub->title }}</b>
				</div>
			</div>

			<div class="row forumHeader center">
				<div class="col-xs-2 col-2 col-xs-2 table-col media-hidden">
					{{ __('template.forum.tableHeader.read') }}
				</div>
				<div class="col-sm-4 col-12 col-xs-7 table-col">
					{{ __('template.forum.tableHeader.subcategorie') }}
				</div>

				<div class="col-sm-2 col-2 table-col media-hidden">
					{{ __('template.forum.tableHeader.countPosts') }}
				</div>
				<div class="col-sm-3 col-3 hidden-xs table-col media-hidden">
					{{ __('template.forum.tableHeader.lastPost') }}
				</div>
			</div>

			@foreach ($sub->threads as $thread)
			<div class="row">
				<a href="{{ route('forum.thread',['id' => $sub->id,'threadId' => $thread->id]) }}" class="width100">
					<div class="col-xs-2 col-2 col-xs-2 left media-hidden">
						-
					</div>
					<div class="col-sm-4 col-12 col-xs-7 table-col left">
						{{ $thread->title }}
					</div>

					<div class="col-sm-2 col-2 table-col left media-hidden">
						{{ $thread->countPosts }}
					</div>
					<div class="col-sm-3 col-3 hidden-xs table-col left media-hidden">
						...
					</div>
				</a>
			</div>

			@endforeach
			<hr>
			@if (Auth::check())
			<div class="col-xs-6">
				<a href="{{ route('forum.createThread', $sub->id) }}">{{  __('template.forum.buttons.createThread')}}</a>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection