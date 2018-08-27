
<div class="row user-header-data">
	<div class="col-7">
		@if (Auth::check())
		{{ Auth::user()->username }}
		@endif
	</div>
	<div class="col-5">
		@if (Auth::check())
		<img src="{{ asset('storage/media/'.Auth::user()->avatar) }}" alt="User Img">
		@endif
	</div>
</div>
<div class="row user-header-buttons">
	<div class="col-10 offset-sm-1">
		<div class="btn-group user-header-buttons-btn-group">
			@if (Auth::check())

			<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="fas fa-sign-in-alt">
			</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

			@else   
			@include('frontend.layout._partial.modals.login')
			@endif

			@if (Auth::check())
			
			<a class="fas fa-envelope header-user-button @if($unreadMessages > 0) unread-messages @endif" href="{{ route('pm.get.messages') }}">
				<span></span>
			</a>
			
			<a class="fas fa-calendar-alt header-user-button" href="{{ route('calendar.events.index') }}">
				<span></span>
			</a>
			
			@can('Administer roles & permissions')
			
			<a href="{{ route('admin.index') }}" class="fas fa-wrench header-user-button"><span  />
				<span></span>
			</a>
			@endcan
			@include('frontend.layout._partial.issue')
			@endif
		</div>
	</div>
</div>


{{-- <div class="row user-header-data ">
	<div class="col-7">
		@if (Auth::check())
		<a href="{{ route('user.index', Auth::id()) }}" >
			{{ Auth::user()->username }}
		</a>
		@else
		{{ __('template.user.notLoggedIn') }}
		@endif
	</div>
	<div class="col-5">
		<div class="user-header-wrapper">

			@if (Auth::check())
			<img src="{{ asset('storage/media/'.Auth::user()->avatar) }}" alt="user img">
			@endif
		</div>
	</div>
</div>
<div class="header-user-buttonspanel right">
	<div class="row">
		<div class="col-12">
			<div class="btn-group">
				@if (Auth::check())

				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="fas fa-sign-in-alt">
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

				@else   
				@include('frontend.layout._partial.modals.login')
				@endif

				@if (Auth::check())

				<a data-notifications="0" class="fas fa-envelope " href="#">
				</a>
				<a data-notifications="0" class="fas fa-calendar-alt  " href="#">
				</a>
				@can('Administer roles & permissions')
				<a href="{{ route('admin.index') }}" class="header-user-message-notif"><span class="fa fa-wrench " /></a>
				@endcan
				@include('frontend.layout._partial.issue')
				@endif
			</div>
		</div>
	</div> --}}


