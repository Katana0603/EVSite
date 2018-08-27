
<nav class="main-navigation sub-nav">
	<div class="bigScreen">
		@if (Request::is(['event','event/*']))

		@include('frontend.layout._partial.menues.event')

		{{-- JScript aktive --}}
		@elseif(Request::is(['esports','esports/*']))

		@include('frontend.layout._partial.menues.eSports')

		@elseif (Request::is(['verein', 'verein/*']))

		@include('frontend.layout._partial.menues.verein')

		@elseif(Request::is(['presse', 'presse/*']))

		@include('frontend.layout._partial.menues.presse')

		@else

		@include('frontend.layout._partial.menues.general')
		@endif
	</div>
</nav>


