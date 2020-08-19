<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="vi">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Administration Control Panel">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <title>Administration Control Panel</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.css')}}" charset="utf-8" media="all">
    <!-- File input CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/fileinput.css')}}" media="all">
    <!-- MetisMenu CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/plugins/metisMenu/metisMenu.css')}}" media="all">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/style-admin.css')}}" media="all">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    <style>
        .cke {
            visibility: hidden;
        }
    </style>
    <!-- CKFinder -->
    <script type="text/javascript" src="{{asset('admin/editor/ckfinder/ckfinder.js')}}"></script>
    <!-- blueimp Gallery JavaScript -->
    <script type="text/javascript" src="{{asset('admin/js/gallery/jquery.blueimp-gallery.min.js')}}"></script>
    <style type="text/css">
        .fancybox-margin {
            margin-right: 0px;
        }
    </style>
    <style type="text/css">
        .highslide img {
            cursor: url(http://www.highcharts.com/highslide/graphics/zoomin.cur), pointer !important;
        }
        
        .highslide-viewport-size {
            position: fixed;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0
        }
    </style>
</head>
<div align="center">

		<div id="spinningSquaresG">

			<div id="spinningSquaresG_1" class="spinningSquaresG">

			</div>

			<div id="spinningSquaresG_2" class="spinningSquaresG">

			</div>

			<div id="spinningSquaresG_3" class="spinningSquaresG">

			</div>

			<div id="spinningSquaresG_4" class="spinningSquaresG">

			</div>

			<div id="spinningSquaresG_5" class="spinningSquaresG">

			</div>

			<div id="spinningSquaresG_6" class="spinningSquaresG">

			</div>

			<div id="spinningSquaresG_7" class="spinningSquaresG">

			</div>

			<div id="spinningSquaresG_8" class="spinningSquaresG">

			</div>

		</div>

		<span class="show-ok">{{$str}}</span>

		<br>Vui lòng đợi giây lát hoặc bấm <a style="font-weight:  bold;" href="{{URL::to($url)}}">vào đây</a> để tiếp tục...

	</div>

	<head>

		<meta http-equiv="Refresh" content="1; ">

	</head>