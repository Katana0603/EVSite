{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Games Create')

@section('content-header')

<section class="content-header">
	<h1>
		{{ $game->name }}
		<small>Edit</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => ['eventGames.update',$game->id], 'files' => true, 'method' => 'PUT')) }}
<div class="form-group">
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name', $game->name , array('class' => 'form-control', 'required' => 'required')) }}

</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::textarea('description', $game->description , array('class' => 'form-control')) }}

		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('Logo', 'Logo') }}
			<input type='file' id="inputFile" name="inputFile" accept="image/*" />
			<img id="image_upload_preview" src="{{ asset('storage/media/'.$game->media_path) }}" alt="your image" class="mapImage" />
		</div>
	</div>
</div>


{{ Form::submit('Edit '. $game->name, array('class' => 'btn btn-success btn-lg btn-block')) }}
{{ Form::close() }}

@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminEvent");
		tag.className += " active";
	});
</script>

{{-- Media Upload Script --}}
<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#image_upload_preview').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#inputFile").change(function () {
		readURL(this);
	});
</script>
@append


@section('css')

@append