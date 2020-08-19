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
                                    <li>Danh sách yêu thích</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!-- Wishlist Table Area Start-->
        <div class="wishlist-table-area mt-20 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
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
                                        <th class="product-price">
                                            <span class="nobr"> Giá </span>
                                        </th>
                                       <!--  <th class="product-stock-stauts">
                                            <span class="nobr"> Trạng thái</span>
                                        </th> -->
                                        <th class="product-add-to-cart">Thêm vào giỏ hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $products)
                                        @foreach($get_wishlist as $get_wishlists)
                                            @if($products['product_id'] == $get_wishlists['product_id'])

                                            <tr class="delete_{{$products['product_id']}}">
                                                <td class="product-remove wishlist-remove" id="{{$products['product_id']}}">
                                                    <a href="#">×</a>
                                                </td>
                                                <td class="product-cart-img">
                                                    <a href="#"><img src="{{asset('upload/product/'.$products['images'])}}" alt=""></a>
                                                </td>
                                                <td class="product-name">
                                                    <a href="{{URL::to('product/'.$products['slug'])}}">{{$products['name']}}</a>
                                                </td>
                                                <td class="product-price">
                                                    <span>{{$products['price']}} VNĐ</span>
                                                </td>
                                           <!--      <td class="product-stock-status">
                                                    <span class="wishlist-in-stock">Còn hàng</span>
                                                </td> -->
                                                <td class="product-add-to-cart">
                                                    <a class="wishlist-btn add-product" id="{{$products['product_id']}}" href="#">Thêm vào giỏ hàng</a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Wishlist Table Area End-->
        @endsection