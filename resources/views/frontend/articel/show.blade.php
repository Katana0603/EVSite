@extends('frontend.layout.app')

@section('title')

{{ $articel->title }}
@endsection

@section('content')


<div class="col-xs-12 col-12">
	<div class="box">
		<div class="row">
			<div class="col-12">
				<div class="">
					<h1 class="center">{{$articel->title }}</h1>
				</div>
				<div class="right ">
					<small class="news-date">{{ date("d.m.Y H:i:s",strtotime($articel->updated_at)) }}</small>
				</div>
				<hr>
				<div class="col-xs-12  col-12">
					{!!($articel->content) !!}
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-12">
{{-- 				<div class="row">
					<div class="col-sm-2 col-2 col-xs-6">

						@if (Auth::check())
						<form action="{{ route('articel.like', $articel->id) }}" method="POST" class="left">
							{{ csrf_field() }}
							<button class=""><span class="fa fa-thumbs-up like-btn">{{ $articel->likes }}</span></button>
						</form>
						<form action="{{ route('articel.dislike', $articel->id) }}" method="POST" class="right">
							{{ csrf_field() }}
							<button class=""><span class="fa fa-thumbs-down dislike-btn">{{ $articel->dislikes }}</span></button>
						</form>

						@endif
					</div>


				</div> --}}
				<div class="row">
					<div class="col-12 col-md-4">

						@if (Auth::check())
						@can('Articel-Admin')
						<a href="{{ route('articel.edit', $articel->id) }}" target="_blank" class="btn"><span class="fa fa-edit"></span></a>
						
						@endcan
						@endif
						{{ __('template.articel.comments') }}
						{{ $articel->commentsCount }}
					</div>
				</div>

				<div class="clearfix">
				</div>
			</div>
		</div>
	</div>
	@if ( $articel->commentary == 1)

	@if (Auth::check())
	<div class="box">
		<form method="POST" action="{{ route('articel.storeComment',['id' => $articel->id]) }}">
			{{ csrf_field() }}

			<textarea class="form-control richTextBox" data-name="content"  name="content" id="content">

			</textarea>
			<button type="submit" class="right btn btn-block btn-success"><span class="fa fa-plus"></span></button>
			<div class="clearfix"></div>
		</form>
	</div>
	@endif

	@foreach ($articel->comments as $comment)


	<div class="box">
		<div class="row ">
			<div class="col-sm-3  comment-leftbox">
				<div class="row comment-userpanel no-gutters">

					<div class="col-sm-12 col-12 center no-gutters">
						<a href="{{ route('user.index', $comment->user->id) }}">
							<img src="{{ asset('storage/media/'.$comment->user->avatar) }}" alt="user-avatar">
						</a>
					</div>
					<div class="col-sm-12 col-xs-6 no-gutters" >
						<div class="row no-gutters center">
							<p>{{  $comment->user->username}}</p>
						</div>
						<div class="row no-gutters media-hidden">
							<div class="col-sm-5 col-xs-4 no-gutters">
								<label for="experiencepoints">{{ __('template.user.experiencepoints') }}</label>
							</div>
							<div class="col-sm-7 col-xs-8 no-gutters">
								{{ $comment->user->experiencepoints }}
							</div>
						</div>
						<div class="row no-gutters media-hidden">
							<div class="col-sm-5 col-xs-4 no-gutters">
								<label for="level">{{ __('template.user.level') }}</label>
							</div>
							<div class="col-sm-7 col-xs-8 no-gutters">
								{{-- {{ $comment->user->level->description }} --}}
							</div>
						</div>
					</div>
				</div>
				<div class="row no-gutters">
					@if (Auth::check())
					@if (Auth::user()->can('Articel-Admin') || $comment->user->id == Auth::user()->id)

					<form action="{{ route('articel.deleteComment', $comment->id) }}" method="POST">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}

						<button class="right media-trash-btn" ><span class="fa fa-trash"></span></button>
						<div class="clearfix"></div>
					</form>
					<a href="{{ route('articel.editComment', ['id' => $comment->articel_id, 'commentId' => $comment->id]) }}" class=""><span class="fa fa-edit"></span></a>
					@endif
					@endif
				</div>
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-12 right">

						{{ date("d.m.Y H:i:s",strtotime($comment->updated_at)) }}
					</div>
				</div>
				<div class="row no-gutters">

					<div class="col-xs-12">
						{!! $comment->content !!}
					</div>
				</div> 
			</div>
		</div>

		@endforeach

		{{ $articel->comments->links() }}
		@endif
	</div>



	@endsection

	@section('scripts')

	<!-- TinyMCE -->

	<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

	<script>
		tinymce.init({
			selector: '#content',
			theme: 'modern',
			skin: "charcoal",
			plugins: [
			'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
			'searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking',
			'save table contextmenu directionality emoticons template paste textcolor giphy youtube'
			],
			content_css: 'css/content.css',
			toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image giphy youtube | print preview media | forecolor backcolor emoticons'
		});

	</script>

	@append