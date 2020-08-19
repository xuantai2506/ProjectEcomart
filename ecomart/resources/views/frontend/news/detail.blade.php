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
                                    <li><a href="{{URL::to('')}}">Trang Chủ</a><span class="breadcome-separator">></span></li>
                                    <li><a href="{{URL::to('tin-tuc')}}">Tin tức</a><span class="breadcome-separator">></span></li>
                                    <li><?php echo substr($sale_detail['name'], 0 , 10) ?>....</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Blog Area Start-->
        <section class="blog-area mt-20">
            <div class="container">
                <div class="row">
                    <!--Blog Image Post Start-->
                    <div class="col-lg-9 col-md-12 col-12">
                        <!--Blog Post Start-->
                        <div class="blog-post-wrapper">
                            <div class="post-thumbnail img-full">
                                <img src="{{URL::to('upload/article/'.$sale_detail['images'])}}" alt="">
                            </div>
                            <div class="postinfo-wrapper">
                                <div class="post-header">
                                    <h1 class="post-title">{{$sale_detail['name']}}</h1>
                                    <div class="blog-meta">
                                        <span class="blog-post-date"><img class="calendar" src="{{asset('frontend/img/icon/lich.svg')}}" alt=""></i>{{ date("d-m-Y", strtotime($sale_detail['created_at'])) }}</span>
                                    </div>
                                    <div class="share_mxh" style="margin-top: 10px;">
                                        <div class="at-share-btn-elements"><a role="button" tabindex="0" class="at-icon-wrapper at-share-btn at-svc-messenger" style="background-color: rgb(0, 132, 255); border-radius: 0px; padding:5px 10px;"><span class="at4-visually-hidden"></span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-messenger-1" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-messenger"><title id="at-svg-messenger-1">Messenger</title><g><path d="M16 6C9.925 6 5 10.56 5 16.185c0 3.205 1.6 6.065 4.1 7.932V28l3.745-2.056c1 .277 2.058.426 3.155.426 6.075 0 11-4.56 11-10.185C27 10.56 22.075 6 16 6zm1.093 13.716l-2.8-2.988-5.467 2.988 6.013-6.383 2.868 2.988 5.398-2.987-6.013 6.383z" fill-rule="evenodd"></path></g></svg></span><span class="at-label" style="font-size: 10.2px; line-height: 16px; height: 16px; color: rgb(255, 255, 255);">Messenger</span></a>
                                            <a role="button" tabindex="0" class="at-icon-wrapper at-share-btn at-svc-facebook" style="background-color: rgb(59, 89, 152); border-radius: 0px; padding:5px 10px;"><span class="at4-visually-hidden"></span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-facebook-2" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-facebook"><title id="at-svg-facebook-2">Facebook</title><g><path d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z" fill-rule="evenodd"></path></g></svg></span>
                                                <span
                                                    class="at-label" style="font-size: 10.2px; line-height: 16px; height: 16px; color: rgb(255, 255, 255);">Facebook</span>
                                                    </a>
                                            <a role="button" tabindex="0" class="at-icon-wrapper at-share-btn at-svc-compact" style="background-color: rgb(255, 101, 80); border-radius: 0px; padding:5px 10px; margin-left: 5px;"><span class="at4-visually-hidden"></span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-addthis-3" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-addthis"><title id="at-svg-addthis-3">AddThis</title><g><path d="M18 14V8h-4v6H8v4h6v6h4v-6h6v-4h-6z" fill-rule="evenodd"></path></g></svg></span>
                                                <span
                                                    class="at-label" style="font-size: 10.2px; line-height: 16px; height: 16px; color: rgb(255, 255, 255);">Thêm...</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-info">
                                    <div class="entry-content mb-30">
                                        {!! Request::old('content', $sale_detail['content']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Blog Post End-->
                    </div>
                    <!--Blog Image Post End-->
                    <!--Right Sidebar Start-->
                    <div class="col-lg-3 col-md-12 col-12">
                        <div class="right-sidebar-area">
                            <!--Widget Categories start-->
                            <div class="widget widget-categories categories-tintuc">
                                <h3 class="widget-title">DANH MỤC TIN TỨC</h3>
                                <ul class="sidebar-menu">
                                    @foreach($sale_menu as $sale_menus)
                                    <li><a href="{{URL::to('tin-tuc/'.$sale_menus['slug'])}}">{{$sale_menus['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--Widget Categories End-->
                        </div>
                    </div>
                    <!--Right Sidebar End-->
                </div>
            </div>
        </section>
        <!--Blog Area End-->
        <!--Related Products Area Start-->
        <section class="related-products-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--Section Title1 Start-->
                        <div class="section-title1-border">
                            <div class="section-title1">
                                <h3>TIN TỨC LIÊN QUAN</h3>
                            </div>
                        </div>
                        <!--Section Title1 End-->
                    </div>
                </div>
                <div class="row">
                    <div class="related-blogs owl-carousel">

                        @foreach($sale_related as $row)
                        <!--Single Product Start-->
                        <div class="col-lg-12 item-col">
                            <div class="relatedthumb">
                                <div class="image img-full">
                                    <a href="{{URL::to('tin-tuc/detail/'.$row['article_id'])}}"><img src="{{URL::to('upload/article/'.$row['images'])}}" alt=""></a>
                                </div>
                                <h4><a href="{{URL::to('tin-tuc/detail/'.$row['article_id'])}}">{{$row['name']}}</a></h4>
                                <div class="blog-meta">
                                    <span class="blog-post-date"><img class="calendar" src="{{asset('frontend/img/icon/lich.svg')}}" alt=""></i>{{ date("d-m-Y", strtotime($row['created_at'])) }}</span>
                                </div>
                                <div class="post-info">
                                    <div class="entry-summary">
                                        <p><?php echo substr($row['comment'], 0 , 10); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Single Product End-->
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--Related Products Area End-->
@endsection