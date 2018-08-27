@extends('frontend.layout.app')

@section('title')

{{ $user->username }}
@endsection

@section('content')

<div class="box">

	<div class="row">
		<div class="col-sm-12">
			<h2 class="center">{{ $user->username }}</h2>
			<hr />
		</div>
		{{-- User Data --}}
		<div class="col-sm-8 col-xs-8">
			<div class="row">
				<div class="col-sm-4">
					<label for="username">{{ __('template.user.username') }}</label>
				</div>
				<div class="col-sm-8">
					{{ $user->username }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="clan">{{ __('template.user.clan') }}</label>
				</div>
				<div class="col-sm-8">
					@if ($user->clan)
					{{ $user->clan->name }}
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="email">{{ __('template.user.email') }}</label>
				</div>
				<div class="col-sm-8">
					{{ $user->email }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="firstname">{{ __('template.user.firstname') }}</label>
				</div>
				<div class="col-sm-8">
					{{ $user->firstname }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="lastname">{{ __('template.user.lastname') }}</label>
				</div>
				<div class="col-sm-8">
					{{ $user->name }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xs-5">
					<label for="birthdate">{{ __('template.user.birthdate') }}</label>
				</div>
				<div class="col-sm-8 col-xs-7">
					{{ $user->birthdate }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xs-5">
					<label for="gender">{{ __('template.user.gender') }}</label>
				</div>
				<div class="col-sm-8 col-xs-7">
					@if ($user->gender)
					{{ $user->gender->value }}
					@endif
				</div>
			</div>
		</div>
		{{-- User Pic --}}
		<div class="col-sm-4 col-xs-4">
			<img src="{{ asset('storage/media/'.$user->avatar ) }}" alt="userpic">
			<div class="row">
				<div class="col-sm-4 col-xs-6">
					<label for="experiencepoints">{{ __('template.user.experiencepoints') }}</label>
				</div>
				<div class="col-sm-8 col-xs-6">
					{{ $user->experiencepoints }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label for="level">{{ __('template.user.level') }}</label>
				</div>
				<div class="col-sm-8">
					{{-- {{ $user->level->description }} --}}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-4 col-xs-3">
					<label for="phone">{{ __('template.user.phone') }}</label>
				</div>
				<div class="col-sm-8 col-xs-9">
					{{ $user->phone }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xs-3">
					<label for="handy">{{ __('template.user.handy') }}</label>
				</div>
				<div class="col-sm-8 col-xs-9">
					{{ $user->handy }}
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-4 col-xs-3">
					<label for="street">{{ __('template.user.street') }}</label>
				</div>
				<div class="col-sm-8 col-xs-9">
					{{ $user->street }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xs-3">
					<label for="zip">{{ __('template.user.zip') }}</label>
				</div>
				<div class="col-sm-8 col-xs-9">
					{{ $user->zip }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xs-3">
					<label for="city">{{ __('template.user.city') }}</label>
				</div>
				<div class="col-sm-8 col-xs-9">
					{{ $user->city }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xs-3">
					<label for="country">{{ __('template.user.country') }}</label>
				</div>
				<div class="col-sm-8 col-xs-9">
					{{ $user->country }}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="signature">{{ __('template.user.signature') }}</label>
		</div>
		<div class="col-sm-12"> 
			{!! $user->signature !!}
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			@if (Auth::check())
			@if (Auth::user()->id == $user->id ||Auth::user()->can('User-Admin'))

			<a href="{{ route('user.edit',$user->id) }}" class="btn"><span class="fa fa-edit"></span>
			</a>
			@endif
			@if (Auth::check() && Auth::user()->can('User-Admin'))
			<a href="{{ route('users.locked', $user->id) }}" class="btn"><span class="fa fa-lock"></span></a>			
			@endif
			
			@endif
		</div>
	</div>
</div>
@endsection
