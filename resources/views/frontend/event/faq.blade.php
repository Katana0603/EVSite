@extends('frontend.layout.app')

@section('title')

FAQ

@endsection

@section('content')

<div class="box center">
	<h2 class="center">{{ __('template.event.FAQ.header') }}</h2>
	<div class="row no no-gutters">
		<div class="content-workspace">
			<div class="content-text">


				<button class="accordion faq-header">FAQ 1</button>
				<div class="panel faq-panel">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>

				<button class="accordion faq-header">FAQ 2</button>
				<div class="panel faq-panel">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>

				<button class="accordion faq-header">Q: 3</button>
				<div class="panel faq-panel">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>

			</div>
		</div>
	</div>

</div>
@endsection

@section('scripts')
<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var panel = this.nextElementSibling;
			if (panel.style.maxHeight){
				panel.style.maxHeight = null;
			} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
			} 
		});
	}
</script>

@append