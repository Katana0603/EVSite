{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event Create')

@section('content-header')

<section class="content-header">
	<h1>
		Location
		<small>Create</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => 'eventlocation.store', 'files' => true)) }}
<div class="form-group">
	{{ Form::label('name', 'Location Name') }}
	{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }}

</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::textarea('description', null, array('class' => 'form-control')) }}

		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('waydescription', 'Waydescription') }}
			{{ Form::textarea('waydescription', null, array('class' => 'form-control')) }}

		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('street', 'Street') }}
			{{ Form::text('street', null, array('class' => 'form-control')) }}

		</div>
		<div class="form-group">
			{{ Form::label('city', 'City') }}
			{{ Form::text('city', null, array('class' => 'form-control')) }}

		</div>
		<div class="form-group">
			{{ Form::label('zip', 'Zip') }}
			{{ Form::text('zip', null, array('class' => 'form-control')) }}

		</div>
		<div class="form-group">
			{{ Form::label('country', 'Country') }}
			{{ Form::text('country', null, array('class' => 'form-control')) }}

		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('latitude', 'Latitude') }}
			{{ Form::text('latitude',null, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('longitude', 'Longitude') }}
			{{ Form::text('longitude',null, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('Map', 'Map') }}
			<input type='file' id="inputFile" name="inputFile" accept="image/*" />
			<img id="image_upload_preview" src="{{ asset('img/preview.png') }}" alt="your image" class="mapImage" />
		</div>
	</div>
</div>


{{ Form::submit('Create Location', array('class' => 'btn btn-success btn-lg btn-block')) }}
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