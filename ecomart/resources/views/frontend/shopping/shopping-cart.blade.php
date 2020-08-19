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
                                    <li>Giỏ hàng</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Shopping Cart Area Start-->
        <div class="shopping-cart-area mt-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="shop-form" action="#">
                            <div class="wishlist-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-remove"></th>
                                            <th class="product-cart-img">
                                                <span class="nobr">Hình ảnh</span>
                                            </th>
                                            <th class="product-name">
                                                <span class="nobr">Tên sản phẩm</span>
                                            </th>
                                            <th class="product-quantity">
                                                <span class="nobr">Số lượng</span>
                                            </th>
                                            <th class="product-price">
                                                <span class="nobr"> Đơn Giá </span>
                                            </th>
                                            <th class="product-total-price">
                                                <span class="nobr"> Thành tiền</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sumtotal = 0 ?>
                                        @if(\session()->has('product'))
                                            @foreach($data as $product)
                                            <?php $price = $product['price'] - (($product['price'] * $product['sale'])/100); ?>
                                                <tr class="tr_{{$product['id_product']}}">
                                                    <td class="product-remove">
                                                        <a class="remove-product" value="{{$product['price'] * $product['quantity']}}" id="{{$product['id_product']}}" href="#">×</a>
                                                    </td>
                                                    <td class="product-cart-img">
                                                        <a href="#"><img src="{{asset('upload/product/'.$product['images'])}}" alt=""></a>
                                                    </td>
                                                    <td class="product-name">
                                                        <a href="#">{{$product['name_product']}}</a>
                                                    </td>
                                                    <td class="product-quantity">
                                                        <div class="quantity modal-quantity">
                                                            <input id="{{$product['id_product']}}" value="{{$product['quantity']}}" class="change_quantity" type="number">
                                                        </div>
                                                    </td>
                                                    <td class="product-price">
                                                        <span><?php echo number_format($price); ?> VNĐ</span>
                                                        <input id="cart_price_{{$product['id_product']}}" type="hidden" value="{{$price}}" name="">
                                                    </td>
                                                    <td class="product-total-price">
                                                        <span id="total_{{$product['id_product']}}"><?php echo number_format($price * $product['quantity']) ?> VNĐ</span>
                                                        <input id="cart_total_{{$product['id_product']}}" type="hidden" value="{{$price * $product['quantity']}}" name="">
                                                    </td>
                                                </tr>
                                            <?php $sumtotal += ($price * $product['quantity']) ?>
                                       
                                            @endforeach
                                        @else 
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Chuaw co san pham nao</td>
                                        </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="shopping-cart-total">
                            <h2>Thanh Toán Giỏ Hàng</h2>
                            <div class="shop-table table-responsive">
                                <table>
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <td data-title="Số tiền"><span id="sumtotal"><?php echo number_format($sumtotal) ?> VNĐ</span></td>
                                        </tr>
                                        <tr class="shipping">
                                            <td data-title="Phí Ship">
                                                <Span>Liên hệ</Span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <td data-title="Tổng"><span><strong><?php echo number_format($sumtotal) ?> VNĐ</strong></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="proceed-to-checkout">
                                @if(\session()->has('email'))
                                <a class="checkout-button " href="{{URL::to('/checkout')}}">Thanh toán ngay</a>
                                @else 
                                <a class="checkout-button " href="{{URL::to('/logins')}}">Thanh toán ngay</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
        @endsection