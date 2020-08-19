
<div class="brand-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-active owl-carousel">
                        @foreach($partner_list as $rows)
                        <!--Single Brand Start-->
                        <div class="single-brand img-full">
                            <a href="#"><img src="{{asset('upload/gallery/'.$rows['images'])}}" alt=""></a>
                        </div>
                        <!--Single Brand End-->
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
