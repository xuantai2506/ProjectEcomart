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
                                    <li>Giới Thiệu</li>
                                </ul>
                            </div>
                            <div class="heading-banner-title">
                                <h1>{{$get_article['name']}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Heading Banner Area End-->
        <!--Aboout Us Area Start-->
        <section class="about-us-area">
            <div class="container">
                <div class="row">
                    <!--About Us Image Start-->
                    {!! Request::old('content', $get_article['content']) !!}
                </div>
        </section>
        <!--Aboout Us Area End-->
@endsection