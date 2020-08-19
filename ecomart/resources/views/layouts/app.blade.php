<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Administration Control Panel">
    <meta name="author" content="">

    <title>Administration Control Panel</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/style-login.css')}}" charset="utf-8" media="all">
    <!-- File input CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/fileinput.css')}}" media="all">
    <!-- MetisMenu CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/plugins/metisMenu/metisMenu.css')}}" media="all">
    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/animate.css')}}" media="all">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/plugins/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/plugins/jquery.dataTables.css')}}">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/js/jquery.calendar/jquery.datetimepicker.css')}}">
    <!-- Popup Alert CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/popup/jquery.boxes.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- blueimp Gallery CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap&amp;subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/gallery/blueimp-gallery.min.css')}}">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/js/fancybox/jquery.fancybox.css?v=2.1.5')}}" charset="utf-8" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/js/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/js/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7')}}" media="screen">
    <!-- jQuery Version 1.11.0 -->
    <script type="text/javascript" src="{{asset('admin/js/jquery/jquery-1.11.0.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/bootstrap/bootstrap.js')}}"></script>
    <!-- Modernizr JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/modernizr.min.js')}}"></script>
    <!-- File input JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/bootstrap/fileinput.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/plugins/metisMenu/metisMenu.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/tth-admin.js')}}"></script>
    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/plugins/dataTables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
    <!-- Datetimepicker JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/jquery.calendar/jquery.datetimepicker.js')}}"></script>
    <!-- Bootstrap-wizard JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/bootstrap/bootstrap-wizard.min.js')}}"></script>
    <!-- Bootstrap-tagsinput JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/bootstrap/bootstrap-tagsinput.js')}}"></script>
    <!-- autoNumeric JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/autoNumeric.js')}}"></script>
    <!-- validate JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/jquery.validation/jquery.validate.min.js')}}"></script>
    <!-- Fancybox JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/fancybox/jquery.fancybox.js?v=2.1.5')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7')}}"></script>
    <!-- Popup Alert JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <!-- Validate JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/script.js')}}"></script>
    <!-- Popup Alert JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/jquery.popup/jquery.boxes.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/jquery.popup/jquery.boxes.repopup.js')}}"></script>
    <!-- CKEditor -->
    <script type="text/javascript" src="{{asset('admin/editor/ckeditor/ckeditor.js')}}"></script>

<!--     <title>{{ config('app.name', 'Laravel') }}</title> -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
        <!--             {{ config('app.name', 'Laravel') }} -->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<!-- Javascript -->
  <script src="../js/index.js"></script>
<script>
    $('.main').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    jQuery(document).ready(function($) {
        $(function() {
            $("#forgot-password").click(function() {
                $(".login-form").slideUp();
                $(".forgot-form").slideDown();
            });
            $("#login-user").click(function() {
                $(".forgot-form").slideUp();
                $(".login-form").slideDown();
            });
        })
    });
</script>

</html>
