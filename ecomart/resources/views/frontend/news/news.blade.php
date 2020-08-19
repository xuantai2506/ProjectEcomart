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
                                    <li>TIn Tức</li>
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
                    <!--Blog Left Side Start-->
                    <div class="col-lg-9 col-md-12 col-12">
                        <div class="all-single-blog">
                            @foreach($arr_sale as $row)
                            <!--Single Blog Post Start-->
                            <div class="single-blog-post mb-40">
                                <div class="post-thumbnail img-full">
                                    <a href="{{URL::to('tin-tuc/detail/'.$row['article_id'])}}"><img src="{{URL::to('upload/article/'.$row['images'])}}" alt=""></a>
                                </div>
                                <div class="postinfo-wrapper">
                                    <div class="post-header">
                                        <h1 class="post-title"><a href="{{URL::to('tin-tuc/detail/'.$row['article_id'])}}">{{$row['name']}}</a></h1>
                                        <div class="blog-meta">
                                            <span class="blog-post-date"><img class="calendar" src="{{asset('frontend/img/icon/lich.svg')}}" alt=""></i>{{ date("d-m-Y", strtotime($row['created_at'])) }}</span>
                                        </div>
                                    </div>
                                    <div class="post-info">
                                        <div class="entry-summary">
                                            <p><?php echo substr($row['comment'], 0 , 10); ?></p>
                                            <a class="readmore-button" href="{{URL::to('tin-tuc/detail/'.$row['article_id'])}}">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!--Single Blog Post End-->


                            <!--Pagination Start-->
                            <div class="pagination">
                                <ul class="page-number">
                                    <!-- @for($i = 0 ; $i < $arr_sale->total(); $i++)
                                    <li class=""><a  href="">{{++$i}}</a></li>
                                    @endfor -->
                                    {{$arr_sale->links()}}

                                </ul>
                            </div>

                           <!--  <div class="pagination">
                                <ul class="page-number">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                                </ul>
                            </div> -->
                            <!--Pagination End-->
                        </div>
                    </div>
                    <!--Blog Left Side End-->
                    <!--Right Sidebar Start-->
                    <div class="col-lg-3 col-md-12 col-12">
                        <div class="right-sidebar-area">
                            <!--Widget Categories start-->
                            <div class="widget widget-categories categories-tintuc">
                                <h3 class="widget-title">DANH MỤC TIN TỨC</h3>
                                <ul class="sidebar-menu">
                                    @foreach($sale_menu as $row)
                                    <li><a href="{{URL::to('tin-tuc/'.$row['slug'])}}">{{$row['name']}}</a></li>
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
@endsection