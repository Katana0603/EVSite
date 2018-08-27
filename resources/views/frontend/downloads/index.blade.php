@extends('frontend.layout.app')

@section('title')

Downloads

@endsection

@section('content')

<h2 class="center">Downloads</h2>

<div class="box">

	<div class="row">
		@forelse ($vars as $var)
		<div class="col-md-6">
			<div class="box download-box"> 
				<div class="download-box-header"> 
					{{ $var->dir }}
				</div>
				<hr>
				@forelse ($var->files as $file)
				<a href="{{ asset('storage/downloads/' . $file) }}" target="_blank" download>
					{{ basename(pathinfo($file, PATHINFO_FILENAME)) }}
				</a>
				<br>
				@endforeach
			</div>
		</div>
		@endforeach
	</div>

</div>
@endsection
