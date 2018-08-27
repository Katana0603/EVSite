
<!DOCTYPE html>
<html style="background-image: url({{ asset('img/background.png')}});">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ config('app.name') }} @yield('title') </title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<meta name="author" content="K.Winter">
	<meta name="description" content="">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('img/fav.png') }}" sizes="96x96">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

	<!-- App CSS -->

	<!-- CSRF Token -->
	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
			]) !!};
		</script>


<!-- Start Cookie Plugin -->
<script type="text/javascript">
  window.cookieconsent_options = {
  message: 'This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our <a href="{{ route('cookiePolicy') }}" target="_blank">Cookie Policy</a>, <a href="{{ route('privacyPolicy') }}" target="_blank">Privacy Policy</a>, and our <a href="{{ route('termsOfService') }}" target="_blank">Terms of Service</a>. Your use of Ro.Fl.-Crew’s Products and Services, including the Ro.Fl.-e.V. & Ro.Fl.-Lan, is subject to these policies and terms. ',
  dismiss: 'Got  it!',
  learnMore: 'Mehr Infos',
  link: 'https://eu-datenschutz.org/',
  theme: 'dark-bottom'
 };
</script>
<script type="text/javascript" src="{{ asset('js/admin/cookieshinweis.js') }}"></script>
<!-- Ende Cookie Plugin -->
		@yield('css')
		@yield('styles')

		@include('frontend.layout.includes.css')

	</head>
	<body>
		<header class="col-12 header">
			<div class="row height100">
				<div class="col-2 logo-wrapper">
					<a href="{{ route('news.index') }}">
						<div class="siteLogo-wrapper">
							<img alt="Logo Img" src="{{ asset('img/logo.png') }}" class="siteLogo"> 
						</div>
					</a>
				</div>
				<nav class="col-lg-8 main-navigation ">
					<div class="row">
						@include('frontend.layout._partial.menues.main')
						@include('frontend.layout._partial.subNav')
					</div>
				</nav>
				<div class="col-2 user-box">
					@include('frontend.layout._partial.user')

				</div>
			</div>
		</header>
		<aside class="col-sm-2 left-sitebar bigScreen">
			@include('frontend.layout._partial.leftsitebar')
		</aside>
		<main class="col-md-8 offset-md-2"> 
			<div class="container content-wrapper">
				<div class="row">
					<div class="col-12">
						@include('flash::message')
						{{-- @include ('errors.list') Including error file --}}
					</div>
				</div>
				@yield('content')


			</div>


		</main>
		<aside class="col-sm-2 right-sitebar hidden-sm hidden-xs  no-gutters bigScreen">
			@include('frontend.layout._partial.rightsitebar')
		</aside>
		<footer>
			@include('frontend.layout._partial.footer')
		</footer>

{{-- 		<footer>

</footer> --}}

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



{{-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script> --}} 


<!-- Javascript Libs -->
<script type="text/javascript" src="{{ asset('js/template.js') }}"></script>

@yield('scripts')



@yield('modals')



</body>
</html>