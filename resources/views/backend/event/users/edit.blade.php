{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| User Edit')

@section('content-header')

<section class="content-header">
	<h1>
		User
		<small>Edit</small>
	</h1>
	<ol class="breadcrumb">
{{--        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

{{ Form::open(array('route' => ['eventuser.update',$eventuser->id], 'files' => true, 'method' => 'PUT')) }}
<div class="col-sm-6">
	<div class="form-group">
		{{ Form::label('name', 'User') }}
		{{ Form::label('user', $eventuser->user->username, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('event', 'Event') }}
		<select class="select2 form-control" name="event_id">
			<option value="{{ $eventuser->event->id }}">{{ $eventuser->event->name }}</option>
			@foreach ($events as $event)
			<option value="{{ $event->id }}">{{ $event->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">

		{{ Form::label('comment', 'Comment') }}
		{{ Form::textarea('comment', $eventuser->comment, array('class' => 'form-control')) }}
	</div>
</div>
<div class="col-sm-6">
	<div class="panel panel-default">
		<div class="panel-body">
			@if ($eventuser->paid)
			<input type="checkbox" name="paid" id="paid" checked> 
			@else
			<input type="checkbox" name="paid" id="paid">
			@endif
			<label for="paid">Paid</label>
			<div id="paid-div">
				<div class="form-group">
					{{ Form::label('tickets', 'Tickets') }}
					<select class="select2 form-control" name="ticket_id">
						@if ($eventuser->ticket)
						<option value="{{ $eventuser->ticket_id }}">{{ $eventuser->ticket->name }}</option>
						@endif
						@foreach ($tickets as $ticket)
						<option value="{{ $ticket->id }}">{{ $ticket->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					{{ Form::label('paymethod', 'PayMethod') }}
					<select class="select2 form-control" name="payment_id">
						@if ($eventuser->payment)
						<option value="{{ $eventuser->payment_id }}">{{ $eventuser->payment->name }}</option>
						@endif
						@foreach ($payments as $payment)
						<option value="{{ $payment->id }}">{{ $payment->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					{{ Form::label('paydate', 'PayDate') }}
					<input id="paytime" type="text" name="paytime" class="form-control" value="{{ $eventuser->paydate }}" >
				</div>

				{{-- todo: add Tickets --}}
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				@if ($eventuser->arrived)
					
				<input type="checkbox" name="arrived" id="arrived" checked> <label for="arrived" >Arrived</label>
				@else
				<input type="checkbox" name="arrived" id="arrived"> <label for="arrived">Arrived</label>
				@endif
				<div class="form-group">

					{{ Form::label('arrivedate', 'arrive Date') }}
					<input id="arrivedDate" type="text" name="arrivedate" class="form-control" value="{{ $eventuser->arrivedDate }}" >
				</div>
			</div>
		</div>
	</div>

</div>


{{ Form::submit('Edit User', array('class' => 'btn btn-success btn-lg btn-block')) }}
{{ Form::close() }}

@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminEvent");
		tag.className += " active";
	});
</script>

<script>
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>

<script>

	jQuery.datetimepicker.setLocale('de');

	jQuery('#paytime').datetimepicker({
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

	jQuery.datetimepicker.setLocale('de');

	jQuery('#arrivedDate').datetimepicker({
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


@section('css')

@append