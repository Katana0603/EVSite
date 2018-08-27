{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Forum Overview')

@section('content-header')

<section class="content-header">
	<h1>
		Forum
		<small>Overview</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>
@endsection

@section('content')



<h3>Categories</h3>
@include('backend.forum.modals.createCat')
<div class="table-responsive">
	<table id="categorieTable" class="display">
		<thead>
			<tr>
				<th>order</th>
				<th>title</th>
				<th>status</th>
				<th>Subs</th>
				<th>button</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cats as $cat)
			<tr>		
				<td>{{ $cat->order }}</td>
				<td>{{ $cat->title }}</td>
				<td>{{ $cat->active }}</td>	
				<td>{{ $cat->count }}</td>		
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['forum.sub.delete', $cat->id]]) }}
					<a href="{{ route('articel.show', $cat->id) }}" class="btn btn-default btn-sm"><span class="fa fa-search"></span></a> 
					<a href="{{ route('articel.edit', $cat->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>


					<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>

					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<hr />
<h3>Subs</h3>
@include('backend.forum.modals.createSub')
<div class="table-responsive">
	<table id="subTable" class="display">
		<thead>
			<tr>
				<th>cat_id</th>
				<th>order</th>
				<th>title</th>
				<th>status</th>
				<th>Threads</th>
				<th>button</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($subs as $sub)
			<tr>
				<td>{{ $sub->cat_id }}</td>
				<td>{{ $sub->order }}</td>
				<td>{{ $sub->title }}</td>
				<td>{{ $sub->active }}</td>
				<td>{{ $sub->count }}</td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['forum.sub.delete', $sub->id]]) }}
					<a href="{{ route('articel.show', $sub->id) }}" class="btn btn-default btn-sm"><span class="fa fa-search"></span></a> 
					<a href="{{ route('articel.edit', $sub->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>


					<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>

					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<hr />

<h3>Threads</h3>
@include('backend.forum.modals.createThread')

<div class="table-responsive">
	<table id="threadTable" class="display">
		<thead>
			<tr>
				<th>order</th>
				<th>subcat</th>
				<th>author</th>
				<th>title</th>
				<th>status</th>
				<th>Posts</th>
				<th>button</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($threads as $thread)
			<tr>
				<td>{{ $thread->order }}</td>
				<td>{{ $thread->subcat_id }}</td>
				<td>{{ $thread->author->username }}</td>
				<td>{{ $thread->title }}</td>
				<td>{{ $thread->active }}</td>
				<td>{{ $thread->count }}</td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['forum.thread.delete', $thread->id]]) }}
					<a href="{{ route('forum.thread', ['id' => $thread->subcat_id, 'threadId' => $thread->id]) }}" class="btn btn-default btn-sm"><span class="fa fa-search"></span></a> 
					<a href="{{ route('forum.editThread', ['id' => $thread->subcat_id, 'threadId' => $thread->id]) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>

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
		var tag =  document.getElementById("adminForum");
		tag.className += " active";
	});
</script>
<script>
	$(document).ready(function() {
		$('#categorieTable').DataTable( {
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
<script>
	$(document).ready(function() {
		$('#subTable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 0, "asc" ],[ 1, "asc" ]]
		} );
	} );
</script>
<script>
	$(document).ready(function() {
		$('#threadTable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 0, "asc" ],[ 1, "asc" ]]
		} );
	} );
</script>

@append
