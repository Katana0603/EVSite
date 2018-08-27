{{-- 
Auswahl des Events in der Adminübersicht, dieses wird als Sessionvariable gesetzt

Session['admin_event_id'];

So kann für alle nachfolgenden Punkte das Event als ID vorgehalten werden, es muss sichergestellt sein, dass das Session Token abläuft
--}}
{{-- Das ganze wird für das UserModul gebraucht --}}


<a class="btn btn-success btn-block" data-toggle="modal" data-target="#addUserModal" style="cursor: pointer;"><span class="fa fa-plus"></span></a>


@section('modals')
<!-- Modal -->
<div class="modal" id="addUserModal" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add User to Event</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				{{ Form::open(array('route' => 'admin.event.users.addUser')) }}

				<div class="form-group">
					{{ Form::label('event', 'Event') }}
					<select class="form-control select2" name="event_event" required>
						@foreach ($events as $event)
						<option value="{{ $event->id }}">{{ $event->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					{{ Form::label('user', 'User') }}
					<select class=" select2 form-control" name="event_user" required>
						@foreach ($users as $user)
						<option value="{{ $user->id }}">{{ $user->username }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					{{ Form::label('paid', 'Paid') }}
					<input type="checkbox" name="paid" id="paid">
				</div>
				<div id="paid-div" style="display:none;">
					{{ Form::label('payMethod', 'Pay Method') }}
					<select class=" select2 form-control" name="payMethod">
						@foreach ($paymethods as $paymethod)
						<option value="{{ $paymethod->id }}">{{ $paymethod->name }}</option>
						@endforeach
					</select>

					{{ Form::label('payDate', 'Pay Date') }}
					<input id="datetimepicker" type="text" name="pay_date" class="form-control" value="">

					{{ Form::label('ticket', 'Ticket') }}
					<select class=" select2 form-control" name="ticket">
						@foreach ($availableTickets as $ticket)
						<option value="{{ $ticket->id }}">{{ $ticket->name }}</option>
						@endforeach
					</select>
				</div> 


				<div class="form-group">
					{{ Form::label('arrived', 'Arrived') }}
					<input type="checkbox" name="arrived" id="arrived">
				</div>
				<div id="arrived-div"  style="display:none;">
					<!-- time Picker -->
					<div class="bootstrap-timepicker">
						<div class="form-group">
							<label>Time picker:</label>

							<div class="input-group">
								<input type="text" class="form-control timepicker" name="arrived_time">

								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>
				</div> 

				<div class="form-group">
					{{ Form::label('comment', 'Comment') }}
					{{ Form::text('comment', '', array('class' => 'form-control')) }}

				</div>

				{{ Form::submit('Add User to Event', array('class' => 'btn btn-success btn-lg btn-block')) }}
				{{ Form::close() }}

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

@append

@section('scripts')
<script>
	$(function () {
	//Initialize Select2 Elements
	$('.select2').select2({ width: '100%' });
});
</script>
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
		format:'d.m.Y H:i',

	});
</script>

<script>
	//Timepicker
	$('.timepicker').timepicker({
		showInputs: false,
		timeFormat: 'HH:mm',
	});
</script>
<script>
	$(document).ready(function () {
		var ckbox = $('#arrived');
		var x = document.getElementById("arrived-div");

		$('input').on('click',function () {
			if (ckbox.is(':checked')) {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		});
	});
</script>

<script>
	$(document).ready(function () {
		var ckbox2 = $('#paid');
		var x2 = document.getElementById("paid-div");

		$('input').on('click',function () {
			if (ckbox2.is(':checked')) {
				x2.style.display = "block";
			} else {
				x2.style.display = "none";
			}
		});
	});
</script>

@append