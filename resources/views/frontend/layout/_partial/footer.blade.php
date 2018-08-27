<div class="footer-button-wrapper">
    <div class="footer-button" id="footer-button">
     ^
 </div>
</div>
<div class="footer-content" id="footer-content">
    <div class="row">
        <div class="col-4">
            <h5 class="center">{{ __('template.footer.about') }}</h5>
            <div class="col-12">
                <img alt="Logo Img" src="{{ asset('img/logo.png') }}" class="siteLogo">
            </div>
            <br/>
            <div class="col-12">
                Our Mission is to discover new Worlds <br/> and earn honor
            </div>

        </div>
        <div class="col-4">
            <div class="col-12 center">

            </div>
            <div class="col-12">

                <h5 class="center">{{ __('template.footer.shortcuts') }}</h5>
                <ul>
                    <li><a href="{{ route('news.index') }}"><span>Main Page</span></a></li>
                    <li><a href="{{ route('event.index') }}"><span>Event</span></a></li>
                    <li><a href="{{ route('partner.general') }}"><span>Partner</span></a></li>
                    <li><a href="{{ route('download.index') }}"><span>Downloads</span></a></li>
                    <li><a href="{{ route('event.faq') }}"><span>FAQ</span></a></li>

                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="col-12">
                <a href="{{ config('social.facebook') }}" class="  socialbutton "><span class="fab fa-facebook"></span></a>

                <a href="{{ config('social.twitch') }}" class="  socialbutton "><span class="fab fa-twitch"></span></a>

                <a href="{{ config('social.youtube') }}" class="  socialbutton "><span class="fab fa-youtube"></span></a>
                <a href="{{ config('social.instagram') }}" class="  socialbutton "><span class="fab fa-instagram"></span></a>

            </div>
            <div class="col-12">
                Stats / Events
            </div>
        </div>
    </div>


    <hr/>
    <div class="row">
        <div class="col-12">
            {{ __('template.footer.newsletter.intro') }}
            <br/>
            <input type="text" placeholder="Newsletter.."> <button class="button btn btn-success">Sign Up</button>

            <hr/>
        </div>

        <div class="col-12 center">
            <a href="#">Sitemap(link)</a> + <a href="{{ route('privacyPolicy') }}">Private Policy</a> + <a href="{{ route('termsOfService') }}">Terms of Service</a>
        </div>
        <div class="col-12 center">
            Copyright from Kevin Winter ({{ date('Y') }})
        </div>
    </div>




    @section('scripts')

    <script> 
        $(document).ready(function(){
            $("#footer-button").click(function(){
                $("#footer-content").slideToggle("slow");
            });
        });
    </script>
    @append