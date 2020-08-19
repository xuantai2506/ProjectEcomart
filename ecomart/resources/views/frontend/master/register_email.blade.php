<div class="container">
    <!--News Latter Area Start-->
    <div class="news-latter-area">
        <div class="row">
            <!--News Latter Content Start-->
            <div class="col-lg-6 text-center">
                <div class="news-lettar-content">
                    <div class="icon">
                        <img src="{{asset('frontend/img/icon/thu.svg')}}" alt="">
                    </div>
                    <p>
                        <label>ĐĂNG KÝ NHẬN TIN KHUYẾN MÃI</label>
                        <br>
                        <span>Hãy đăng ký email của bạn để nhận những thông tin khuyến mãi!</span>
                    </p>
                </div>
            </div>
            <!--News Latter Content Start-->
            <!--News Latter Subscribe Box Start-->
            <div class="col-lg-6">
                <!-- Newsletter Form -->
                <div class="news-latter-subscribe-box text-right">
                    <form method="post" action="/register_email" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="popup-subscribe-form validate" novalidate>
                        @csrf
                        <div id="mc_embed_signup_scroll">
                            <label class="d-none hidden">ĐĂNG KÝ NHẬN THÔNG TIN KHUYẾN MÃI</label>
                            <input class="style2" type="email" name="email" placeholder="Địa chỉ email của bạn…" required="">
                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                            <button type="submit" name="subscribe" id="mc-embedded-subscribe"><img src="{{asset('frontend/img/icon/send.svg')}}" alt=""></button>
                        </div>
                    </form>
                </div>
                <!-- Newsletter Form -->
            </div>
            <!--News Latter Subscribe Box End-->
        </div>
    </div>
    <!--News Latter Area End-->
</div>