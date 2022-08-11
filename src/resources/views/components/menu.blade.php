<div class="menu">
  <div class="menu__header" id="menu__logo">
    <img src="{{ asset('icon/batu.png') }}"/>
  </div>

  <ul class="menu__content">
    <li><a href="{{ route('home') }}">Home</a></li>
    @guest
      <li><a href="{{ route('register') }}">Registration</a></li>
      <li><a href="{{ route('login') }}">Login</a></li>
    @endguest
    @auth
      <li><a href="{{ route('logout') }}">Logout</a></li>
      <li><a href="{{ route('mypage') }}">Mypage</a></li>
    @endauth
  </ul>
</div>

