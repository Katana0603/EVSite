			<div class="table-responsive">
				<table id="t-{{ $tournament->id }}" class="display">
					<thead>
						<tr>
							<th>Team 1</th>
							<th>Team 2</th>
							<th>Winner</th>
							<th>Round</th>
							<th>Score T1</th>
							<th>Score T2</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($tournament->matches as $match)
						@if ($match->t1_id == null && $match->t2_id == null)
						@else	
						<tr>
							@if (isset($match->t1_id))
							<td>{{ $match->t1_id->name }}</td>
							@else
							<td>Freilos	</td>
							@endif		

							@if (isset($match->t2_id))
							<td>{{ $match->t2_id->name }}</td>
							@else
							<td>Freilos	</td>
							@endif

							@if (isset($match->winner_id))
							<td>{{ $match->winner_id->name }}</td>
							@else
							<td>Freilos	</td>
							@endif

							<td>{{ $match->round }}</td>
							<td>{{ $match->score_t1 }}</td>
							<td>{{ $match->score_t2 }}</td>
						</tr>

						@endif
						@endforeach
					</tbody>
				</table>
			</div>