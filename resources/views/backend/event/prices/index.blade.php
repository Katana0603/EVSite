{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event Prices')

@section('content-header')

<section class="content-header">
	<h1>
		Event
		<small>Create</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')


@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminEvent");
		tag.className += " active";
	});
</script>

@append


@section('css')

@append