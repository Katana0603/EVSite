
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">

  <a class="navbar-brand" href="{{ route('news.index') }}">
    <img src="{{ asset('img/fav.png') }}" width="30" height="30" alt="">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="mainDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Allgemein
        </a>
        <div class="dropdown-menu" aria-labelledby="mainDropDown">
          <a class="dropdown-item" href="{{ route('news.index') }}">Allgemein</a>
          <a class="dropdown-item" href="{{ route('articel.index') }}">Articel</a>
          {{-- <a class="dropdown-item" href="{{ route('tickets.index') }}">Tickets</a> --}}
          <a class="dropdown-item" href="{{ route('city.index') }}">City</a>
          <a class="dropdown-item" href="{{ route('download.index') }}">Download</a>
          <a class="dropdown-item" href="{{ route('team.index') }}">Team</a>
          <a class="dropdown-item" href="{{ route('teamspeak.index')}}">Teamspeak</a>
          <a class="dropdown-item" href="{{ route('partner.general') }}">Partner</a>
          <a class="dropdown-item disabled" href="#">Media</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="mainDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Event
        </a>
        <div class="dropdown-menu" aria-labelledby="mainDropDown">
          <a class="dropdown-item" href="{{ route('event.general') }}">General</a>
          <a class="dropdown-item" href="{{ route('event.tickets') }}">Tickets</a>
          <a class="dropdown-item" href="{{ route('event.tournaments') }}">Tournament</a>
          <a class="dropdown-item" href="{{ route('event.seatplan') }}">Seatplan</a>
          <a class="dropdown-item" href="{{ route('event.user') }}">User</a>
          <a class="dropdown-item" href="#">Anreise</a>
          <a class="dropdown-item" href="#">Sponsoren</a>
          <a class="dropdown-item" href="#">Downloads</a>
          <a class="dropdown-item disabled" href="#">Team</a>
          <a class="dropdown-item disabled" href="#">FAQ</a>
        </div>
      </li>

      <li class="nav-item" id="mainnav-forum">
        <a href="{{route('forum.index')}}" target="_self" style="" class="nav-link">
          <span>Forum</span>
        </a>
      </li>
      <li class="nav-item" id="mainnav-esports" >
        <a href="#" target="_self" class="nav-link disabled " >
          <span>eSports</span>
        </a>
      </li>
      <li class="nav-item" id="mainnav-verein" >
        <a href="#" target="_self"  class="nav-link disabled ">
          <span>Ro.Fl. - e.V.</span>
        </a>
      </li>
      <li class="nav-item" id="mainnav-presse" >
        <a href="#" target="_self"  class="nav-link disabled ">
          <span>Presse</span>
        </a>
      </li>
      @can('Administer roles & permissions')
      
      <a href="{{ route('admin.index') }}"  class="nav-link"><span  />
        <span>Administration</span>
      </a>
      @endcan
    </ul>
  </div>
</nav>