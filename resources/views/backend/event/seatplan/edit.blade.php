{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Seatplan Create')

@section('content-header')

<section class="content-header">
	<h1>
		Seatplan
		<small>Create</small>
	</h1>
	<ol class="breadcrumb">
{{--    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => ['eventSeatplan.update', $seatplan->id ], 'files' => true, 'method' => 'PUT')) }}
<div class="form-group">
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name', $seatplan->name, array('class' => 'form-control', 'required' => 'required')) }}

</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('active', 'Active') }}
			{{ Form::checkbox('active', null, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('event', 'Event') }}
			<select class="form-control" name="event">

				<option value="{{ $seatplan->event_id }}">{{$seatplan->event->name }}</option>
				@forelse ($events as $event)
				<option value="{{ $event->id }}">{{$event->name }}</option>
				@endforeach         
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{{ Form::label('Logo', 'Seatplan Image') }}
			<input type='file' id="inputFile" name="inputFile" accept="image/*" />
			<img id="image_upload_preview" src="{{ asset('storage/media/'. $seatplan->media_path) }}" alt="your image" class="mapImage" />
		</div>
	</div>
</div>

{{ Form::submit('Edit Seatplan', array('class' => 'btn btn-success btn-lg btn-block')) }}
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