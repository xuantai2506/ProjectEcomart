<div class="offer-area mb-30">
    <div class="container">
        <div class="row">

            <!--Single Offer Start-->
            @foreach($offer_list as $row)
            <div class="col-lg-4 col-md-4">
                <div class="single-offer">
                    <div class="offer-img img-full">
                        <a href="#">
                            <img src="{{asset('upload/gallery/'.$row['images'])}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            <!--Single Offer End-->
           
        </div>
    </div>
</div>