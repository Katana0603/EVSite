@extends('frontend.layout.app')

@section('title')

Calendar

@endsection

@section('content')
<div class="container">

	<div class="panel panel-primary">

		<div class="panel-heading"></div>

		<div class="panel-body">    

			{!! Form::open(array('route' => 'calendar.events.add','method'=>'POST','files'=>'true')) !!}
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					@if (Session::has('success'))
					<div class="alert alert-success">{{ Session::get('success') }}</div>
					@elseif (Session::has('warnning'))
					<div class="alert alert-danger">{{ Session::get('warnning') }}</div>
					@endif

				</div>

				<div class="col-xs-4 col-sm-4 col-md-4">
					<div class="form-group">
						{!! Form::label('event_name','Event Name:') !!}
						<div class="">
							{!! Form::text('event_name', null, ['class' => 'form-control']) !!}
							{!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="col-xs-3 col-sm-3 col-md-3">
					<div class="form-group">
						{!! Form::label('start_date','Start Date:') !!}
						<div class="">
							{!! Form::date('start_date', null, ['class' => 'form-control']) !!}
							{!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="col-xs-3 col-sm-3 col-md-3">
					<div class="form-group">
						{!! Form::label('end_date','End Date:') !!}
						<div class="">
							{!! Form::date('end_date', null, ['class' => 'form-control']) !!}
							{!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
					{!! Form::submit('Add Event',['class'=>'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::close() !!}

		</div>

	</div>

	<div class="panel panel-primary">
		<div class="panel-heading"></div>
		<div class="panel-body" >
			{!! $calendar_details->calendar() !!}
		</div>
	</div>

</div>
@endsection


@section('css')

{{-- datetimepicker --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/datetimepicker.css')}}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

@append


@section('scripts')



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

{!! $calendar_details->script() !!}

{{-- Datetimepicker --}}
<script src="{{ asset('js/admin/datetimepicker.js')}}"></script>

<script>

	jQuery.datetimepicker.setLocale('de');

	jQuery('#start_date').datetimepicker({
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

	jQuery('#end_date').datetimepicker({
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



@include('backend.admin.layout._partial.dateRangePickerScripts')


@append