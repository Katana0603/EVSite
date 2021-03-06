@extends('frontend.layout.app')

@section('title')

Title

@endsection

@section('content')

<div class="box">
	<form method="POST" action="{{ route('forum.updateThread',['id' => $id, 'threadid' => $thread->id]) }}">
		{{ csrf_field() }}

		<div class="form-group">
			<label for="title" >{{  __('template.forum.newThread.title')}}</label>
			<input type="text" name="title" class="form-control" id="title" required value="{{ $thread->title }}">
		</div>
		<div class="form-group">
			<label for="content">
				{{  __('template.forum.newThread.content')}}
			</label>		
			<textarea class="form-control richTextBox" data-name="content"  name="content" id="contentEditor" required >{!! $thread->content !!}
			</textarea> 
		</div>
		<button type="submit" class="btn btn-success"><span class="fa fa-plus"></span></button>
	</form> 
</div>
@endsection

@section('scripts')

<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')

@append