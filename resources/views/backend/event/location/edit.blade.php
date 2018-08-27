{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Location Edit')

@section('content-header')

<section class="content-header">
	<h1>
		Location
		<small>Edit</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => ['eventlocation.update',$location->id], 'files' => true, 'method' => 'PUT')) }}
<div class="form-group">
	{{ Form::label('name', 'Location Name') }}
	{{ Form::text('name', $location->name, array('class' => 'form-control', 'required' => 'required')) }}

</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::textarea('description', $location->description, array('class' => 'form-control')) }}

		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('waydescription', 'Waydescription') }}
			{{ Form::textarea('waydescription', $location->waydescription, array('class' => 'form-control')) }}

		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('street', 'Street') }}
			{{ Form::text('street', $location->street, array('class' => 'form-control')) }}

		</div>
		<div class="form-group">
			{{ Form::label('city', 'City') }}
			{{ Form::text('city', $location->city, array('class' => 'form-control')) }}

		</div>
		<div class="form-group">
			{{ Form::label('zip', 'Zip') }}
			{{ Form::text('zip', $location->zip, array('class' => 'form-control')) }}

		</div>
		<div class="form-group">
			{{ Form::label('country', 'Country') }}
			{{ Form::text('country', $location->country, array('class' => 'form-control')) }}

		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('latitude', 'Latitude') }}
			{{ Form::text('latitude',$location->latitude, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('longitude', 'Longitude') }}
			{{ Form::text('longitude',$location->longitude, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('Map', 'Map') }}
			<input type='file' id="inputFile" name="inputFile" accept="image/*" />
			<img id="image_upload_preview" src="{{ asset('storage/media/'. $location->media_path) }}" alt="your image" class="mapImage" />
		</div>
	</div>
</div>


{{ Form::submit('Update Location', array('class' => 'btn btn-success btn-lg btn-block')) }}
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