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
                                    <li><a href="{{URL::to('')}}">Trang chủ</a><span class="breadcome-separator">></span></li>
                                    <li>Đặt lại mật khẩu</li>
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
                    <div class="col-lg-6 col-md-9">
                        <div class="customer-login-register">
                            <div class="form-login-title">
                                <h2>Đặt lại mật khẩu</h2>
                            </div>
                            @if(session('danger'))
                                <div class="alert alert-danger">
                                    <div class="alert-title">{{session('danger')}}</div>
                                </div>
                             @endif
                            <div class="login-form">
                                <form method="post">
                                    @csrf
                                    <label>Chúng tôi sẽ gửi cho bạn một email để kích hoạt việc đặt lại mật khẩu.</label>
                                    <div class="form-fild">
                                        <input type="text" style="background: black;color: white " disabled name="email" value="{{$email}}" placeholder="Email *">
                                    </div>
                                    <div class="form-fild">
                                        <input type="password" value="{{old('password')}}" name="password" value="" placeholder="Mật khẩu *">
                                        @if($errors->has('password'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('password')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-fild">
                                        <input type="password" name="password_confirmed" value="" placeholder="Mật khẩu *">
                                        @if($errors->has('password_confirmed'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('password_confirmed')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="login-submit">
                                       <button type="submit" class="form-button login">Thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Login Form End-->
                </div>
            </div>
        </section>
        <!--My Account Area End-->
        @endsection