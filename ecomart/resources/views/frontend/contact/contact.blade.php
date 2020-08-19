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
                                    <li>Liên hệ</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Contact Form Area Start-->
        <section class="contact-form-area mt-20">
            <div class="container">
                <div class="row">
                    <!--Contact Form Start-->
                    <div class="col-lg-7">
                        <div class="contact-form-title">
                            <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
                        </div>
                        <div class="contact-form">
                            <form method="post">
                                @csrf
                                <div class="contact-input">
                                    <div class="first-name">
                                        <input type="text" name="fullname" value="{{old('fullname')}}" placeholder="Họ , tên người đại diện... *">
                                        @if($errors->has('fullname'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('fullname')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="last-name">
                                        <input type="text" name="phone" value="{{old('phone')}}" placeholder="Số điện thoại... *">
                                        @if($errors->has('phone'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('phone')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="email">
                                        <input type="text" name="email" value="{{old('email')}}" placeholder="Email... *">
                                        @if($errors->has('email'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('email')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="subject">
                                        <input type="text" name="address" value="{{old('address')}}" placeholder="Địa chỉ... *">
                                        @if($errors->has('address'))
                                        <div class="col-md-12">
                                            <span class="error-text" style="color: red">
                                                {{$errors->first('address')}}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="contact-message mb-20">
                                    <div class="message pr-10 pr-xs-0">
                                        <textarea name="comments"  placeholder="Lời nhắn *" rows="2 " cols="5 "></textarea>
                                    </div>
                                </div>
                                <div class="contact-submit">
                                    <button type="submit" class="form-button">GỬI THÔNG TIN</button>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                    <!--Contact Form End-->
                    <!--Contact Address Start-->
                    <div class="col-lg-5">
                        <div class="contact-address-info">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.049014006236!2d108.21656131393367!3d16.06294614387507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219cb41bfc23d%3A0x97392c3aa7c53f37!2zMTEzIMSQxrDhu51uZyBIb8OgbmcgVsSDbiBUaOG7pSwgUGjGsOG7m2MgTmluaCwgUS4gSOG6o2kgQ2jDonUsIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1590393971119!5m2!1svi!2s"
                                width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                    <!--Contact Address End-->
                </div>
            </div>
        </section>
        <!--Contact Form Area End-->
        @endsection