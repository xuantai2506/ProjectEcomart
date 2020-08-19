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
                                    <li>Thanh toán</li>
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
                    <div class="col-md-6">
                        <div class="checkout-form-area">
                            <div class="checkout-title">
                                <h3>THÔNG TIN ĐẶT HÀNG</h3>
                            </div>
                            <div class="ceckout-form">
                                <form method="post">
                                    @csrf
                                    <!--Billing Fields Start-->
                                    <div class="billing-fields">
                                        <div class="form-fild full-name">
                                            <input type="text" value="{{old('name')}}" placeholder="Họ và tên..." name="name"  value="">

                                            @if($errors->has('name'))
                                            <div class="col-md-12">
                                                <span class="error-text" style="color: red">
                                                    {{$errors->first('name')}}
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-fild billing_phone_number">
                                            <input type="text" value="{{old('phone')}}" placeholder="Số điện thoại..."  name="phone" value="">

                                            @if($errors->has('phone'))
                                            <div class="col-md-12">
                                                <span class="error-text" style="color: red">
                                                    {{$errors->first('phone')}}
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-fild billing_email">
                                            <input type="email" value="{{old('email')}}" placeholder="Email…" name="email" value="">
                                            @if($errors->has('email'))
                                            <div class="col-md-12">
                                                <span class="error-text" style="color: red">
                                                    {{$errors->first('email')}}
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-fild billing_address">
                                            <input type="text" value="{{old('address_detail')}}" placeholder="Địa chỉ…" name="address_detail" value="">
                                            @if($errors->has('address_detail'))
                                            <div class="col-md-12">
                                                <span class="error-text" style="color: red">
                                                    {{$errors->first('address_detail')}}
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-fild country">
                                            <select name="province" id="province" data-placeholder="Chọn Tỉnh Thành..." tabindex="-1">
                                                <option value="0">Chọn tỉnh thành…</option>
                                                @foreach($province as $provinces)
                                                <option value="{{$provinces['provinceId']}}">{{$provinces['name']}}</option>
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
                                                <option value="Chọn quận huyện… ">Chọn quận huyện…</option>
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
                                                <option value="Chọn phường xã…">Chọn phường xã…</option>
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
                                    <!--Billing Fields End-->
                                    <!--Shipping Fields Start-->
                                    <div class="shipping-fields">
                                        <div class="ship-fild">
                                            <input id="ship-box" name="is_active" type="checkbox">
                                            <label>Giao hàng đến địa chỉ khác </label>
                                        </div>
                                        <div id="ship-box-info" class="ship-box">
                                            <div class="ship-box-billing-fild">
                                                <div class="form-fild full-name">
                                                    <input type="text" placeholder="Họ và tên..." name="name_dif" value="">
                                                </div>
                                                <div class="form-fild billing_phone_number">
                                                    <input type="text" placeholder="Số điện thoại..." name="phone_dif" value="">
                                                </div>
                                                <div class="form-fild billing_email">
                                                    <input type="text" placeholder="Email…" name="email_dif" value="">
                                                </div>
                                                <div class="form-fild billing_address">
                                                    <input type="text" placeholder="Địa chỉ…" name="address_dif_detail" value="">
                                                </div>
                                                <div class="form-fild country">
                                                    <select name="province_difference"  id="province_difference" data-placeholder="Chọn tỉnh thành…"  >
                                                        <option value="0">Chọn tỉnh thành…</option>
                                                        @foreach($province as $provinces)
                                                        <option value="{{$provinces['provinceId']}}">{{$provinces['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-fild country">
                                                    <select name="district_difference" id="district_difference" data-placeholder="Chọn quận huyện… "  tabindex="-1 ">
                                                        <option value="Chọn quận huyện… ">Chọn quận huyện…</option>
                                                    </select>
                                                </div>
                                                <div class="form-fild country">
                                                    <select name="ward_difference" id="ward_difference" data-placeholder="Chọn phường xã…"  tabindex="-1 ">
                                                    <option value="Chọn phường xã…">Chọn phường xã…</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Shipping Fields End-->
                                    <!--Additional Fields Start-->
                                    <div class="additional-fields">
                                        <div class="order-notes">
                                            <div class="form-fild order-name">
                                                <textarea name="content" id="checkout-mess" placeholder="Ghi chú…" rows="2 " cols="5 "></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Additional Fields End-->
                            </div>
                        </div>
                    </div>
                    <!--Checkout Area End-->
                    <!--Checkout Area Start-->
                    <div class="col-md-6">
                        <div class="checkout-form-area">
                            <div class="checkout-title">
                                <h3>CHI TIẾT ĐƠN HÀNG</h3>
                            </div>
                            <div class="ceckout-form">
                                    <!--Your Order Fields Start-->
                                    <div class="your-order-fields mt-30">
                                        <div class="your-order-table table-responsive">
                                            <table>
                                                @if(isset($product_detail))
                                                <input type="hidden" name="purchase_now" value="{{$product_detail['product_id']}}">
                                                <tbody>
                                                    <?php $total = 0 ?>
                                                    <?php $price = $product_detail['price'] - (($product_detail['price'] * $product_detail['sale'])/100); ?>
                                                    <tr class="cart_item">
                                                        <td class="product-cart-img">
                                                            <a href=""><img src="{{asset('upload/product/'.$product_detail['images'])}}" alt=""></a>
                                                        </td>
                                                        <td class="product-name">{{$product_detail['name']}} <strong class="product-quantity"> ×{{$quantity}}</strong></td>
                                                        <td class="product-total"><span class="amount"><?php echo number_format($price * $quantity); ?>₫</span></td>
                                                    </tr>
                                                    <?php $total += ($price * $quantity) ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr class="cart-subtotal">
                                                        <th>Tạm tính:</th>
                                                        <td><span class="amount"><?php echo number_format($total); ?>₫</span></td>
                                                    </tr>
                                                    <tr class="shipping">
                                                        <th>Phí vận chuyển:</th>
                                                        <td data-title="shipping">
                                                            <p class="total-ship">0₫</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Tổng cộng:</th>
                                                        <td><strong><span class="total-amount"><?php echo number_format($total); ?>₫</span></strong></td>
                                                    </tr>
                                                </tfoot>

                                                @else 
                                                    @if(\session()->has('email'))

                                                    <tbody>
                                                        <?php $total = 0 ?>
                                                        @if(\session()->has('product'))
                                                        @foreach(\session()->get('product') as $product)
                                                        <?php $price = $product['price'] - (($product['price'] * $product['sale'])/100); ?>
                                                        <tr class="cart_item">
                                                            <td class="product-cart-img">
                                                                <a href="single-product.html"><img src="{{asset('upload/product/'.$product['images'])}}" alt=""></a>
                                                            </td>
                                                            <td class="product-name">{{$product['name_product']}} <strong class="product-quantity"> ×{{$product['quantity']}}</strong></td>
                                                            <td class="product-total"><span class="amount"><?php echo number_format($price * $product['quantity']); ?>₫</span></td>
                                                        </tr>
                                                        <?php $total += ($price * $product['quantity']) ?>
                                                        @endforeach
                                                        @endif
                                                    </tbody>

                                                    <tfoot>
                                                        <tr class="cart-subtotal">
                                                            <th>Tạm tính:</th>
                                                            <td><span class="amount"><?php echo number_format($total); ?>₫</span></td>
                                                        </tr>
                                                        <tr class="shipping">
                                                            <th>Phí vận chuyển:</th>
                                                            <td data-title="shipping">
                                                                <p class="total-ship">0₫</p>
                                                            </td>
                                                        </tr>
                                                        <tr class="order-total">
                                                            <th>Tổng cộng:</th>
                                                            <td><strong><span class="total-amount"><?php echo number_format($total); ?>₫</span></strong></td>
                                                        </tr>
                                                    </tfoot>
                                                    @endif
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                    <!--Your Order Fields End-->
                                    <div class="checkout-payment">
                                        <ul>
                                            <li class="payment_method_cheque-li">
                                                <input id="payment_method_cheque" class="input-radio" name="method_purchase" checked="checked" value="bacs" type="radio">
                                                <label for="payment_method_cheque">Chuyển khoản ngân hàng</label>
                                                <div class="pay-box payment_method_cheque">
                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </li>
                                            <li class="payment_method_paypal-li">
                                                <input id="payment_method_paypal" class="input-rado" name="method_purchase" value="paypal" data-order_button_text="Proceed to PayPal" type="radio">
                                                <label for="payment_method_paypal">VN PAY</label>
                                                <div class="pay-box payment_method_paypal">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <button class="order-btn" type="submit">ĐẶT HÀNG</button>
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