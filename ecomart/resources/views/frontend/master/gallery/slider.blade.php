<section class="slider-area mb-30">
    <div class="slider-wrapper theme-default">
        <!--Slider Background Image Start-->
        <div id="slider" class="nivoSlider">
        	@foreach($slider_list as $row)
            <img src="{{asset('upload/gallery/'.$row['images'])}}" alt="" title="#htmlcaption" />
            @endforeach
        </div>
        <!--Slider Background Image End-->
    </div>
</section>