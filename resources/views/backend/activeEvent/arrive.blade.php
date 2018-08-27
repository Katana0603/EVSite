{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event -  Arrive')

@section('content-header')

<section class="content-header">
	<h1>
		{{ $event->name }}
		<small>Arrive</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>

@endsection

@section('content')
{{-- If arrive show articel -> if no arrive then show content input box in Form arrive store with articel Store..on Save save articel and articel_id in arrive ...  set articel to invisible(hidden) --}}
@if ($arrive)
<div class="form-group">
	{{ Form::label('content', 'Content') }}
	<textarea id="contentEditor" name="content" rows="10" cols="80"  required>
		{!! $arrive->content !!}
	</textarea>
</div>

@else

@endif

@endsection



@section('modals')

@append

@section('scripts')


<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')


<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminEvent");
		tag.className += " active";
	});
</script>


@append

