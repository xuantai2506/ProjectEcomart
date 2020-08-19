@foreach($product as $products)
<!--Modal Start-->
    <div id="myModal_{{$products['product_id']}}" class="modal fade" role="dialog">
        <h1><?php var_dump($products['upload_images']); ?></h1>
        <div class="modal-dialog">
            <!-- Modal Content Strat-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="modal-details">
                        <div class="row">
                            <!--Product Img Strat-->
                            <div class="col-xl-5 col-lg-5">
                                <!--Product Tab Content Start-->
                                <div class="tab-content">
                                    <div id="watch1" class="tab-pane fade show active">
                                        <div class="modal-img img-full">
                                            <img src="{{asset('upload/product/'.$products['images'])}}" alt="">
                                        </div>
                                    </div>
                                    <?php $album = json_decode($products['upload_images']); ?>
                                    @if($album != 'no' && is_array($album))
                                        @foreach($album as $rows)
                                        <div id="{{$rows}}" class="tab-pane fade">
                                            <div class="modal-img img-full">
                                                <img src="{{asset('upload/product/'.$rows)}}" alt="">
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!--Product Tab Content End-->
                                <!--Single Product Tab Menu Start-->
                                <div class="modal-product-tab">
                                    <ul class="nav">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#watch1"><img src="{{asset('upload/product/'.$products['images'])}}" alt=""></a>
                                        </li>
                                        @if($album != 'no' && is_array($album))
                                            @foreach($album as $rows)
                                        <li>
                                            <a data-toggle="tab" href="#{{$rows}}"><img src="{{asset('upload/product/'.$rows)}}" alt=""></a>
                                        </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <!--Single Product Tab Menu Start-->
                            </div>
                            <!--Product Img End-->
                            <!-- Product Content Start-->
                            <div class="col-xl-7 col-lg-7">
                                <div class="product-info">
                                    <h2>{{$products['name']}}</h2>
                                    <div class="product-price">
                                        <span class="new-price"><?php echo number_format($products['price'] - (($products['price'] * $products['sale'])/100)) ?>đ</span>
                                        <span class="old-price"><?php echo number_format($products['price']); ?></span>
                                    </div>
                                    <div class="add-to-cart quantity">
                                        <form class="add-quantity" action="#">
                                            <!-- <div class="quantity modal-quantity">
                                                <label>Số Lượng</label>
                                                <input type="number" value="1">
                                            </div> -->
                                            <div class="add-to-link">
                                                <button class="form-button add-product" data-text="add to cart">Thêm vào giỏ hàng</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="cart-description">
                                        <p>{!! Request::old('content', $products['content']) !!}</p>
                                    </div>
                                    <a href="{{URL::to('product/'.$products['slug'])}}" class="see-all">Xem chi tiết sản phẩm</a>
                                </div>
                            </div>
                            <!--Product Content End-->
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal Content Strat-->
        </div>
    </div>
    <!--Modal End-->
    @endforeach