@extends('layouts.app')
@section('content')
<body>
    <div class="container">
        <!-- Canvas animation bg -->
        <div id="canvas-wrapper" style="display: none; height: 215px;">
            <canvas id="bg-canvas" width="1280" height="215"></canvas>
        </div>
        <section class="main">
            <div class="center_ne">
                <a href="#">
                    <div class="logo">
                        <img src="{{asset('admin/images/logo_login.svg')}}">
                    </div>
                </a>
                <div class="login-form">
                    <form id="formID" class="tth-form" action="{{ route('login') }}" method="post">
                        @csrf
                        <h3>Đăng nhập hệ thống quản trị</h3>
                        <p class="field">
                            <input class=" input-login-form @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}"  maxlength="30" placeholder="Tên đăng nhập" type="text"  title="Tên đăng nhập" required autocomplete="email" autofocus  data-prompt-position="topRight:-60">
                   <!--          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </p>
                        <p class="field">
                            <input class="input-login-form  @error('password') is-invalid @enderror" type="password" maxlength="30" placeholder="Mật khẩu" name="password" required autocomplete="current-password" type="password"  title="Mật khẩu" data-prompt-position="topRight:-20">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                        <p class="submit">
                            <button type="submit" data-placement="left" title="Đăng nhập" name="login_admin">Đăng nhập</button>
                        </p>
                        <p class="change_link">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Quên mật khẩu ?
                                </a>
                            @endif
                            <a href="tel:0905213308" id="telme">Hotline: 0905 213 308</a>
                        </p>
                    </form>
                </div>

                <div class="forgot-form" style="display: none;">
                    <form id="formForgot" class="tth-form" name="formForgot" method="post" onsubmit="return sendLostForgot('formForgot');">
                        <h3>Thiết lập mật khẩu mới</h3>
                        <p class="field">
                            <input class="input-login-form" maxlength="255" placeholder="Tên đăng nhập / Email" name="forgot_user_email" type="text" required="required" title="Tên đăng nhập / Email" autocomplete="off" data-prompt-position="topRight:-60">
                        </p>
                        <p class="submit">
                            <button type="submit" data-toggle="tooltip" data-placement="left" title="Gửi đi" name="s_forgot">Xác nhận</button>
                        </p>
                        <p class="change_link">
                            <a href="javascript:void(0)" id="login-user" style="float: right;"><i class="fa  fa-rotate-right fa-fw"></i> Quay lại Đăng Nhập</a>
                        </p>
                    </form>
                </div>
            </div>
        </section>
        <div id="loadingPopup" style="z-index: 999;"></div>
    </div>
   
</body>
@endsection
