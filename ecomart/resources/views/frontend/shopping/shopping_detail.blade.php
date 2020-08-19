@extends('frontend.master.master')
@section('content')
        <!--Heading Banner Area Start-->
        <div class="heading-banner-area pt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-banner">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="{{URL::to('')}}">Trang chủ</a><span class="breadcome-separator">></span></li>
                                    <li>Cửa Hàng</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Heading Banner Area End-->
        <!--Product List Grid View Area Start-->
        <div class="product-list-grid-view-area mt-20">
            <div class="container">
                <div class="row">
                    <!--Shop Product Area Start-->
                    <div class="col-lg-9 order-lg-2 order-1">
                        <!--Shop Tab Menu Start-->
                        <div class="shop-tab-menu">
                            <div class="row">
                                <!-- View Mode Start-->
                                <div class="col-lg-6 col-md-6 col-xl-6 col-sm-3">
                                    <div class="row">
                                        <h4 class="title-shop">CỬA HÀNG</h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xl-6 col-sm-9">

                                    <div class="toolbar-form">
                                        <form action="#">
                                            <div class="toolbar-select">
                                                <span>Sắp xếp:</span>
                                                <select data-placeholder="Mặc định" class="order-by" tabindex="1">
                                                    <option value="Mặc định">Mặc định</option>
                                                    <option value="United States">Nổi bật</option>
                                                    <option value="United Kingdom">Combo</option>
                                                    <option value="Afghanistan">Khuyến mãi </option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- View Mode End-->
                            </div>
                        </div>
                        <!--Shop Tab Menu End-->
                        <!--Shop Product Area Start-->
                        <div class="shop-product-area">
                            <div class="tab-content">
                                <!--Grid View Start-->
                                <div id="grid-view" class="tab-pane fade show active">
                                    <div class="row product-container">
                                        @foreach($product_list as $product_lists)
                                        <!--Single Product Start-->
                                        <div class="col-lg-3 col-md-3 col-sm-6 item-col2">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a href="">
                                                        <img class="first-img" src="{{URL::to('upload/product/'.$product_lists['images'])}}" alt="">
                                                    </a>
                                                    <span class="sicker">-{{$product_lists['sale']}}%</span>
                                                    <ul class="product-action">
                                                        @if(\session()->has('email'))
                                                        <li><a href="#" id="{{$product_lists['product_id']}}" data-toggle="tooltip" class="wishlist" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                                        @else 
                                                        <li><a  class="check_wish_list" data-toggle="tooltip" title="Add to Wishlistsss"><i class="ion-android-favorite-outline"></i></a></li>
                                                        @endif
                                                        <li><a href="#" data-toggle="modal" title="Quick View" data-target="#myModal_{{$product_lists['product_id']}}"><i class="ion-android-expand"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-content">
                                                    <h2><a href="{{URL::to('product/'.$product_lists['slug'])}}">{{$product_lists['name']}}</a></h2>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="product-price">
                                                        <span class="new-price"><?php echo number_format($product_lists['price'] - (($product_lists['price']*$product_lists['sale'])/100)) ?>đ</span>
                                                        <span class="old-price"><?php echo number_format($product_lists['price']) ?>đ</span>
                                                        <a class="button add-btn add-product" id="{{$product_lists['product_id']}}" href="#" data-toggle="tooltip" title="Mua hàng">Mua hàng</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Single Product End-->
                                        @endforeach
                                    </div>
                                </div>
                                <!--Grid View End-->
                            </div>
                        </div>
                        <!--Shop Product Area End-->
                        <!--Pagination Start-->
                        <div class="pagination pb-10">
                            <ul class="page-number">
                                
                            </ul>
                        </div>
                        <!-- div class="pagination pb-10">
                            <ul class="page-number">
                                <li class="active"><a href="shop.html">1</a></li>
                                <li><a href="shop.html">2</a></li>
                                <li><a href="shop.html">3</a></li>
                                <li><a href="shop.html">4</a></li>
                                <li><a href="shop.html"><i class="fa fa-angle-double-right"></i></a></li>
                            </ul>
                        </div> -->
                        <!--Pagination End-->
                    </div>
                    <!--Shop Product Area End-->
                    <!--Left Sidebar Start-->
                    <div class="col-lg-3 order-lg-1 order-2">
                        <!--Widget Shop Categories start-->
                        <div class="widget widget-shop-categories categories1">
                            <h3 class="widget-shop-title">DANH MỤC SẢN PHẨM</h3>
                            <div class="widget-content">
                                <ul class="product-categories">
                                    @foreach($product_menu_child as $product_menu_childs)
                                    <li><a href="{{URL::to('search/'.$product_menu_childs['slug'])}}">{{$product_menu_childs['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--Widget Shop Categories End-->
                        <!--Widget Shop Categories start-->
                        <div class="widget widget-shop-categories categories2">
                            <h3 class=" widget-shop-title">THEO MỨC GIÁ</h3>
                            <div class="widget-content">
                                <ul class="product-categories">
                                    @if(isset($others_id))
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&other='.$others_id.'&price=1')}}">Giá dưới 500.000đ</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&other='.$others_id.'&price=2')}}">500.000đ - 1.000.000đ</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&other='.$others_id.'&price=3')}}">1.000.000đ - 3.000.000</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&other='.$others_id.'&price=4')}}">3.000.000 - 5.000.000</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&other='.$others_id.'&price=5')}}">5.000.000 - 8.000.000</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&other='.$others_id.'&price=6')}}">8.000.000 - 10.000.000</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&other='.$others_id.'&price=7')}}">Lớn hơn 10.000.000</a></li>
                                    @else
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&price=1')}}">Giá dưới 500.000đ</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&price=2')}}">500.000đ - 1.000.000đ</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&price=3')}}">1.000.000đ - 3.000.000</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&price=4')}}">3.000.000 - 5.000.000</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&price=5')}}">5.000.000 - 8.000.000</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&price=6')}}">8.000.000 - 10.000.000</a></li>
                                    <li><a href="{{URL::to('search/'.$slug_product_menu.'&price=7')}}">Lớn hơn 10.000.000</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!--Widget Shop Categories End-->
                        <!--Widget Shop Categories start-->
                        <div class="widget widget-shop-categories categories3">
                            <h3 class=" widget-shop-title">NHÀ SẢN XUẤT</h3>
                            <div class="widget-content">
                                <ul class="product-categories">
                                    @if(isset($id_price))
                                        @foreach($other as $others)
                                        <li><a href="{{URL::to('search/'.$slug_product_menu.'&price='.$id_price.'&other='.$others['others_id'])}}">{{$others['name']}}</a></li>
                                        @endforeach
                                    @else
                                        @foreach($other as $others)
                                        <li><a href="{{URL::to('search/'.$slug_product_menu.'&other='.$others['others_id'])}}">{{$others['name']}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!--Widget Shop Categories End-->
                    </div>
                    <!--Left Sidebar End-->
                </div>
            </div>
                <!--Widget Shop Categories End-->
        </div>
        <!--Product List Grid View Area End-->

        <!-- modal -->
        @include('frontend.master.modal')
@endsection