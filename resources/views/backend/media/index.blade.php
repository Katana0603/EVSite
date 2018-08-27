{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Media Overview')

@section('content-header')

<section class="content-header">
	<h1>
		Media
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

<div class="row">
	<div class="col-md-2">
		<a href="{{ route('media.index') }}" class="btn btn-block btn-default">All</a>
	</div>

	<div class="col-md-2">
		<a href="{{ route('getFolderFiles', 'test') }}" class="btn btn-block btn-default">Test</a>
	</div>
	<div class="col-md-2">
		<a href="{{  route('getFolderFiles', 'event') }}" class="btn btn-block btn-default">Event</a>
	</div>
</div>
<ul>
	@foreach ($allFiles as $file)

	<li>
		<a href="{{ asset('storage/media/'.$file) }}" target="_blank">{{ $file }}</a>
	</li>
	@endforeach
</ul>
{{-- <div class="table-responsive">
	<table id="fileTable" class="display">
		<thead>
			<tr>
				<th>Name</th>
				<th>Buttons</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($allFiles as $file)
			<tr>
				<td><a href="{{ route('filedownload',['filename' => $file]) }}">{{ $file }}</a></td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['media.destroy', $file]]) }} 
					<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>

					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div> --}}
@endsection

@section('scripts')

<script>
	$(document).ready(function() {
		$('#fileTable').DataTable( {
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
