Selector

<ul> 
	@foreach ($sin->tournaments as $tournament)
		
	<li><img src="{{ $tournament->game->media_path }}" alt="X">{{ $tournament->game->name }}</li>
	
	@endforeach
</ul>