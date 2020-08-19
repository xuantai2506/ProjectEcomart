 <!--Header Area Start-->
<div class="header-container">
    <!--Header Top Area Start-->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <!--Header Top Left Area Start-->
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="header-top-menu">
                        <ul>
                            <li class="support"><span>Đặt hàng trước 17:30, giao hàng ngay hôm nay - Hỗ trợ: 0763.648.220</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-5 d-lg-none d-md-none d-block">
                    <div class="side-menu">
                        <div class="category-heading-mobile">
                            <h2><i class="ion-android-menu"></i></h2>
                        </div>
                        <div id="cate-toggle" class="category-menu-list-mobile">
                            <ul>
                                <li><a href="{{URL::to('')}}">Trang chủ</a></li>
                                <li><a href="{{URL::to('article/'.$get_introduce['slug'])}}" title="Giới thiệu"><span>Giới thiệu</span></a></li>
                                <li><a href="#" title="{{URL::to('cua-hang')}}"><span>Cửa Hàng</span></a></li>
                                <li><a href="#" title="{{URL::to('tin-tuc')}}"><span>Tin tức</span></a></li>
                                <li><a href="{{URL::to('dai-ly')}}" title="Liên hệ"><span>Liên hệ</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Header Top Left Area End-->
                <!--Header Top Right Area Start-->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6  col-7 d-lg-block d-md-block text-right">
                    <div class="header-top-menu">
                        <ul>
                            @if(\session()->has('email'))
                            <li class="account">
                                <a href="{{URL::to('profile')}}"><span>{{\session()->get('user_name')}}</a></span> || 
                                <a href="{{URL::to('logout')}}">Đăng xuất</a>
                            </li>
                            @else
                            <li class="account"><a href="{{URL::to('logins')}}">Đăng nhập | Đăng ký</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!--Header Top Right Area End-->
            </div>
        </div>
    </div>
    <!--Header Top Area End-->
    <!--Header Middel Area Start-->
    <div class="header-middel-area">
        <div class="container">
            <div class="row">
                <!--Logo Start-->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-6">
                    <div class="logo">
                        <a href="#"><img src="{{asset('frontend/img/logo/logo.svg')}}" alt=""></a>
                    </div>
                </div>
                <!--Logo End-->
                <!--Mini Cart Start-->
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6  col-6 d-lg-none d-md-none d-block">
                    <div class="mini-cart-area">
                        <ul>
                            <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                            <li><a href="#"><i class="ion-android-cart"></i><span class="cart-add">2</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--Mini Cart End-->
                <!--Search Box Start-->
                <div class="col-lg-7 col-md-6 col-12">
                    <div class="search-box-area">
                        <form action="/search-detail" method="post">
                            @csrf
                            <div class="search-box">
                                <input type="text" name="search" id="search" placeholder="Tìm kiếm sản phẩm...">
                                <button type="submit"><img src="{{asset('frontend/img/icon/search.svg')}}" alt=""></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--Search Box End-->

                <!--Mini Cart Start-->
                <div class="col-lg-2 col-md-3 col-12 d-lg-block d-md-block d-none">
                    <div class="mini-cart-area">
                        <ul>
                            <!-- wishlist -->
                            @if(\session()->has('email'))
                            <li><a href="{{URL::to('wishlist')}}"><i class="ion-android-favorite-outline"></i></a></li>
                            @else 
                            <li><a href="{{URL::to('wishlist')}}"><i class="check_wish_list ion-android-favorite-outline"></i></a></li>
                            @endif
                            
                            <!-- cart -->
                            
                            <li id="count-cart">
                                <a href="#"><i class="ion-android-cart"></i>
                                    <?php 
                                    if(\session()->has('product')){
                                        $arr = \session()->get('product');
                                    ?>

                                    <span class="cart-add">{{count($arr)}}</span>

                                    <?php 
                                    }
                                    ?>
                                </a>

                                <ul class="cart-dropdown">

                                    <?php 
                                    if(\session()->has('product')){

                                        $count = 0 ;

                                        $arr = \session()->get('product');

                                        foreach($arr as $data){

                                            $count = ($data['price']- ($data['price'] * $data['sale'])/100 ) * $data['quantity'] + $count;

                                    ?>

                                    <!--Single Cart Item Start-->
                                    <li class="cart-item tr_{{$data['id_product']}}">
                                        <div class="cart-img">
                                            <a href="{{URL::to('/product/'.$data['slug'])}}"><img src="{{asset('upload/product/'.$data['images'])}}" alt=""></a>
                                        </div>
                                        <div class="cart-content">
                                            <h4><a href="{{URL::to('/product/'.$data['slug'])}}">{{$data['name_product']}}</a></h4>
                                            <p class="cart-quantity">Số lượng: {{$data['quantity']}}</p>
                                            <p class="cart-price"><?php echo number_format($data['price']- ($data['price'] * $data['sale'])/100) ?>₫</p>
                                        </div>
                                        <div class="cart-close">
                                            <a href="#" class="remove-product" id="{{$data['id_product']}}" title="Remove"><i class="ion-android-close"></i></a>
                                        </div>
                                    </li>

                                    <?php 

                                        }
                                    }
                                    ?>

                                    <!--Single Cart Item Start-->
                                    <!--Cart Total Start-->
                                    <?php 
                                        if(\session()->has('product')){ 
                                    ?>
                                    <li class="cart-total-amount mtb-20">
                                        <h4>TỔNG TIỀN: <span class="pull-right total"><?php echo number_format($count); ?>₫</span></h4>
                                    </li>
                                    <?php 
                                        } 
                                    ?>
                                    <!--Cart Total End-->
                                    <!--Cart Button Start-->
                                    <li class="cart-button">
                                        @if(\session()->has('email'))
                                         <a href="{{URL::to('checkout')}}" class="button2">THANH TOÁN</a>
                                        @else
                                        <a href="" class="button2 button-pay checkout">THANH TOÁN</a>
                                        @endif
                                        <a href="{{URL::to('shopping-cart')}}" class="button2">XEM GIỎ HÀNG</a>
                                    </li>
                                    <!--Cart Button End-->
                                </ul>

                            </li>
                        </ul>
                    </div>
                </div>
                <!--Mini Cart End-->
                
            </div>
        </div>
    </div>
    <!--Header Middel Area End-->
    <!--Header bottom Area Start-->
    <div class="header-bottom-area header-sticky">
        <div class="container">
            <div class="row">
                <!--Categories Menu Start-->
                <div class="col-lg-3 col-md-4">
                    <div class="side-menu">
                        <div class="category-heading">
                            <h2><i class="ion-android-menu"></i><span>DANH MỤC SẢN PHẨM</span></h2>
                        </div>
                        <div id="cate-toggle" class="category-menu-list">
                            <ul>
                                @foreach($product_menu as $row)
                                <li><a href="{{URL::to('search/'.$row['slug'])}}">{{$row['name']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Categories Menu End-->
                <!--Main Menu Start-->
                <div class="col-lg-9 col-md-8">
                    <!--Logo Sticky start-->
                    <!--Main Menu Area Start-->
                    <div class="main-menu-area">
                        <nav>
                            <ul class="main-menu">
                                <li class="active"><a href="{{URL::to('')}}">Home</a></li>
                                <li><a href="{{URL::to('article/'.$get_introduce['slug'])}}">Giới thiệu</a></li>
                                <li><a href="{{URL::to('cua-hang')}}">Cửa hàng</a>
                                </li>
                                <li><a href="{{URL::to('tin-tuc')}}">Tin tức</a></li>
                                <li><a href="{{URL::to('lien-he')}}">Liên hệ</a></li>
                            </ul>
                        </nav>
                        <div class="icon_mxh">
                            <a href="https://www.facebook.com/LOVAWEB2020"><img src="{{asset('frontend/img/icon/facebook.svg')}}" alt=""></a>
                            <a href="https://twitter.com/"><img src="{{asset('frontend/img/icon/twitter.svg')}}" alt=""></a>
                            <a href="https://www.instagram.com/hathienvan99/"><img src="{{asset('frontend/img/icon/instagram.svg')}}" alt=""></a>
                        </div>
                    </div>
                    <!--Main Menu Area End-->
                </div>
                <!--Main Menu Start-->
            </div>
        </div>
    </div>
    <!--Header bottom Area End-->
</div>
        <!--Header Area End-->