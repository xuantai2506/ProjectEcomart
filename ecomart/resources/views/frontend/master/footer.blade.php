<div class="footer-container mt-50">
    <!--Footer Top Area Start-->
    <div class="footer-top-area ptb-50">
        <div class="container">
            <div class="row">
                <!--Single Footer Start-->
                <div class="col-lg-5 col-md-4">
                    <div class="single-footer">
                        <div class="footer-title">
                            <h3>THÔNG TIN LIÊN HỆ</h3>
                        </div>
                        <!--Footer Content Start-->
                        <div class="footer-content">
                            <div class="contact">
                                <p><img src="{{asset('frontend/img/icon/diachi.svg')}}" alt=""></i> 113 Hoàng Văn Thụ, Q.Hải Châu, Tp. Đà Nẵng</p>
                                <p><img src="{{asset('frontend/img/icon/phone.svg')}}" alt=""></i> 0763.648.220 - 0766.708.619</p>
                                <p><img src="{{asset('frontend/img/icon/mail.svg')}}" alt=""></i> dewalttools@gmail.com</p>
                            </div>
                            <div class="bocongthuong mt-50">
                                <img src="{{asset('frontend/img/logo/bct.svg')}}" alt="">
                            </div>
                        </div>
                        <!--Footer Content End-->
                    </div>
                </div>
                <!--Single Footer End-->
                <!--Single Footer Start-->
                <div class="col-lg-3 col-md-4">
                    @foreach($get_category_footer as $row)
                    <div class="single-footer">
                        <div class="footer-title">
                            <h3>{{$row['name']}}</h3>
                        </div>
                        <ul class="footer-info">
                            @foreach($get_article_menu as $rows)
                                @if($rows['category_id'] == $row['category_id'])
                                <li><a href="{{URL::to('/article/'.$rows['slug'])}}">{{$rows['name']}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
                <!--Single Footer End-->
                <!--Single Footer Start-->
                <div class="col-lg-4 col-md-4">
                    <div class="single-footer">
                        <p class="fanpage text-right"><iframe allow="encrypted-media" allowtransparency="true" class="fb_link" frameborder="0" height="195" scrolling="no" src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/LOVAWEB2020/?__tn__=%2Cd%2CP-R&amp;eid=ARCbmO1ebzyK7kWQvBMEtTpZsG58yrAxJ8kyYqRrpLX7z7W0KAm-Xcrz6H-6WN14Aw8i501FY4ZgL4pz/&amp;tabs=timeline&amp;height=210&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId"
                                style="border:none;overflow:hidden" width="100%"></iframe></p>
                        <div class="payment-img">
                            <a href="#"><img src="{{asset('frontend/img/payment/payment.svg')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <!--Single Footer End-->
            </div>
        </div>
    </div>
    <!--Footer Top Area End-->

    <!--Footer Bottom Area Start-->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <!--Footer Left Content Start-->
                <div class="col-lg-6 col-md-6">
                    <div class="copyright-text">
                        <p>Copyright© 2020 Dewalt Tools. All Rights Reserved </p>
                    </div>
                </div>
                <!--Footer Left Content End-->
                <!--Footer Right Content Start-->
                <div class="col-lg-6 col-md-6">
                    <div class="copyright-text text-right">
                        <p>Provided and Updated by
                            <a href="http://themes.jetart.com.vn/" target="_blank">
                                <img src="{{asset('frontend/img/logo/logocty.svg')}}" alt=""></a>
                        </p>
                    </div>
                </div>
                <!--Footer Right Content End-->
            </div>
        </div>
    </div>
    <!--Footer Bottom Area End-->
</div>