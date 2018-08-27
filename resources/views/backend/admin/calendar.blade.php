@extends('backend.layout.app')

@section('title', '| Layout')

@section('content-header')
@endsection


@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-4">
			<!-- Trigger the modal with a button -->
			<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">+</button>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<!-- /. box -->
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Create Event</h3>
				</div>
				<div class="box-body">
					<div class="btn-group" style="width: 100%; margin-bottom: 10px;">
						<!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
						<ul class="fc-color-picker" id="color-chooser">
							<li><a class="text-blue" href="#"><i class="fa fa-square">Group</i></a></li>
							<li><a class="text-orange" href="#"><i class="fa fa-square">All</i></a></li>
							<li><a class="text-green" href="#"><i class="fa fa-square">Own</i></a></li>
						</ul>
					</div>
					<!-- /btn-group -->
				</div>
			</div>
		</div>
		<!-- /.col -->
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-body no-padding">
					<!-- THE CALENDAR -->
					<div id="calendar2"></div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /. box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	
	Offener Punkt:  - Open Event on Click ; - Open Event in Edit Mode; - Delete Event in Dialog
	Optionale Punkte: Add Comment to Calender event(def. nicht im Fokus)

</section>

@endsection

@section('modals')



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<form action="{{ route('calendar.newItem') }}" method="post">
		{{ csrf_field() }}
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">{{ __('template.calendar.newItem.header') }}</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="radio" name="choose" id="chooseMe" value="1" checked><label for="Me">Me</label>
						<input type="radio" name="choose" id="chooseGroup" value="2"><select name="roleSelect">
							@foreach ($userRoles as $role)
							<option class="form-control" value="{{ $role->id }}">{{ $role->name }}</option>
							@endforeach
						</select>
						<input type="radio" name="choose" id="chooseAll" value="3"><label for="All">All</label>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-5">
								<label>{{ __('template.calendar.newItem.EventStart') }}</label>
								<input id="start_eventdatetime" type="text" name="start_eventdatetime" class="form-control"  required value="{{ date("d.m.Y H:i") }}" required>
							</div>

							<div class="col-md-5">
								<label>{{ __('template.calendar.newItem.EventEnd') }}</label>
								<input id="end_eventdatetime" type="text" name="end_eventdatetime" class="form-control"  required value="{{ date("d.m.Y H:i") }}" required>
							</div>
							<div class="col-md-2">
								<label>{{ __('template.calendar.newItem.AllDay') }}</label>
								<input type="checkbox" name="allDay" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>{{ __('template.calendar.newItem.subject') }}</label>
						<input type="text" name="subject" class="form-control" required>
					</div>
					<div class="form-group">
						<label>{{ __('template.calendar.newItem.content') }}</label>
						<textarea id="contentEditor" name="content" rows="10" cols="80"  required >
						</textarea>
					</div>
				</div>
				<div class="clearfix">
				</div>
				<br>
				<div class="modal-footer">
					<input type="submit" class="btn btn-success">
				</div>
			</div>

		</div>
	</form>
</div>

@append

@section('styles')


<link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' />
@append


@section('scripts')
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>

<script>
	$(function() {

		$('#calendar2').fullCalendar({

			header: { center: 'month,agendaWeek' }, 
			views: {
				month: { 
					titleFormat: 'MM.YYYY'
				},
				week: {
					titleFormat: 'DD.MM.YYYY'	
				},
			},
			locale: 'de',
			firstDay: 1,
			monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli','August', 'September', 'Oktober', 'November', 'Dezember'],
			monthNamesShort: ['Jan','Feb','März','Apr','Mai','Juni','Jul','Aug','Sept','Okt','Nov','Dez'],
			dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
			dayNamesShort:['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
			buttonText: {today:'Heute', month:'Monat', week:'Woche', day:'Tag', list:'Liste'},
			weekNumbers:true,
			navLinks:true,

			selectable: true,
			events: [
			@foreach ($calendar as $event)
			{
				id : '{{ $event->id }}',
				title  : '{{  $event->subject}}',
				start  : '{{ date("Y-m-d H:i:s",strtotime($event->start_date)) }}',
				end  : '{{ date("Y-m-d H:i:s",strtotime($event->end_date)) }}',

				@if ($event->allDay == 1)
				allDay : true,
				@else
				allDay : false,
				@endif

				@if (Auth::user()->id = $event->user_id)
				color: 'green',
				@elseif($event->all == 1)
				color: 'orange',
				@else
				color: 'blau',
				@endif
			},
			@endforeach

			],

			timeFormat: 'H(:mm)', 

			eventClick: function(event) {
				if (event.url) {
					window.open(event.url);
					return false;
				}
				alert(event.id);
			},

			eventLimit: true, 
			views: {
				month: {
					eventLimit: 4 
				}
			},
		})
	});
</script>

<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')


<script>

	jQuery.datetimepicker.setLocale('de');

	jQuery('#start_eventdatetime').datetimepicker({
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
		format:'d.m.Y H:i',
	});
</script>

<script>

	jQuery.datetimepicker.setLocale('de');

	jQuery('#end_eventdatetime').datetimepicker({
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
@append