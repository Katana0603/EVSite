{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Sponsor Create')

@section('content-header')

<section class="content-header">
	<h1>
		Sponsor
		<small>Create</small>
	</h1>
	<ol class="breadcrumb">
{{--    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => 'eventsponsoren.store', 'files' => true)) }}
<div class="form-group">
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }}

</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('homepage', 'Homepage') }}
			{{ Form::text('homepage', null, array('class' => 'form-control')) }}

		</div>
		<div class="form-group">
			{{ Form::label('event', 'Event') }}
			<select class="form-control" name="event">
				@forelse ($events as $event)
				<option value="{{ $event->id }}">{{$event->name }}</option>
				@endforeach         
			</select>
		</div>
		<div class="form-group">
			{{ Form::label('text', 'Text') }}
			{{ Form::textarea('text', null, array('class' => 'form-control')) }}

		</div>

	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('email', 'Email') }}
			{{ Form::text('email', null, array('class' => 'form-control', 'required' => 'required')) }}
		</div>

		<div class="form-group">
			{{ Form::label('Logo', 'Logo') }}
			<input type='file' id="inputFile" name="inputFile" accept="image/*" />
			<img id="image_upload_preview" src="{{ asset('img/preview.png') }}" alt="your image" class="mapImage" />
		</div>
	</div>
</div>

{{ Form::submit('Create Sponsor', array('class' => 'btn btn-success btn-lg btn-block')) }}
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