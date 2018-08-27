
{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event Users')

@section('content-header')

<section class="content-header">
	<h1>
		Event
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
			<a href="{{ route('eventuser.create') }}" class="btn btn-block btn-success"><span class="fa fa-plus"></span></a>
		</div>
	</div>
		</div>
		<div class="table-responsive">
			<table id="locationsTable" class="display">
				<thead>
					<tr>
						<th>Name</th>
						<th>Event</th>
						<th>Paid</th>
						<th>button</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($eventusers as $user)
					<tr>		
						<td>{{ $user->user->username }}</td>
						<td>{{ $user->event->name }}	</td>
						<td>{{ $user->paid }}	</td>
						<td>
							{{ Form::open(['method' => 'DELETE', 'route' => ['eventuser.destroy', $user->id]]) }}
							<a href="{{ route('eventuser.edit', $user->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
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

@append
