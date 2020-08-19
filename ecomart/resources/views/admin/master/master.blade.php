<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>@yield('title')</title>
	
    @include('admin.master.header')
    <!-- script -->
	@include('admin.master.script-header')
	<!--  end  -->
</head>
<body class="main-nav-closed">
    <div id="wrapper">
        @include('admin.master.navigation')
        
        <!-- content -->
		@yield('content')
        <!-- endconten -->

        @include('admin.master.footer')
</body>

	<!-- Javascript -->
	@include('admin.master.script-footer')