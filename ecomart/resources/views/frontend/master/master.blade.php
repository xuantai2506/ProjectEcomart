<!DOCTYPE html>
<html lang="vi">
<head>
	<title>Ecomart</title>
	@include('frontend.master.head')
</head>
<body>
	<div class="wrapper home-7">

		<header>
			@include('frontend.master.header')
		</header>

		<!-- !!!!!!!!!!!!----------content----------!!!!!!!!!!!!! -->
			@yield('content')
		<!-- !!!!!!!!!!!!--------EndContent----------!!!!!!!!!!!!! -->
		
		<!--Footer Middel Area Start-->
        <div class="footer-middel-area mt-30">
        	@include('frontend.master.register_email')
        </div>

        <!--Footer Area Start-->
        <footer>
        	@include('frontend.master.footer')
        </footer>

        
	</div>
		<!--   javascript  -->
			@include('frontend.master.script')
		<!-- end javascript -->
</body>
</html>