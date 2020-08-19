@extends('frontend.master.master')
@section('content')
        <!--Error 404 Area Start-->
        <section class="error-404-area mt-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="search-form-wrapper ptb-40">
                            <h1>404</h1>
                            <h2>PAGE NOT BE FOUND</h2>
                            <div class="error-message">
                                <p>Xin lỗi nhưng trang bạn đang tìm kiếm không tồn tại, đã bị xóa, tên đã thay đổi hoặc không có sẵn tạm thời.</p>
                            </div>
                            <div class="search-form">
                                <form action="/search-detail" method="post">
                                    @csrf
                                    <div class="search-box">
                                        <input type="text" name="search" id="search" placeholder="Tìm kiếm sản phẩm...">
                                        <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                    </div>
                                </form>
                                <div class="back-to-home">
                                    <a href="{{URL::to('')}}">Quay lại Trang chủ </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Error 404 Area End-->
  @endsection