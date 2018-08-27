{{-- create.blade.php --}}

@extends('backend.layout.app')


@section('title', '| Create New Partner')

@section('content')
<div class="row">
	<div class="col-md-12">

		<h1>Create New Partner</h1>

		{{-- Using the Laravel HTML Form Collective to create our form --}}
		{{ Form::open(array('route' => 'partner.store', 'files' => true)) }}

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					{{ Form::label('name', 'Name') }}
					{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }}

				</div>
				<div class="form-group">
					{{ Form::label('description', 'Description') }}
					<textarea id="contentEditor" name="description" rows="10" cols="80"  required>
					</textarea>
				</div>

			</div>
			<div class="col-sm-6">
				<div class="form-group">
					{{ Form::label('website', 'Website') }}
					{{ Form::text('website', null, array('class' => 'form-control')) }}

				</div>
				<div class="form-group">
					{{ Form::label('Map', 'Map') }}
					<input type='file' id="inputFile" name="inputFile" accept="image/*" />
					<img id="image_upload_preview" src="{{ asset('img/preview.png') }}" alt="your image" class="mapImage" />
				</div>
			</div>
		</div>
	</div>
	<!-- /.form group -->

	{{ Form::submit('Create Partner', array('class' => 'btn btn-success btn-lg btn-block')) }}
	{{ Form::close() }}
</div>

@endsection

@section('scripts')

<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')

<script>

	jQuery.datetimepicker.setLocale('de');

	jQuery('#datetimepicker').datetimepicker({
		i18n:{
			de:{
				months:[
				'Januar','Februar','März','April',
				'Mai','Juni','Juli','August',
				'September','Oktober','November','Dezember',
				],
				dayOfWeek:[
				"So.", "Mo", "Di", "Mi", 
				"Do", "Fr", "Sa.",
				]
			}
		},
		step:30,
		weeks:true,
		format:'d.m.Y H:i'
	});
</script>


<script>

	jQuery('#datetimepicker2').datetimepicker({
		i18n:{
			de:{
				months:[
				'Januar','Februar','März','April',
				'Mai','Juni','Juli','August',
				'September','Oktober','November','Dezember',
				],
				dayOfWeek:[
				"So.", "Mo", "Di", "Mi", 
				"Do", "Fr", "Sa.",
				]
			}
		},
		step:30,
		weeks:true,
		format:'d.m.Y H:i'
	});
</script>



<script>
	$(document).ready(function(){
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-red',
			radioClass: 'iradio_square-red',
			increaseArea: '20%',
		});
	});
</script>

@include('backend.admin.layout._partial.dateRangePickerScripts')


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
@endsection