{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Roles')

@section('content')

<div class="col-12">
    <h1><i class="fa fa-tags"></i> Role Administration <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
        {{-- <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a> --}}</h1>
        <hr>

        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('roles.create') }}" class="btn btn-block btn-success"><span class="fa  fa-plus"></span></a>
            </div>
        </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>

                            <button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');"><span class="fa fa-minus-circle"></span></button>
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
@append