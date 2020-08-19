@extends('frontend.master.master')
@section('content')
        <!--Heading Banner Area Start-->
        <section class="heading-banner-area pt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-banner">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="index.html">Trang chủ</a><span class="breadcome-separator">></span></li>
                                    <li>Đăng nhập - Đăng ký</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--My Account Area Start-->
        <section class="my-account-area mt-20">
            <div class="container">
                <div class="row">
                    <!--Login Form Start-->
                    <div class="col-lg-6 col-md-8">
                        <div class="customer-login-register">
                            <div class="form-login-title">
                                <h2>Đăng Nhập</h2>
                            </div>
                            @if(session('fail-login'))
                                <div class="alert alert-danger">
                                     <div class="alert-title">{{session('fail-login')}}</div>
                                </div>
                            @endif
                            <div class="login-form">
                                <form method="post">
                                    @csrf
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <div class="form-fild">
                                        <input type="text" name="email" value="{{old('email')}}" placeholder="Email *">
                                        @if($errors->has('email'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('email')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-fild">
                                        <input type="password" name="password" value="" placeholder="Mật khẩu *">
                                        @if($errors->has('password'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('password')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="lost-password">
                                        <a href="{{URL::to('reset-password')}}">Quên mật khẩu ?</a>
                                    </div>

                                    <div class="login-submit">
                                        <button type="submit" class="form-button">Đăng Nhập </button>
                                        <button type="submit" class="form-button btn-gg"><img src="{{asset('frontend/img/icon/login-google.svg')}}" alt=""></button>
                                        <button type="submit" class="form-button btn-fb"><img src="{{asset('frontend/img/icon/login-facebook.svg')}}" alt=""></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Login Form End-->
                    <!--Register Form Start-->
                    <div class="col-lg-6 col-md-8">
                        <div class="customer-login-register register-pt-0">
                            <div class="form-register-title">
                                <h2>Đăng ký</h2>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                     <div class="alert-title">{{session('success')}}</div>
                                </div>
                            @endif
                            @if(session('fail'))
                                <div class="alert alert-danger">
                                     <div class="alert-title">{{session('fail')}}</div>
                                </div>
                            @endif
                            <div class="register-form">
                                <form method="post" action="registers">
                                    @csrf
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <div class="form-fild">
                                        <input type="text" name="name" value="{{old('name')}}" placeholder="Họ và tên *">
                                        @if($errors->has('name'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('name')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-fild">
                                        <input type="email" name="email" value="{{old('email')}}" placeholder="Email *">
                                        @if($errors->has('email'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('email')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-fild">
                                        <input type="text" name="phone" value="{{old('phone')}}" placeholder="Số điện thoại *">
                                        @if($errors->has('phone'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('phone')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-fild">
                                        <input type="password" name="password" value="" placeholder="Mật khẩu *">
                                        @if($errors->has('password'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('password')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-fild">
                                        <input type="password" name="password_confirmation" value="" placeholder="Mật khẩu *">
                                        @if($errors->has('password_confirmation'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('password_confirmation')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="register-submit">
                                        <button type="submit" class="form-button">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Register Form End-->
                </div>
            </div>
        </section>
        <!--My Account Area End-->
       
        @endsection