@extends('frontend.master.master')
@section('content')
<!--Product List Grid View Area Start-->
<div class="product-list-grid-view-area mt-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 order-lg-2 order-1">
                <!-- <div class="shop-tab-menu">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xl-12 col-12">
                            <div class="toolbar-form">
                                <form action="#">
                                    <div style="position: relative;right: 300px" class="toolbar-select text-right">
                                        <span>Sắp xếp:</span>
                                        <select data-placeholder="Mặc định" class="order-by" tabindex="1">
                                            <option value="Mặc định">Mặc định</option>
                                            <option value="Nổi bật">Nổi Bật</option>
                                            <option value="Khuyến mãi">Khuyến mãi</option>
                                            <option value="Free ship">Free ship</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="shop-product-area">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade show active">
                            <div class="row product-container-fluid">
                                @foreach($product_list as $product_lists)
                                <div class="col-lg-3 col-md-3 item-col2">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{URL::to('product/'.$product_lists['slug'])}}">
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
                                            <p><a href="">Công cụ bảo hộ</a></p>
                                            <div class="product-price">
                                                <span class="new-price"><?php echo number_format($product_lists['price'] - (($product_lists['price']*$product_lists['sale'])/100));  ?>đ</span>
                                                <span class="old-price"><?php echo number_format($product_lists['price']); ?>đ</span>

                                                <a class="button add-btn add-product" href="" data-toggle="tooltip" id="{{$product_lists['product_id']}}" title="Mua hàng">Mua hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!--Product List Grid View Area End-->
@include('frontend.master.modal')
<!-- end signup email -->
@endsection