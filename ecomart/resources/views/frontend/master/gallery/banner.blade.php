<div class="offer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @foreach($banner_list as $row)
                <div class="single-offer">
                    <div class="offer-img img-full">
                        <a href="#">
                            <img src="{{asset('upload/gallery/'.$row['images'])}}" alt="">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>