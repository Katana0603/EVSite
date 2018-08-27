
<!-- TO DO List -->
<div class="box box-primary">
	<div class="box-header">
		<i class="ion ion-clipboard"></i>

		<h3 class="box-title">To Do List</h3>

		
		<!-- /.box-header -->
		<div class="box-body">
			<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
			<ul class="todo-list">

				@foreach ($toDoList as $toDo)
				<li>
					<!-- drag handle -->
					<span class="handle">
						<i class="fa fa-ellipsis-v"></i>
						<i class="fa fa-ellipsis-v"></i>
					</span>
					<!-- checkbox -->
					<input type="checkbox" value="">
					<!-- todo text -->
					<span class="text">{{ $toDo->desc }}</span>
					<!-- Emphasis label -->
					<small class="label label-info"><i class="far fa-clock"></i> - {{ date("d.m.Y",strtotime($toDo->deadline)) }}</small>
					@if ($toDo->role)
					<small class="label label-success"><i class="fas fa-users"></i> {{ $toDo->role->name }}
					</small>
					@endif
					<!-- General tools such as edit or delete-->
					<div class="tools">
						{{ Form::open(['method' => 'DELETE', 'route' => ['toDo.delete', $toDo->id]]) }}						
						<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></button>
						{{ Form::close() }}
					</div>
				</li>
				@endforeach
			</ul>
		</div>
		<!-- /.box-body -->
		<div class="box-footer clearfix no-border">

			<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#toDoModal"><i class="fa fa-plus"></i> </button>

			<div class="pull-left"> {{ $toDoList->links() }}</div>
		</div>
	</div>
	<!-- /.box -->

	@section('modals')
	<!-- Modal create -->
	<div class="modal fade" id="toDoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">{{ __('template.admin.dashboard.toDoList.createHeader') }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{{ Form::open(array('route' => 'admin.toDoList.saveEntry')) }}
					<div class="form-group">
						<input type="radio" name="selfGroup" value="1" checked>{{ ('template.admin.dashboard.toDoList.selbst') }}<br>
						<input type="radio" name="selfGroup" value="2">{{ ('template.admin.dashboard.toDoList.group') }} 							
						<select name="roleSelect">
							@foreach ($userRoles as $role)
							<option class="form-control" value="{{ $role->id }}">{{ $role->name }}</option>
							@endforeach
						</select>
						<br>
					</div>

					<div class="form-group">
						{{ Form::label('desc', 'Description') }}
						{{ Form::text('desc', null, array('class' => 'form-control', 'required' => 'required')) }}
					</div>
					<div class="form-group">
						<label>Date:</label>


						<input id="datetimepicker" type="text" name="deadline" class="form-control"  required>
						<!-- /.input group -->
					</div>
				</div>
				<div class="modal-footer">
					
					
					{{ Form::submit('Create Articel', array('class' => 'btn btn-success btn-lg btn-block')) }}
					
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	@append



	@section('scripts')
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
	@append