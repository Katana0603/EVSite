

{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event -  Tournaments')

@section('content-header')

<section class="content-header">
	<h1>
		{{ $event->name }}
		<small>Tournaments</small>
	</h1>
	<ol class="breadcrumb">
{{-- 		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
<div class="right">

	<select id="tournamentSelector" name="tournamentSelector">
		@foreach ($tournaments as $tournament)
		<option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
		@endforeach
	</select>

</div>


</section>
@endsection

@section('content')



@foreach ($tournaments as $tournament)
<div id="{{ $tournament->id }}-div">
	<div class="row">
		<div class="col-md-4">
			<a href="{{ route('activeEvents.tournament.stratFirstRound', [$event->id ,$tournament->id]) }}" class="btn btn-block btn-primary">Start First Round</a>
		</div>
	</div>

	<div id="tournament-{{ $tournament->id }}-div">
		<div class="row">

			<div class="col-md-12 overflow-x">
				{{-- Table for Graphic --}}
				@include('backend.activeEvent.tournament.graphic')
			</div>
			<div class="col-md-12 ">
				{{-- Table for  matches--}}
				@include('backend.activeEvent.tournament.matches')
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				{{-- Table for Teams --}}
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#newTeamModal">
					Add Team
				</button>
				<div class="modal fade" id="newTeamModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title center">New Team</h4>
							</div>

							{{ Form::open(array('route' => ['activeEvents.tournament.addTeam',$event->id,$tournament->id])) }}

							<div class="modal-body">
								<div class="form-group">
									<label >Team Name:</label>
									<input type="text" name="teamName" id="teamName" class="form-control" required>
								</div>
							</div>
							<div class="modal-footer">
								{{ Form::submit('Add Team', array('class' => 'btn btn-success btn-lg btn-block')) }}
							</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
				<h2>Teams</h2>
				{{-- Box for Team Specific entries --}}
				<div class="table-responsive">
					<table id="t-{{ $tournament->id }}-teams" class="display">
						<thead>
							<tr>
								<th>Name</th>
								<th>Win</th>
								<th>Lose</th>
								<th>Btn</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tournament->teams as $team)

							<tr>
								<td>{{ $team->name }}</td>
								<td>{{ $team->win }}</td>
								<td>{{ $team->lose }}</td>
								<td><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#addToTeam-{{ $team->name }}">+</button></td>
							</tr>
							<div id="addToTeam-{{ $team->name }}" class="modal fade" role="dialog">
								<div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Add Player to Team: {{ $team->name }}</h4>
										</div>

										{{ Form::open(array('route' => ['activeEvents.tournament.addPlayer',$event->id,$tournament->id, $team->id])) }}

										<div class="modal-body">
											<div class="form-group">
												<label >Player to Add:</label>
												<select class="form-control"  name="user">
													<option  selected value="0" id="userOption"> -- select an option -- </option>
													@foreach ($eventUsers as $eventUser)
													<option value="{{ $eventUser->id }}">{{ $eventUser->user->username }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="modal-footer">
											{{ Form::submit('Add Team', array('class' => 'btn btn-success btn-lg btn-block')) }}
										</div>
										{{ Form::close() }}
									</div>
								</div>
							</div>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach

@append

@section('scripts')
@foreach ($tournaments as $tournament)
<script>
	$(document).ready(function() {
		$('#t-{{ $tournament->id }}').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 3, "asc" ]],
			stateSave: true,
		} );
	} );

	$(document).ready(function() {
		$('#t-{{ $tournament->id }}-teams').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 0, "desc" ]],
			stateSave: true,
		} );
	} );
</script>
@endforeach

@append