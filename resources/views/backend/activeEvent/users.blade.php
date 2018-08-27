

{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event -  Users')

@section('content-header')

<section class="content-header">
	<h1>
		{{ $event->name }}
		<small>Users</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12">

		<h3>Users</h3>
		<div class="row">
			<div class="row">
				<div class="col-md-2">
					<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#addUser">
						<span class="fa fa-plus"></span>
					</button>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table id="locationsTable" class="display">
				<thead>
					<tr>
						<th>Name</th>
						<th>Paid</th>
						<th>Arrived</th>
						<th>button</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr>		
						<td>{{ $user->user->username }}</td>
						<td>{{ $user->paid }}	</td>
						<td>{{ $user->arrived }}	</td>
						<td>
							{{ Form::open(['method' => 'DELETE', 'route' => ['activeEvents.deleteUser',$event->id, $user->id]]) }}
							<a href="" class="btn btn-info btn-sm" onclick="return confirm('Is not implemented?');"><span class="fa fa-edit"></span></a>
							{{-- Paid --}}
							<a href="{{ route('activeEvents.userPaidCash',[$event->id, $user->id]) }}" class="btn btn-success btn-sm"><span class="fas fa-money-bill-alt"></span></a>
							<a href="{{ route('activeEvents.userPaidPaypal',[$event->id, $user->id]) }}" class="btn btn-success btn-sm"><span class="fab fa-paypal"></span></a>

							{{-- Arrived --}}
							<a href="{{ route('activeEvents.userArrived',[$event->id, $user->id]) }}" class="btn btn-warning btn-sm"><span class="fas fa-plane"></span></a>


							<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection

@section('modals')

{{-- Add User Modal --}}
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('template.activeEvents.addUser.header') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row" >
					{{ Form::open(array('route' => ['activeEvents.addUser', $event->id], 'files' => true)) }}

					<div class="col-sm-6">
						<div class="form-group">
							{{ Form::label('name', 'User') }}
							<select class="select2 form-control" name="user_id">
								@foreach ($allUsers as $user)
								<option value="{{ $user->id }}">{{ $user->username }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">

							{{ Form::label('comment', 'Comment') }}
							{{ Form::textarea('comment', null, array('class' => 'form-control')) }}
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<input type="checkbox" name="paid" id="paid"> <label for="paid">Paid</label>
								<div id="paid-div">
									<div class="form-group">
										{{ Form::label('tickets', 'Tickets') }}
										<select class="select2 form-control" name="ticket_id">
											<option disabled selected value> -- select an option -- </option>
											@foreach ($tickets as $ticket)
											<option value="{{ $ticket->id }}">{{ $ticket->name }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										{{ Form::label('paymethod', 'PayMethod') }}
										<select class="select2 form-control" name="payment_id">
											<option disabled selected value> -- select an option -- </option>
											@foreach ($payments as $payment)
											<option value="{{ $payment->id }}">{{ $payment->name }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										{{ Form::label('paydate', 'PayDate') }}
										<input id="paytime" type="text" name="paytime" class="form-control"  >
									</div>

									{{-- todo: add Tickets --}}
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<input type="checkbox" name="arrived" id="arrived"> <label for="arrived">Arrived</label>
									<div class="form-group">

										{{ Form::label('arrivedate', 'arrive Date') }}
										<input id="arrivedDate" type="text" name="arrivedate" class="form-control"  >
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				{{ Form::submit('Add User', array('class' => 'btn btn-success btn-lg btn-block')) }}
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
{{-- Add User Modal End --}}



@append

@section('scripts')
<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminEvent");
		tag.className += " active";
	});
</script>
<script>
	$(document).ready(function() {
		$('#locationsTable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 0, "asc" ]],
			stateSave: true,
		} );
	} );
</script>
<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
	$('.select_2').select2();
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
