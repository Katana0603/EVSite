@extends('frontend.layout.app')

@section('title')

Media

@endsection

@section('content')


<h2 class="center">Media</h2>

<div class="box">


	<div class="row">
		<div class="col-12">
			<select class="form-control select2" name="choose-gallery" id="choose-gallery" onchange="GallerySelectSwitch()">
				@foreach ($vars as $var)
				<option value="{{ $var->dir }}">{{ $var->dir }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		@forelse ($vars as $var)

		<div class="col-md-12" id="{{ $var->dir }}-gallery">
			<h2 class="center">{{ $var->dir }}</h2>
			<hr>
			<div class="gallery" id="{{ $var->dir }}"> 
				@forelse ($var->files as $file)
				<a href="{{ asset('storage/media_folder/' .$file) }}"><img src="{{ asset('storage/media_folder/' . $file) }}" alt="img not found" title="{{ $file }}"></a>
				@endforeach
				<div class="clear"></div>
			</div>
		</div>
		@endforeach
	</div>
</div>

</div>
@endsection

@section('styles')

<link href="{{ asset('lightbox/lightbox.css') }}" rel="stylesheet" type="text/css">
@append

@section('scripts')

<script type="text/javascript" src="{{ asset('lightbox/lightbox.js') }}"></script>

@forelse ($vars as $var)
<script>

	$(function(){
		var ${{$var->dir}} = $('#{{ $var->dir }} a').simpleLightbox();

	});
</script>
@endforeach

<script type="text/javascript">
	function GallerySelectSwitch()
	{
		var e = document.getElementById("choose-gallery");
		var $selectedItem = e.options[e.selectedIndex].value;

		var optionValues = [];

		$('#choose-gallery option').each(function() {

			var x =  document.getElementById($(this).val() + "-gallery");

			x.style.display = "none";
			
		});

		$selectedDiv = document.getElementById(($selectedItem) + "-gallery");

		$selectedDiv.style.display = "block";

	}

</script>
@append