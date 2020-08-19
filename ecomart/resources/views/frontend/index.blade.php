@extends('frontend.master.master')
@section('content')
    <div class="wrapper home-7">
        <!--Header Area Start-->
        

        <!--Slider Area Start-->
        @include('frontend.master.gallery.slider')
        <!--Slider Area End-->

        <!--Offer Image Area Start-->
        @include('frontend.master.gallery.offer')
        <!--Offer Image Area End-->

        <!--Offer Area Start-->
        @include('frontend.master.gallery.banner')
        <!--Offer Image Area End-->
        
        @foreach($product_menu_hot as $row)
        <!--Bestseller Product Start-->
        
        <section class="bestseller-product mb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--Section Title1 Start-->
                        <div class="section-title1-border">
                            <div class="section-title1">
                                <h3>{{$row['name']}}</h3>
                                <a href="{{URL::to('cua-hang')}}">
                                    <p>Xem tất cả >></p>
                                </a>
                            </div>
                        </div>
                        <!--Section Title1 End-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!--Product Tab Menu Start-->
                        <div class="product-tab-menu-area">
                            <div class="product-tab">
                                <ul class="nav">
                                    @foreach($product_menu_hot_small as $rows)
                                        @if($rows['parent'] == $row['product_menu_id'])
                                            <li><a  data-toggle="tab" href="#{{$rows['slug']}}">{{$rows['name']}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--Product Tab Menu End-->
                    </div>
                </div>
                
                <div class="tab-content">
                <!-- ham kiem tra php  -->
                <?php 
                    // vì lý do các product_menu_hot_small luôn có giá trị $key lớn hơn 0 nên ta phải tạo lại 1 mảng mới tương đương nhưng có $key = 0 
                    $product_menu_hot_smalls = [];
                    foreach($product_menu_hot_small as $rows){
                        if($rows['parent'] == $row['product_menu_id']){
                            // push vào mảng mới để có $key == 0
                            array_push($product_menu_hot_smalls, $rows);
                        }
                    }
                ?>

                @foreach($product_menu_hot_smalls as $key => $rows)

                    <!-- check -->
                    <?php 
                        $check = in_array($rows['product_menu_id'],$product_check); 
                    ?> 
                    <!-- endcheck -->

                    <!--Product Tab Start-->
                    @if($rows['parent'] == $row['product_menu_id'])
                        

                        <div id="{{$rows['slug']}}" class="tab-pane fade in <?php if($key == 0) echo 'active' ?>">
                            <div class="row">
                                <div class="bestseller-product3 mb-30  owl-carousel">
                                    <!--Single Product Start-->
                                    @if($check)
                                        @foreach($product as $products)
                                            @if($products['product_menu_id'] == $rows['product_menu_id'])
                                                <div class="col-lg-12 item-col">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <a href="">
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
                                                            <h2><a href="{{URL::to('product/'.$products['slug'])}}">{{$products['name']}}</a></h2>
                                                            <div class="rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                            <div class="product-price">
                                                                <span class="new-price"><?php echo number_format($products['price'] - (($products['price'] * $products['sale'])/100)) ?>đ</span>
                                                                <span class="old-price"><?php echo number_format($products['price']) ?>đ</span>
                                                                <a class="button add-btn add-product" id="{{$products['product_id']}}" data-toggle="tooltip">Thêm giỏ hàng</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else 
                                    <div class="col-lg-12 item-col">
                                        <div align="center">Sản phẩm đang được cập nhật</div>
                                    </div>
                                    @endif
                                    <!--Single Product End-->

                                </div>
                            </div>
                        </div>


                    @endif

                @endforeach
                </div>
                    


            </div>
        </section>
        @endforeach
        <!--Bestseller Product End-->
        <!--Offer Image Area Start-->
        <div class="offer-img-area mb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single-offer">
                            <div class="offer-img img-full">
                                <a href="#"><img src="{{asset('frontend/img/offer/32.jpg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-offer">
                            <div class="offer-img img-full">
                                <a href="#"><img src="{{asset('frontend/img/offer/33.jpg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Offer Image Area End-->

        <!--Latest Posts Blog Area Start-->
        <Section class="latest-posts-blog-area mb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--Section Title1 Start-->
                        <div class="section-title1-border">
                            <div class="section-title1">
                                <h3>Tin Tức Nổi Bật</h3>
                            </div>
                        </div>
                        <!--Section Title1 End-->
                    </div>
                </div>
                <!--Latest Blog Start-->
                <div class="latest-blog">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="latest-blog-active owl-carousel">

                                <!--Single Latest Blog Start-->
                                @foreach($news_hot_list as $row)
                                <div class="our-single-blog">
                                    <div class="our-blog-img img-full">
                                        <a href="{{URL::to('tin-tuc/detail/'.$row['article_id'])}}">
                                            @if($row['images'] != 'no')
                                            <img src="{{asset('upload/article/'.$row['images'])}}" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="our-blog-content mt-15">
                                        <h3><a href="{{URL::to('tin-tuc/detail/'.$row['article_id'])}}">Apple bất ngờ tung bản cập nhật iOS 13.5.1 và iPadOS 13.5.1, fix lỗ hổng bẻ khóa</a></h3>
                                        <div class="blog-meta">
                                            <span class="{{URL::to('tin-tuc/detail/'.$row['article_id'])}}"><img class="calendar" src="{{asset('frontend/img/icon/lich.svg')}}" alt=""></i>10/10/2020</span>
                                        </div>
                                        <div class="our-blog-des mb-20">
                                            <p>Tháng 5 cũng là tháng nới lỏng dãn cách xã hội nên anh em cũng đã bắt đầu lại với guồng quay công việc, đầu tư...
                                            </p>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                                <!--Single Latest Blog Start-->
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--Latest Blog Start-->
            </div>
        </Section>
        <!--Latest Posts Blog Area End-->

        <!-- modal -->
            @include('frontend.master.modal')
        <!-- end modal -->


        <!--Brand Area Start-->
        @include('frontend.master.gallery.partner')
        <!--Brand Area End-->
@endsection