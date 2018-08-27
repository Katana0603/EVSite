@extends('frontend.layout.app')

@section('title')

Team

@endsection

@section('content')

<h2 class="center">{{ __('template.team.header') }}</h2>


<div class="center">
	{{-- {{ $team }} --}}
	<div class="row">
		<div class="col-12 col-sm-12">
			@foreach ($team_cat as $cat)

			<div class="box center">
				<div class="row">
					<div class="col-12">
						<h3>{{ $cat->name }}</h3>
					</div>
				</div> 
				<div class="row">
					<div class="col-12" >
						@foreach ($cat->team as $member)
						<div class="col-sm-4 col-12 left">
							<div class="card">
								<a href="{{ route('user.index',$member->user->id) }}">
									<img src="{{ asset('storage/media/'.$member->user->avatar ) }}" alt="{{ $member->user->username }} img" style="width:100%" class="img-circle">
								</a>
								<h1>{{ $member->user->username }}</h1>
								<p class="title">{{ $member->function }}</p>
								<p>{{ $member->description }}</p>

								<p><a href="{{ route('pm.create.MessageToUser',$member->user->id) }}" target="_blank"><i class="fas fa-envelope"></i></a></p>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection