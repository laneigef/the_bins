<!--
=========================================================
 Paper Dashboard 2 - v2.0.0
=========================================================

 Product Page: https://www.creative-tim.com/product/paper-dashboard-2
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    WebBingo ダッシュボード
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/paper-dashboard.css') }}?v=2.0.0" rel="stylesheet" />
  <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="{{ route('issuer.index') }}" class="simple-text logo-mini">
          <div class="logo-image-small">
            <!-- <img src="../assets/img/logo-small.png"> -->
          </div>
        </a>
        <a href="{{ route('issuer.index') }}" class="simple-text logo-normal">
          ダッシュボード
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{ route('issuer.index') }}">
              <i class="nc-icon nc-tile-56"></i>
              <p>発行済みカード一覧</p>
            </a>
          </li>
          <li>
            <a href="{{ route('issuer.number') }}">
              <i class="nc-icon nc-diamond"></i>
              <p>ビンゴ番号指定</p>
            </a>
          </li>
          <li>
            <a href="{{ route('issuer.account') }}">
              <i class="nc-icon nc-single-02"></i>
              <p>アカウント情報変更</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <i class="nc-icon nc-spaceship"></i>
              <p>ログアウト</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
      @yield('content')
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Chart JS -->
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/paper-dashboard.min.js') }}?v=2.0.0" type="text/javascript"></script>
</body>

</html>
