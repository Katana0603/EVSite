{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event Tickets')

@section('content-header')

<section class="content-header">
	<h1>
		Event
		<small>Tickets</small>
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
			<a href="{{ route('admin.eventTickets.create') }}" class="btn btn-block btn-success"><span class="fa fa-plus"></span></a>
		</div>
	</div>
	<h3>Tickets</h3>

	<div class="table-responsive">
		<table id="ticketstable" class="display">
			<thead>
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>button</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tickets as $ticket)
				<tr>		
					<td>{{ $ticket->name }}</td>	
					<td>{{ $ticket->prices }}</td>	
					<td>
						{{ Form::open(['method' => 'DELETE', 'route' => ['admin.eventTickets.destroy', $ticket->id]]) }}
						{{-- <a href="{{ route('admin.event.location.show', $location->id) }}" class="btn btn-default btn-sm"><span class="fa fa-search"></span></a>  --}}
						<a href="{{ route('admin.eventTickets.edit', $ticket->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
						<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>
						{{ Form::close() }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
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
		$('#ticketstable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 0, "asc" ]]
		} );
	} );
</script>

@append
