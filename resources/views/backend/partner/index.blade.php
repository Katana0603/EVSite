{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Partner Overview')

@section('content-header')

<section class="content-header">
	<h1>
		Partner
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
			<a href="{{ route('partner.create') }}" class="btn btn-block btn-success"><span class="fa fa-plus"></span></a>
	</div>
</div>
<div class="table-responsive">
	<table id="partnerTable" class="display">
		<thead>
			<tr>
				<th>Name</th>
				<th>Active</th>
				<th>Buttons</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($partners as $partner)
			<tr>
				<td>{{ $partner->name }}</td>
				<td>{{ $partner->activ }}</td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['partner.destroy', $partner->id]]) }} 
					<a href="{{ route('partner.edit', $partner->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>

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
		$('#partnerTable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 0, "desc" ]]
		} );
	} );
</script>
@endsection
