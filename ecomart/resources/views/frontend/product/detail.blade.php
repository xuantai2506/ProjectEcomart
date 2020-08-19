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
                                    <li><a href="{{URL::to('cua-hang')}}">Cửa hàng</a><span class="breadcome-separator">></span></li>
                                    @foreach($product_menu as $product_menus)
                                    @if($product_detail['product_menu_id'] == $product_menus['product_menu_id'])
                                    <li class="a-none">{{$product_detail['name']}}</li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Heading Banner Area End-->
        <!--Single Product Area Start-->
        <section class="single-product-area mt-20">
            <div class="container">
                <!--Single Product Info Start-->
                <div class="row single-product-info mb-50">
                    <!--Single Product Image Start-->
                    <div class="col-lg-6 col-md-6">
                        <!--Product Tab Content Start-->
                        <div class="single-product-tab-content tab-content">

                            <div id="w1" class="tab-pane fade in active">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{asset('upload/product/'.$product_detail['images'])}}">
                                        <img src="{{asset('upload/product/'.$product_detail['images'])}}" alt="">
                                    </a>
                                </div>
                            </div>

                            <?php $album = json_decode($product_detail['upload_images']); ?>
                            @if($album != 'no' && is_array($album))
                                @foreach($album as $key => $rows)
                                    <div id="w{{$key + 2}}" class="tab-pane fade">
                                        <div class="easyzoom easyzoom--overlay">
                                            <a href="{{asset('upload/product/'.$rows)}}">
                                                <img src="{{asset('upload/product/'.$rows)}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            

                        </div>
                        <!--Product Tab Content End-->
                        <!--Single Product Tab Menu Start-->
                        <div class="single-product-tab">
                            <div class="nav single-product-tab-menu owl-carousel">
                                <a data-toggle="tab" href="#w1"><img src="{{asset('upload/product/'.$product_detail['images'])}}" alt=""></a>
                            @if($album != 'no' && is_array($album))
                                @foreach($album as $key => $rows)
                                <a data-toggle="tab" id="oke" href="#w{{$key + 2}}"><img src="{{asset('upload/product/'.$rows)}}" alt=""></a>
                                @endforeach
                            @endif
                            </div>
                        </div>
                        <!--Single Product Tab Menu Start-->
                    </div>
                    <!--Single Product Image End-->
                    <!--Single Product Content Start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="single-product-content">
                            <h1 class="product-title">{{$product_detail['name']}}</h1>
                            <!--Product Rating Start-->
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star on-color"></i>
                            </div>
                            <!--Product Rating End-->
                            <div class="product-description">
                                @foreach($other as $others)
                                @if($others['others_id'] == $product_detail['producer'])
                                <p>Thương hiệu : {{$others['name']}}</p>
                                @endif
                                @endforeach
                                
                            </div>
                            <!--Product Price Start-->
                            <div class="single-product-price">
                                <span class="new-price"><?php echo number_format($product_detail['price'] - (($product_detail['price'] * $product_detail['sale'])/100)); ?>₫</span>
                                <span class="old-price"><?php echo number_format($product_detail['price']); ?>₫</span>
                                <span class="sicker-price">-{{$product_detail['sale']}}%</span>
                            </div>
                            <!--Product Price End-->
                            <!--Product Description Start-->
                            <div class="product-description">
                                <p>{{$product_detail['comment']}}</p>
                            </div>
                            <!--Product Description End-->
                           
                            <!--Product Quantity Start-->
                            <div class="single-product-quantity">
                                <form method="get" action="/purchase-now">
                                    <div class="quantity">
                                        <label>Số Lượng :</label>
                                        <input type="hidden" name="product_id" value="{{$product_detail['product_id']}}">
                                        <input class="input-text" min="1" name="quantity" value="1" type="number">
                                        @if(\session()->has('email'))
                                        <button class="quantity-button btn-heart wishlist" id="{{$product_detail['product_id']}}" type="submit"><img src="{{asset('frontend/img/icon/heart_sp.svg')}}" alt=""> Thêm vào yêu thích</button>
                                        @else 
                                        <button class="quantity-button btn-hear check_wish_list" type="submit"><img src="{{asset('frontend/img/icon/heart_sp.svg')}}" alt=""> Thêm vào yêu thích</button>
                                        @endif
                                    </div>
                                    <button class="quantity-button btn-addcart add-product" id="{{$product_detail['product_id']}}" type="submit">Thêm vào giỏ hàng</button>
                                    <button class="quantity-button btn-dh" type="submit">Mua Ngay</button>
                                </form>
                            </div>
                            <!--Product Quantity End-->
                            <div class="product-chinhsach">
                                <ul style="top: 100px;">
                                    <li>
                                        <img src="img/icon/car.svg" alt="">
                                        <p>Giao hàng nhanh Đà Nẵng&nbsp;chỉ trong 1 - 2 Giờ làm việc, ngoại tỉnh 1-4 ngày</p>
                                    </li>
                                    <li>
                                        <img src="img/icon/load.svg" alt="">
                                        <p>Đổi trả sản phẩm trong vòng 7 ngày nếu có lỗi từ nhà sản xuất</p>
                                    </li>
                                    <li>
                                        <img src="img/icon/lh.svg" alt="">
                                        <p>Hotline tư vấn 9h-21h30 T2-T7 9h-17h30 Chủ Nhật <span>0763 648 220</span></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="share_mxh">
                                <div class="at-share-btn-elements"><a role="button" tabindex="0" class="at-icon-wrapper at-share-btn at-svc-messenger" style="background-color: rgb(0, 132, 255); border-radius: 0px; padding:5px 10px;"><span class="at4-visually-hidden"></span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-messenger-1" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-messenger"><title id="at-svg-messenger-1">Messenger</title><g><path d="M16 6C9.925 6 5 10.56 5 16.185c0 3.205 1.6 6.065 4.1 7.932V28l3.745-2.056c1 .277 2.058.426 3.155.426 6.075 0 11-4.56 11-10.185C27 10.56 22.075 6 16 6zm1.093 13.716l-2.8-2.988-5.467 2.988 6.013-6.383 2.868 2.988 5.398-2.987-6.013 6.383z" fill-rule="evenodd"></path></g></svg></span><span class="at-label" style="font-size: 10.2px; line-height: 16px; height: 16px; color: rgb(255, 255, 255);">Messenger</span></a>

                                    <a role="button" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" tabindex="0" class="at-icon-wrapper at-share-btn at-svc-facebook" style="background-color: rgb(59, 89, 152); border-radius: 0px; padding:5px 10px;"><span class="at4-visually-hidden"></span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-facebook-2" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-facebook"><title id="at-svg-facebook-2">Facebook</title><g><path d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z" fill-rule="evenodd"></path></g></svg></span>
                                        <span
                                            class="at-label" style="font-size: 10.2px; line-height: 16px; height: 16px; color: rgb(255, 255, 255);">Facebook</span>
                                            </a>

                                            <!-- <div class="fb-share-button" data-href="https://ecomart.ankhangland.net/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div> -->

                                    <a role="button" tabindex="0" class="at-icon-wrapper at-share-btn at-svc-compact" style="background-color: rgb(255, 101, 80); border-radius: 0px; padding:5px 10px; margin-left: 5px;"><span class="at4-visually-hidden"></span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-addthis-3" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-addthis"><title id="at-svg-addthis-3">AddThis</title><g><path d="M18 14V8h-4v6H8v4h6v6h4v-6h6v-4h-6z" fill-rule="evenodd"></path></g></svg></span>
                                        <span
                                            class="at-label" style="font-size: 10.2px; line-height: 16px; height: 16px; color: rgb(255, 255, 255);">Thêm...</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single Product Content End-->
                </div>
                <!--Single Product Info End-->
                <!--Discription Tab Start-->
                <div class="row">
                    <div class="discription-tab">
                        <div class="col-lg-12">
                            <div class="discription-review-contnet mb-40">
                                <!--Discription Tab Menu Start-->
                                <div class="discription-tab-menu">
                                    <ul class="nav">
                                        <li><a class="active" data-toggle="tab" href="#description">Mô tả sản phẩm</a></li>
                                        <li><a data-toggle="tab" href="#review">Đánh giá(1)</a></li>
                                    </ul>
                                </div>
                                <!--Discription Tab Menu End-->
                                <!--Discription Tab Content Start-->
                                <div class="discription-tab-content tab-content">
                                    <div id="description" class="tab-pane fade show active">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="description-content">
                                                    {!! Request::old('content', $product_detail['content']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="review" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="review-page-comment">
                                                    <div class="review-comment">
                                                        <h2>Comment facebook</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Discription Tab Content End-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--Discription Tab End-->
            </div>
        </section>
        <!--Single Product Area End-->
        <!--Related Products Area Start-->
        <section class="related-products-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--Section Title1 Start-->
                        <div class="section-title1-border">
                            <div class="section-title1">
                                <h3>SẢN PHẨM LIÊN QUAN</h3>
                            </div>
                        </div>
                        <!--Section Title1 End-->
                    </div>
                </div>
                <div class="row">
                    <div class="related-products owl-carousel">
                        @foreach($product as $products)
                            @if($products['product_menu_id'] == $product_detail['product_menu_id'] && $product_detail['product_id'] != $products['product_id'])
                        <!--Single Product Start-->
                        <div class="col-lg-12 item-col">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{URL::to('product/'.$products['slug'])}}">
                                        <img class="first-img" src="{{asset('upload/product/'.$products['images'])}}" alt="">
                                    </a>
                                    <span class="sicker">-{{$products['sale']}}%</span>
                                    <ul class="product-action">
                                        @if(\session()->has('email'))
                                        <li><a href="#" id="{{$products['product_id']}}" data-toggle="tooltip" class="wishlist" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                        @else 
                                        <li><a  class="check_wish_list" data-toggle="tooltip" title="Add to Wishlistsss"><i class="ion-android-favorite-outline"></i></a></li>
                                        @endif
                                        <li><a href="#" data-toggle="modal" title="Quick View" data-target="#myModal_{{$products['product_id']}}"><i class="ion-android-expand"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <h2><a href="{{URL::to('/product/'.$products['slug'])}}">{{$products['name']}}</a></h2>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="product-price">
                                        <span class="new-price"><?php echo number_format($products['price'] - (($products['price'] * $products['sale'])/100)); ?>₫</span>
                                        <span class="old-price"><?php echo number_format($products['price']); ?>₫</span>
                                        <a class="button add-btn add-product" href="shopping-cart.html" data-toggle="tooltip">add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Single Product End-->
                            @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--Related Products Area End-->

        <!-- modal -->
        @include('frontend.master.modal')
        @endsection