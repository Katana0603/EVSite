{{-- index.blade.php --}}


@include('backend.layout._partial.datatables')

@extends('backend.layout.app')

@section('title', '| Users')

@section('content')

<div class="col-12">
	<h1><i class="fa fa-users"></i> User Administration <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Groups</a>
		{{-- <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a> --}}</h1>
		<hr>

		<div class="row">
			<div class="col-md-2">
				<a href="{{ route('users.create') }}" class="btn btn-block btn-success"><span class="fa  fa-user-plus"></span></a>
			</div>
		</div>

		<div class="table-responsive">
			<table class="" id="usersTable">
				<thead>
					<tr>
						<th>Username</th>
						<th>Email</th>
						<th>User Roles</th>
						<th>locked</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->username }}</td>
						<td>{{ $user->email }}</td>
						<td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
						
						<td>{{ $user->locked }}</td>
						<td>					

							{!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}

							<a href="{{ route('users.show', $user->id) }}" class="btn btn-default btn-sm"><span class="fa fa-search"></span></a> 
							<a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>

							<button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');"><span class="fa fa-minus-circle"></span></button>
							<a href="{{ route('users.locked', $user->id) }}" class="btn btn-success btn-sm"><span class="fa fa-lock"></span></a>
							{!! Form::close() !!}
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
			var tag =  document.getElementById("adminUserControl");
			tag.className += " active";
		});
	</script>
	<script>
		$(document).ready(function() {
			$('#usersTable').DataTable( {
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
	@append
