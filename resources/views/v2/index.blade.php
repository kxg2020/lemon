<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Lemon</title>

  <!-- Styles -->
  <link href="{{ mix('v2/css/app.css') }}" rel="stylesheet">
  @yield('styles')
</head>
<body>
<div id="app">
  <div class="navbar">
    <div class="container navbar-container">
      <div class="navbar-first"><h1><a href="#/"
                                       class="title router-link-active">Lemon</a>
        </h1>
        <div class="nav-menu-btn" onclick="changeNav()">
          <button class="icon-button" style="height: 64px;"><i
              class="ion-navicon-round"></i>
          </button>
        </div>
      </div>
      <div id="navbar-list-box" class="navbar-list-box" style="height: 0px;">
        <ul id="navbar-list" class="navbar-list">
          <li class="navbar-item"><a href="#" class="nav-item-a">item</a>
          </li>
          <li class="navbar-item"><a href="#" class="nav-item-a">item</a>
          </li>
          <li class="navbar-item"><a href="#" class="nav-item-a">item</a>
          </li>
          <li class="navbar-item"><a href="#" class="nav-item-a">item</a>
          </li>
          <li class="navbar-item" id="search-show"><a href="#" class="nav-item-a"><i class="ion-search"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="main">
    <div class="container main-container">
      <div class="left-main">
        @yield('content')
      </div>
      <div class="right-main">
        <div class="right-item user"><img
            src="https://avatars2.githubusercontent.com/u/24952193?s=460&amp;v=4"
            alt="" class="user-avatar">
          <div class="user-name">lostinfo</div>
          <div class="user-intro">你就是打死我，我也不改这个bug</div>
          <div class="user-links">
            <div class="user-link"><a target="_blank"
                                      href="https://github.com/lostinfo"><i
                  class="ion-social-github"></i></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="footer-info">© 2017-2017 Lemon|<a
        href="http://www.miitbeian.gov.cn/"
        target="_blank">蜀ICP备17009035号</a>|<a
        href="http://www.qiniu.com" target="_blank">七牛云</a></div>
  </div>
</div>
@component('vendor.search')
@endcomponent
<!-- Scripts -->
<script>
  window.Home = {'apiUrl': '{{ e(route('home')) }}', 'csrfToken': '{{e(csrf_token())}}'};
  window.algolia_config = {'app_id': '{{env("ALGOLIA_APP_ID")}}', 'app_key': '{{env("ALGOLIA_SEARCH")}}'}
</script>
<script src="{{ mix('v2/js/app.js') }}"></script>
@yield('scripts')
<script>
  var minWidth768 = false
  widthChange()
  window.onresize = function () {
    widthChange()
  }
  function widthChange() {
    if (document.documentElement.clientWidth <= 768) {
      minWidth768 = true
    } else {
      minWidth768 = false
      $('#navbar-list-box').height('auto')
    }
  }
  console.log('height', $('#navbar-list-box').height())
  function changeNav() {
    console.log('changeNav')
    if (minWidth768) {
      $('#navbar-list-box').height() == 0 ? $('#navbar-list-box').height(405) : $('#navbar-list-box').height(0)
    }
  }
</script>
</body>
</html>
