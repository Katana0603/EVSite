{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Team Overview')

@section('content-header')

<section class="content-header">
	<h1>
		Team
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
		<a class="header-user-message-notif btn btn-success" data-toggle="modal" data-target="#createCatModal" style="cursor: pointer;"><span class="fa fa-plus"></span></a>
	</div>
</div>

@foreach ($teamCategories as $teamCat)
<h2 class="center">{{ $teamCat->name }}</h2>

{{ Form::open(['method' => 'DELETE', 'route' => ['admin.team.destroyTeamCat', $teamCat->id]]) }} 

<small>{{ $teamCat->description }}</small>

<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>

{{ Form::close() }}

<div class="row">
	<div class="col-md-2">
		<a class="header-user-message-notif btn btn-success" data-toggle="modal" data-target="#{{ $teamCat->name }}modal" style="cursor: pointer;"><span class="fa fa-plus"></span></a>

		<!-- Modal -->
		<div class="modal" id="{{ $teamCat->name }}modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="exampleModalLabel">Add User to Team {{ $teamCat->name }}</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{{ Form::open(array('route' => 'admin.team.store')) }}
						<div class="form-group">

							{{ Form::hidden('cat_id', $teamCat->id) }}
							{{ Form::label('user_id', 'User') }}
							<select class="form-control" style="width: 100%;" name="user_id">
								@forelse ($users as $user)
								<option value="{{ $user->id }}">{{ $user->username }}</option>
								@endforeach 
							</select> 

							{{ Form::label('function', 'Funktion') }}
							{{ Form::text('function', null, array('class' => 'form-control', 'required' => 'required')) }}
							{{ Form::label('description', 'Description') }}
							{{ Form::text('description', null, array('class' => 'form-control','required' => 'required')) }}
						</div>
						{{ Form::submit('Create Categorie', array('class' => 'btn btn-success btn-lg btn-block')) }}
						{{ Form::close() }}
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>




	</div>
</div>
<div class="table-responsive">
	<table id="{{ $teamCat->name }}table" class="display">
		<thead>
			<tr>
				<th>Username</th>
				<th>Function</th>
				<th>Buttons</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($teamCat->team as $team)
			<tr>
				<td>{{ $team->user->username }}</td>
				<td>{{ $team->function }}</td>
				<td>
					{{ Form::open(['method' => 'DELETE', 'route' => ['admin.team.destroy', $team->id]]) }} 

					<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>

					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


@endforeach

@endsection

@section('scripts')
@foreach ($teamCategories as $teamCat)
<script>
	$(document).ready(function() {
		$('#{{ $teamCat->name }}table').DataTable( {
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
@endforeach

@endsection



@section('modals')
<!-- Modal -->
<div class="modal" id="createCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Categorie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ Form::open(array('route' => 'admin.team.storeTeamCat')) }}


				<div class="form-group">
					{{ Form::label('name', 'Name') }}
					{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }}
					{{ Form::label('description', 'Description') }}
					{{ Form::text('description', null, array('class' => 'form-control', 'required' => 'required')) }}
				</div>
				{{ Form::submit('Create Categorie', array('class' => 'btn btn-success btn-lg btn-block')) }}
				{{ Form::close() }}
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>


@append
