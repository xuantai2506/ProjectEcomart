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
                                    <li>Thông tin tài khoản</li>
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
                    <div class="col-lg-6 col-md-12">
                        <div class="checkout-form-area">
                            <div class="checkout-title">
                                <h3>THÔNG TIN TÀI KHOẢN</h3>
                            </div>
                            <div class="ceckout-form">
                                <!--Your Order Fields Start-->
                                <div class="your-order-fields mt-30">
                                    <div class="your-profile-table table-responsive">
                                        <table>
                                            <tbody>
                                                <tr class="cart_item">
                                                    <th class="title-name">Họ và Tên :</th>
                                                    @if($profile['name'] != null)
                                                    <td class="content-name">{{$profile['name']}}</td>
                                                    @else 
                                                    <td class="content-name" style="color: red">User</td>
                                                    @endif
                                                </tr>
                                                <tr class="cart_item">
                                                    <th class="title-name">Email :</th>
                                                    @if($profile['email'] != null)
                                                    <td class="content-name">{{$profile['email']}}</td>
                                                    @else
                                                    <td class="content-name" style="color: red">* Vui lòng cập nhật tài khoản email !</td>
                                                    @endif
                                                </tr>
                                                <tr class="cart_item">
                                                    <th class="title-name">Số điện thoại :</th>
                                                    @if($profile['phone'] != null)
                                                    <td class="content-name">{{$profile['phone']}}</td>
                                                    @else
                                                    <td class="content-name" style="color: red">* Vui lòng cập nhật số điện thoại !</td>
                                                    @endif
                                                </tr>
                                                <tr class="cart_item">
                                                    <th class="title-name">Địa chỉ :</th>
                                                    @if($profile['address_detail'] != null)
                                                    <td class="content-name">{{$profile['address_detail']}}</td>
                                                    @else 
                                                    <td class="content-name" style="color: red">* Vui lòng cập nhật địa chỉ !</td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="login-submit mt-30">
                                        <button type="submit" class="form-button" onclick="location.href='update-profile';">Chỉnh sửa thông tin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Checkout Area End-->
                </div>
            </div>
        </div>
        <!--Checkout Area End-->
      @endsection