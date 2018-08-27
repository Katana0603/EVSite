
@extends('frontend.layout.app')

@section('title')

@endsection

@section('content')

<div class="box">
	<form method="POST" action="{{ route('articel.updateComment',['id' => $comment->articel_id, 'commentId' => $comment->id]) }}">
		{{ csrf_field() }}

		<textarea class="form-control richTextBox" data-name="content"  name="content" id="content">
			{!! $comment->content !!}
		</textarea>
		<button type="submit" class="right btn btn-block btn-success"><span class="fa fa-plus"></span></button>
		<div class="clearfix"></div>
	</form>
</div>

@endsection


@section('scripts')

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