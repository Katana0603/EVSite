
<ul class="bigScreen">
    <li class="header-nav-wrapper" id="mainnav-general">
        <a href="{{ route('news.index') }}" target="_self" style="">
            <span>Allgemein</span>
        </a>
    </li>
    <li class="" id="mainnav-event">
        <a href="{{ route('event.index') }}" target="_self" style="">
            <span>Event</span>
        </a>
    </li>
    <li class="" id="mainnav-forum">
        <a href="{{route('forum.index')}}" target="_self" style="">
            <span>Forum</span>
        </a>
    </li>
    <li class="" id="mainnav-esports ">
        <a href="#" target="_self" class="disabled" >
            <span>eSports</span>
        </a>
    </li>
    <li class="" id="mainnav-verein">
        <a href="#" target="_self"  class="disabled">
            <span>Ro.Fl. - e.V.</span>
        </a>
    </li>
    <li class="" id="mainnav-presse">
        <a href="#" target="_self"  class="disabled">
            <span>Presse</span>
        </a>
    </li>
</ul>

<div class="smallScreen">
    @include('frontend.layout._partial.menues.mobilemain')
</div>

@section('scripts')
<script>
    $(document).ready(function () {
    //if url contains event(fe.) -> mark id=mainnav-event
    $url = location.pathname.split('/')[1];


    if ($url == 'event') {
        document.getElementById('mainnav-event').classList.add('active');
    }
    else if($url == 'esports')
    {
        document.getElementById('mainnav-esports').classList.add('active');

    }
    else if($url == 'verein')
    {
        document.getElementById('mainnav-verein').classList.add('active');

    }
    else if($url == 'presse')
    {
        document.getElementById('mainnav-presse').classList.add('active');

    }
    else if($url == 'forum')
    {
        document.getElementById('mainnav-forum').classList.add('active');

    }
    else
    {

       document.getElementById('mainnav-general').classList.add('active');
   }

});
</script>
@append
