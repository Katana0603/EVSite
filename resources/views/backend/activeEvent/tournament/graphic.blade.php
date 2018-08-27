<div class="graphic-wrapper">



	@for ($i = 0; $i < $tournament->rounds; $i++)
	
	<?php
	if ($registerdTeams % 2 != 0 && $registerdTeams != 1) {

		$registerdTeams +=  2 - ($registerdTeams % 2);
	}

	?>



	<div class="round-wrapper">
		@foreach ($tournament->matches as $match)
		@if ($match->t1_id == null & $match->t2_id == null)

		@else
		@if ($match->round == $i)



		@if ($registerdTeams == 1)
		<div class="match-wrappers">
			Winner is @if ($match->t1_id != null)
			{{$match->t1_id->name}}
			@else ($match->t2_id != null)
			{{ $match->t2_id->name }}
			@endif
		</div> 
		@else

		<div class="match-wrapper"> 
			<div class="tournament-graphic-team-box-wrapper-home @if ($match->winner_id == $match->t1_id && $match->winner_id != NULL)tournament-graphic-team-box-wrapper-winner @endif " >
				<div class="tournament-graphic-team-box-label" >
					@if (isset($match->t1_id))
					{{ $match->t1_id->name }}
					@else
					@if ($match->t1_pre != NULL)
					Winner of Match {{ $match->t1_pre }}
					@else					
					Freilos
					@endif
					@endif
				</div>
				<div class="tournament-graphic-team-box-score">
					{{ $match->score_t1 }}
				</div>
			</div>
			<a href="#" onclick="openScoreModal({{ $event->id }},{{ $tournament->id }},{{ $match->id }})">
				<div class="center">vs </div>
			</a>
			<div class="tournament-graphic-team-box-wrapper-guest @if ($match->winner_id == $match->t2_id && $match->winner_id != NULL)tournament-graphic-team-box-wrapper-winner @endif " >
				<div class="tournament-graphic-team-box-label" >
					@if (isset($match->t2_id))
					{{ $match->t2_id->name }}
					@else
					@if ($match->t2_pre != NULL)
					Winner of Match {{ $match->t2_pre }}
					@else
					Freilos
					@endif
					@endif
				</div>
				<div class="tournament-graphic-team-box-score">
					{{ $match->score_t2 }}
				</div>
			</div>
		</div>
		@endif
		@endif

		@endif



		@endforeach
		<?php 
		$registerdTeams = $registerdTeams/2;
		?>
	</div>	
	@endfor
</div>


@section('modals')
<!-- Edit Modal -->
<div class="modal fade" id="scoreModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title center">Edit Seat</h4>
			</div>

			{{ Form::open(array('route' => ['activeEvents.tournament.enterScores'])) }}
			<div class="modal-body">
				<div class="form-group">
					<label >Score Team 1</label>
					<input type="number" name="scoret1" id="scoret1" class="form-control" required>
				</div>
				<div class="form-group">
					<label >Score Team 2</label>
					<input type="number" name="scoret2" id="scoret2" class="form-control" required>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="eventId" id="eventId">
				<input type="hidden" name="tournamentId" id="tournamentId">
				<input type="hidden" name="matchId" id="matchId">

				{{ Form::submit('Edit Seat', array('class' => 'btn btn-success btn-lg btn-block')) }}
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@append


@section('scripts')


<script>
	function openScoreModal($eventId,$tournamentId,$matchId)
	{
		document.getElementById("eventId").value = $eventId;
		document.getElementById("tournamentId").value = $tournamentId;
		document.getElementById("matchId").value = $matchId;
		$('#scoreModal').modal('show');
	}
</script>

@append