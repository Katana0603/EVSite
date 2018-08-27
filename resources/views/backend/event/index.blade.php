{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event Overview')

@section('content-header')

<section class="content-header">
	<h1>
		Event
		<small>Overview</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')
<div class="row">
	<div class="row">
		<div class="col-md-2">
			<a href="{{ route('admin.event.create') }}" class="btn btn-block btn-success"><span class="fa fa-plus"></span></a>
		</div>
	</div>
	<div class="col-md-12">
		<h3>Event</h3>

		<div class="table-responsive">
			<table id="eventsTable" class="display">
				<thead>
					<tr>
						<th>Name</th>
						<th>active</th>
						<th>event start</th>
						<th>button</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($events as $event)
					<tr>		
						<td>{{ $event->name }}</td>
						<td>{{ $event->active }}</td>
						<td>{{ $event->event_start }}</td>
						<td>
							{{ Form::open(['method' => 'DELETE', 'route' => ['event.delete', $event->id]]) }}
							<a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
							<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>
							<a href="{{ route('admin.event.accountCheck', $event->id) }}" class="btn btn-success btn-sm"><span class="fas fa-money-bill-alt"></span></a>
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@can('Event-Intern')

		<h3>Interne Events</h3>

		<div class="table-responsive">
			<table id="internEventsTable" class="display">
				<thead>
					<tr>
						<th>name</th>
						<th>active</th>
						<th>event start</th>
						<th>button</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($internEvents as $event)
					<tr>		
						<td>{{ $event->name }}</td>
						<td>{{ $event->active }}</td>
						<td>{{ $event->event_start }}</td>	
						<td>
							{{ Form::open(['method' => 'DELETE', 'route' => ['event.delete', $event->id]]) }}
							<a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>

							<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endcan

	</div>

</div>


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
		$('#eventsTable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 2, "asc" ]]
		} );
	} );
</script>
<script>
	$(document).ready(function() {
		$('#internEventsTable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 2, "asc" ]]
		} );
	} );
</script>
@append
