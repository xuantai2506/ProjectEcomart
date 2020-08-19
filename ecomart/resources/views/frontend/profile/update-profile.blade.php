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
                                    <li>Chỉnh sửa thông tin tài khoản</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Checkout Area Start-->
        <div class="checkout-area mt-20">
            <div class="container">
                <div class="row">
                    <!--Checkout Area Start-->
                    <div class="col-lg-6 col-md-9">
                        <div class="checkout-form-area">
                            <div class="checkout-title">
                                <h3>CHỈNH SỬA THÔNG TIN TÀI KHOẢN</h3>
                            </div>
                            <div class="ceckout-form">
                                <!--Your Order Fields Start-->
                                <form method="post">
                                    @csrf
                                    <div class="your-order-fields mt-30">
                                        <div class="billing-fields">
                                            <div class="form-fild full-name">
                                                @if($profile['name'] != null)
                                                <input type="text" placeholder="Họ và tên *" name="name" value="{{$profile['name']}}">
                                                @else 
                                                <input type="text" placeholder="Họ và tên *" name="name" value="{{old('name')}}">
                                                @endif

                                                @if($errors->has('name'))
                                                <div class="col-md-12">
                                                    <span class="error-text" style="color: red">
                                                        {{$errors->first('name')}}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-fild billing_phone_number">
                                                @if($profile['phone'] != null)
                                                <input type="text" placeholder="Số điện thoại *" name="phone" value="{{$profile['phone']}}">
                                                @else
                                                <input type="text" placeholder="Số điện thoại *" name="phone" value="{{old('phone')}}">
                                                @endif

                                                @if($errors->has('phone'))
                                                <div class="col-md-12">
                                                    <span class="error-text" style="color: red">
                                                        {{$errors->first('phone')}}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-fild billing_email">
                                                @if($profile['email'] != null)
                                                <input type="text" disabled placeholder="Email *" name="email" value="{{$profile['email']}}">
                                                @else 
                                                <input type="text" placeholder="Email *" name="email" value="{{old('email')}}">
                                                @endif

                                                @if($errors->has('email'))
                                                <div class="col-md-12">
                                                    <span class="error-text" style="color: red">
                                                        {{$errors->first('email')}}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="form-fild billing_address">
                                                @if($profile['address_detail'] != null)
                                                <input type="text" placeholder="Địa chỉ *" name="address_detail" value="{{$profile['address_detail']}}">
                                                @else 
                                                <input type="text" placeholder="Địa chỉ *" name="address_detail" value="{{old('address_detail')}}">
                                                @endif

                                                @if($errors->has('address_detail'))
                                                <div class="col-md-12">
                                                    <span class="error-text" style="color: red">
                                                        {{$errors->first('address_detail')}}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>

                                            <?php 

                                                
                                                
                                             ?>

                                            <div class="form-fild country">
                                                <select name="province" id="province" data-placeholder="Chọn Tỉnh Thành..." tabindex="-1">
                                                    <option value="0">Chọn tỉnh thành…</option>
                                                    @foreach($province as $provinces)
                                                    <option value="{{$provinces['provinceId']}}" <?php echo ($provinces['provinceId'] == $province_id) ? 'selected' : "" ?>>{{$provinces['name']}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('province'))
                                                <div class="col-md-12">
                                                    <span class="error-text" style="color: red">
                                                        {{$errors->first('province')}}
                                                    </span>
                                                </div>
                                                @endif
                                                </div>
                                            <div class="form-fild country">
                                                <select name="district" id="district" data-placeholder="Chọn quận huyện…"  tabindex="-1">
                                                    <option value="0">Chọn quận huyện…</option>
                                                    @foreach($district as $districts)
                                                        @if($districts['provinceId'] == $province_id)
                                                        <option value="{{$districts['districtId']}}" <?php echo ($districts['districtId'] == $district_id) ? 'selected' : "" ?>>{{$districts['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @if($errors->has('district'))
                                                <div class="col-md-12">
                                                    <span class="error-text" style="color: red">
                                                        {{$errors->first('district')}}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-fild country">
                                                <select name="ward" id="ward" data-placeholder="Chọn Phường xã..." tabindex="-1">
                                                    <option value="0">Chọn phường xã…</option>
                                                    @foreach($ward as $wards)
                                                        @if($wards['districtid'] == $district_id)
                                                        <option value="{{$wards['wardid']}}" <?php echo ($wards['wardid'] == $ward_id) ? 'selected' : "" ?>>{{$wards['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @if($errors->has('ward'))
                                                <div class="col-md-12">
                                                    <span class="error-text" style="color: red">
                                                        {{$errors->first('ward')}}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="login-submit mt-30">
                                            <button type="submit" class="form-button">Cập nhập tài khoản</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Checkout Area End-->
                </div>
            </div>
        </div>
        <!--Checkout Area End-->
        @endsection