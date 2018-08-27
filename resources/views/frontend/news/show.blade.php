@extends('frontend.layout.app')

@section('title')

{{$news->title }}
@endsection

@section('content')


<div class="">
	<div class="box">
		<div class="row">

			<div class="col-12">
				<div class="">
					<h1 class="center">{{$news->title }}</h1>
				</div>

				<hr>
				<div class="right ">
					<small class="news-date">{{ date("d.m.Y H:i:s",strtotime($news->updated_at)) }}</small>
				</div>
				<div class="col-xs-12 col-12">
					{!!($news->content) !!}
				</div>
			</div>
		</div>
		<hr>

		<div class="col-md-6">
			@if (Auth::check())
			@can('News-Admin')
			<a href="{{ route('news.edit', $news->id) }}" target="_blank"><span class="fa fa-edit"></span></a>
			@endif
			@endcan

			{{ __('template.news.comments') }}
			{{ $news->comments->count() }}

			@if (Auth::check())
			@can('News-Admin')
			<a href="{{ url('admin/news/'.$news->id.'/edit') }}" target=_blank><span class="fa fa-pencil"></span></a>
			@endif
			@endcan
		</div>
	</div>
</div>

@if (Auth::check())
<div class="box">
	<form method="POST" action="{{ route('news.storeComment',['id' => $news->id]) }}">
		{{ csrf_field() }}

		<textarea class="form-control richTextBox" data-name="content"  name="content" id="content">

		</textarea>
		<button type="submit" class="right btn btn-block btn-success"><span class="fa fa-plus"></span></button>
		<div class="clearfix"></div>
	</form>
</div>
@endif

{{-- Comments --}}
@foreach ($news->comments as $comment)
<div class="box">
	<div class="row ">
		<div class="col-sm-3 no-gutters comment-leftbox">
			<div class="row comment-userpanel no-gutters">

				<div class="col-sm-12 no-gutters center">
					<a href="{{ route('user.index', $comment->user->id) }}">
						<img src="{{ asset('storage/media/'.$comment->user->avatar) }}" class="avatar" alt="Admin avatar">
					</a>
				</div>
				<div class="col-sm-12 no-gutters center" >
					{{  $comment->user->username}}
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
				@if (Auth::user()->can('News-Admin') || $comment->user->id == Auth::user()->id)

				<form action="{{ route('news.deleteComment', $comment->id) }}" method="POST">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}

					<button class="media-trash-btn" ><span class="fa fa-trash"></span></button>

				</form>

				<a href="{{ route('news.editComment', $comment->id) }}"><span class="fas fa-edit"></span></a>

				@endif
				@endif
			</div>
		</div>
		<div class="col-md-9">
			<div class="row ">
				<div class=" col-12 right">

					{{ date('d.m.Y H:i',strtotime($comment->updated_at)) }}
				</div>
			</div>
			<div class="row no-gutters">

				<div class="col-xs-12 comment-content">
					{!! $comment->content !!}
				</div>
			</div> 
		</div>
	</div> 
</div>


@endforeach
{{ $news->comments->links() }}
@endsection


@section('scripts')

<!-- TinyMCE -->

<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

<script>
	tinymce.init({
		selector: '#content',
		theme: 'modern',
		skin: "test",
		plugins: [
		'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		'searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking',
		'save table contextmenu directionality emoticons template paste textcolor giphy youtube'
		],
		content_css: 'css/content.css',
		toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image giphy youtube | print preview media | forecolor backcolor emoticons'
	});

</script>

<script>
	tinymce.init({
		selector: '#content2',
		theme: 'modern',
		skin: "test",
		plugins: [
		'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		'searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking',
		'save table contextmenu directionality emoticons template paste textcolor giphy youtube'
		],
		content_css: 'css/content.css',
		toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image giphy youtube | print preview media | forecolor backcolor emoticons'
	});

</script>

<script>
	function openEditCommentModal($commentId)
	{

		alert("test");

		document.getElementById("commentID").value = $commentId;

		$("#editCommentModal").modal();
	}
</script>
@append