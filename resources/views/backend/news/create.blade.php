{{-- create.blade.php --}}

@extends('backend.layout.app')


@section('title', '| Create New News')

@section('content')
<div class="row">
	<div class="col-md-12">

		<h1>Create New News</h1>

		{{-- Using the Laravel HTML Form Collective to create our form --}}
		{{ Form::open(array('route' => 'news.store')) }}

		<div class="form-group">
			{{ Form::label('user', 'User') }}
			<div class="input-group">
				<select name="userSelect" class="form-control">
					@foreach ($creationUser as $user)
					<option value="{{ $user->id }}">{{ $user->username }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('title', 'Title') }}
			{{ Form::text('title', null, array('class' => 'form-control', 'required' => 'required')) }}

		</div>
		<div class="form-group">
			{{ Form::label('content', 'Content') }}
			<textarea id="contentEditor" name="content" rows="10" cols="80"  required >
			</textarea>
		</div>

		{{-- DatePicker --}}

		<div class="col-sm-6 no-gutters">
			<div class="form-group">
				<label>Start Date:</label>

				
				<input id="datetimepicker" type="text" name="start_datetime"  required>
				<!-- /.input group -->
			</div>
			<!-- /.form group -->
		</div>
		<div class="col-sm-6 no-gutters">
			<div class="form-group">
				<label>End Date:</label>

				
				<input id="datetimepicker2" type="text" name="end_datetime"  required>
				<!-- /.input group -->
			</div>
			<!-- /.form group -->
		</div>



		<!-- /.input group -->
		<div class="col-md-3  no-gutters">
			{{-- Status --}}
			<div class="form-group">

				{{ Form::label('status', 'Status') }}
				<div class="input-group">
					<input type="checkbox" name="statusCheck" checked />
				</div>
			</div>
		</div>

		<div class="col-md-3 no-gutters">
			{{-- comments --}}
			<div class="form-group">

				{{ Form::label('comments', 'Comments') }}
				<div class="input-group">
					<input type="checkbox" name="commentsCheck" checked>
				</div>
			</div>

		</div>
		{{-- orderNumber --}}
		<div class="form-group">
			{{ Form::label('orderNumber', 'OrderNumber') }}
			<div class="input-group">
				<select name="orderNumber">
					@for ($i = 1; $i <= $news->count()+1; $i++)
					<option value="{{ $i }}">{{ $i }}</option>
					@endfor               
				</select>
			</div>
		</div>
	</div>
	<!-- /.form group -->

	{{ Form::submit('Create News', array('class' => 'btn btn-success btn-lg btn-block')) }}
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
@endsection