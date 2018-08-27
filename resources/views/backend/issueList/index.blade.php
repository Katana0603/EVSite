{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Issue Overview')

@section('content-header')

<section class="content-header">
	<h1>
		Issue List
		<small>Overview</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>
@endsection

@section('content')
<div class="row">
	<div class="col-md-2">
		@include('backend.issueList.create')
	</div>
</div>
<div class="table-responsive">
	<table id="issueTable" class="display">
		<thead>
			<tr>
				<th>ID</th>
				<th>Url</th>
				<th>Desc</th>
				<th>created_at</th>
				<th>buttons</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($issues as $issue)
			<tr>
				<td>{{ $issue->id }}</td>
				<td>{{ $issue->url }}</td>
				<td>{{ $issue->description }}</td>
				<td>{{ date("d.m.Y H:i:s",strtotime($issue->created_at)) }}</td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['issueList.destroy', $issue->id]]) }} 
					<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>

					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

@section('scripts')

<script>
	$(document).ready(function() {
		$('#issueTable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 2, "desc" ], [3, "desc"]]
		} );
	} );
</script>
@endsection
