{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| StartUpNews')

@section('content-header')

<section class="content-header">
	<h1>
		Start Up News
		<small>in the Login Screen</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>
@endsection

@section('content')

@if (isset($startUpNews))

{{ Form::open(array('route' => ['admin.startUpNews.store', $startUpNews->id])) }}
@else

{{ Form::open(array('route' => ['admin.startUpNews.store'])) }}
@endif
<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="form-group">

			<textarea id="contentEditor" name="text" rows="10" cols="80"  required maxlength="100">
				@isset ($startUpNews->text)

				{!! $startUpNews->text !!}
				@endisset
				
			</textarea>
			<small>Max Lenght 100 Chars

			</div>
		</div>
	</div>


	{{ Form::submit(__('template.startUpNews.store'), array('class' => 'btn btn-success btn-lg btn-block')) }}
	{{ Form::close() }}



	@endsection

	@section('scripts')

	<!-- TinyMCE -->
	@include('backend.admin.layout._partial.tinymceScripts')

	@append


