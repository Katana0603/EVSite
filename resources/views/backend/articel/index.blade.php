{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Articel Overview')

@section('content-header')

<section class="content-header">
	<h1>
		Articel
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
		<a href="{{ route('articel.create') }}" class="btn btn-block btn-success"><span class="fa fa-plus"></span></a>
	</div>
</div>
<div class="table-responsive">
	<table id="articelTable" class="display">
		<thead>
			<tr>
				<th>title</th>
				<th>status</th>
				<th>release time</th>
				<th>updated_at</th>
				<th>button</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($articel as $singleArticel)
			<tr>
				<td>{{ $singleArticel->title }}</td>
				<td>{{ $singleArticel->active }}</td>
				<td>{{ date("d.m.Y H:i:s",strtotime($singleArticel->release_time)) }}</td>
				<td>{{ date("d.m.Y H:i:s",strtotime($singleArticel->updated_at)) }}</td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['articel.delete', $singleArticel->id]]) }}
					<a href="{{ route('articel.show', $singleArticel->id) }}" class="btn btn-default btn-sm" target="_blank"><span class="fa fa-search"></span></a> 
					<a href="{{ route('articel.edit', $singleArticel->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>

 
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
	$( document ).ready(function() {
		var tag =  document.getElementById("adminArticel");
		tag.className += " active";
	});
</script>
<script>
	$(document).ready(function() {
		$('#articelTable').DataTable( {
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
