@extends('frontend.layout.app')

@section('title')

@endsection

@section('content')

<div class="col-xs-12 col-12 center">
	<h1>{{ __('template.pm.newMessage.title') }}</h1><small>{{ __('template.pm.newMessage.subtitle') }}</small>
</div>

<div class="box">

	<div class="form-group">
		<label> Subject</label>
		<label class="form-control">{{ $pm->subject }}</label>
	</div>

	@foreach ($pm->messages as $message)
	@if ($message->fromUser == Auth::user()->id)

	<div class="left col-sm-8">
		<div class="box">
			<b>
				@if (!$message->fromUsr->deleted_at)
				{{ $message->fromUsr->username  }}
				@else
				{{ $message->fromUsr->username  }}(deleted)
				@endif
			</b>
			{!! $message->message !!}
			
		</div>
	</div>
	@else
	<div class="right col-sm-8">
		<div class="box message-foreign">
			<b>
				@if (!$message->fromUsr->deleted_at)
				{{ $message->fromUsr->username  }}

				@else
				{{ $message->fromUsr->username  }}(deleted)
				@endif
			</b>
			{!! $message->message !!}
		</div>
	</div>
	@endif
	@endforeach


	<div class="clearfix">
	</div>
	
	<form method="POST" action="{{ route('pm.answer.message',[$pm->id]) }}">
		{{ csrf_field() }}
		<div class="box">
			<div class="form-group">
				<label>Message:</label>
				<textarea class="form-control richTextBox" data-name="content"  name="content" id="content" required>
				</textarea>
			</div>
			<div class="form-group">
				<button class="btn btn-success btn-block">{{ __('template.pm.save') }}</button>
			</div>
		</div>
	</form>

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