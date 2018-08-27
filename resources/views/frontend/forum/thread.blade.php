@extends('frontend.layout.app')

@section('title')

Title
@endsection

@section('content')

<div class="">
	<h1 class="center">{{ $thread->title }}</h1>

	<small class="right">{{ date('d.m.Y',strtotime( $thread->updated_at ))}}</small>

	<div class="clearfix"></div>
</div>
<div class="box">
	<div class="row">
		<div class="col-md-4 col-12 col-xs-12 comment-leftbox">
			<div class="row">
				<div class="col-sm-12 col-12 center">
					<a href="{{ route('user.index', $thread->author_id) }}">
						<img src="{{ asset('storage/media/'.$thread->user->avatar ) }}" alt="userpic">
					</a>
				</div>

				<div class="col-sm-12 col-12 col-xs-6" >
					<div class="thread-username center">
						{{ $thread->user->username }}
					</div>
					<div class="row media-hidden">
						<div class="col-sm-4 col-4 col-xs-4 no-gutters">
							<label for="experiencepoints">{{ __('template.user.experiencepoints') }}</label>
						</div>
						<div class="col-sm-4 col-4 col-xs-8 no-gutters">
							{{ $thread->user->experiencepoints }}
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-4 no-gutters">
							{{-- <label for="level">{{ __('template.user.level') }}</label> --}}
						</div>
						<div class="col-sm-8 col-8 no-gutters">
							{{-- {{ $thread->user->level->description }} --}}
						</div>
					</div>
				</div>
			</div>
			<div class="btn-group">
{{-- 				<button>{{ $thread->likes }}<span class="fa fa-thumbs-up"></span></button>
				<button>{{ $thread->likes }}<span class="fa fa-thumbs-down"/></button>
				--}}
				@if (Auth::check())
				@if (Auth::user()->can('Forum-Admin'))
				<form action="{{ route('forum.deleteThread',['id' => $thread->subcat_id, 'threadId' => $thread->id]) }}" method="POST">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
					<button class="media-trash-btn"><span class=" button btn  fa fa-trash"></span></button>
				</form>
				@endif
				@if (Auth::user()->can('Forum-Admin') || $thread->user->id == Auth::user()->id)
				<a href="{{ route('forum.editThread', ['id' => $thread->subcat_id, 'threadId' => $thread->id]) }}">
					<span class="button btn fa fa-edit">
					</span>
				</a>
				@endif


				@endif
			</div>

		</div>

		<div class="col-md-8 col-xs-12">
			{!! $thread->content!!}
		</div>
	</div>
</div>

@if (Auth::check())
<div class="box">
	<div class="row">

		<div class="col-sm-12">
			<h4>{{ __('template.forum.createComment') }}</h4>
			<form method="POST" action="{{ route('forum.storePost',['id' => $thread->subcat_id, 'threadId' => $thread->id]) }}">
				{{ csrf_field() }}

				<textarea class="form-control richTextBox" data-name="content"  name="content" id="contentEditor" required>

				</textarea> 

				<button type="submit" class="button btn-success btn-block"><span class="fa fa-plus"></span></button>
			</form>
		</div>
	</div>
</div>
@endif
<hr>

@foreach ($thread->posts as $post)

<div class="box">
	<div class="row ">
		<div class="col-sm-3 no-gutters comment-leftbox">
			<div class="row comment-userpanel no-gutters">

				<div class="col-sm-12 col-12 col-xs-6 no-gutters center">
					<a href="{{ route('user.index', $post->user->id) }}">
						<img src="{{ asset('storage/media/'.$post->user->avatar ) }}" class="avatar img-circle" alt="Admin avatar">
					</a>
				</div>

				<div class="col-sm-12 col-xs-6 no-gutters" >
					<div class="no-gutters thread-username center">
						{{  $post->user->username}}
					</div>
					<div class="row no-gutters media-hidden">
						<div class="col-sm-5 col-xs-4 no-gutters">
							<label for="experiencepoints">{{ __('template.user.experiencepoints') }}</label>
						</div>
						<div class="col-sm-7 col-xs-8 no-gutters">
							{{ $post->user->experiencepoints }}
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-sm-5 col-xs-4 no-gutters">
							{{-- <label for="level">{{ __('template.user.level') }}</label> --}}
						</div>
						<div class="col-sm-7 col-xs-8 no-gutters">
							{{-- {{ $post->user->level->description }} --}}
						</div>
					</div>
				</div>
			</div>

			<div class="row no-gutters">
				@if (Auth::check())

				<div class="col-xs-6 no-gutters"> 
					@if (Auth::user()->can('Forum-Admin')  || $post->user->id == Auth::user()->id)
					<form action="{{ route('forum.deletePost',['id' => $thread->subcat_id, 'threadId' => $thread->id, 'postId' => $post->id]) }}" method="POST">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button class="media-trash-btn"><span class="fa fa-trash"></span></button>
					</form>

					@endif
				</div>

				<div class="col-xs-6 no-gutters"> 
					@if (Auth::user()->can('Forum-Admin')  || $post->user->id == Auth::user()->id)
					<a href="{{ route('forum.editPost', ['id' => $thread->subcat_id, 'threadId' => $thread->id, 'postId' => $post->id]) }}">
						<span class="button fa fa-edit">
						</span>
					</a>

					@endif
				</div>
				@endif
			</div>

		</div>
		<div class="col-sm-8">
			<div class="row">
				<div class=" col-12 right">
					<small class="right">{{ date('d.m.Y',strtotime($post->updated_at)) }}</small>
					{{-- <small>{{ $post->updated_at }}</small> --}}
				</div> 
			</div>

			{!! $post->content!!}
		</div>
	</div>
</div>
@endforeach

{!! $thread->posts !!}
@endsection


@section('scripts')

<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')

@append