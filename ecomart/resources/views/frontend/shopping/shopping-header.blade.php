<!-- sumtotal -->
<input type="hidden" id="get_sumtotal" value="{{$sumtotal}}" name="">
<!-- -------- -->
<a href="#"><i class="ion-android-cart"></i>
    <?php 
    if(\session()->has('product')){
        $arr = \session()->get('product');
        $count = 0 ;
    ?>

    <span class="cart-add">{{count($data)}}</span>

    <?php 
    }
    ?>
</a>

<ul class="cart-dropdown">

    @foreach($data as $datas)
    {{ $count = ($datas['price']- ($datas['price'] * $datas['sale'])/100 ) * $datas['quantity'] + $count}}

    <!--Single Cart Item Start-->
    <li class="cart-item tr_{{$datas['id_product']}}">
        <div class="cart-img">
            <a href="{{URL::to('/product/'.$datas['slug'])}}"><img src="{{asset('upload/product/'.$datas['images'])}}" alt=""></a>
        </div>
        <div class="cart-content">
            <h4><a href="{{URL::to('/product/'.$datas['slug'])}}">{{$datas['name_product']}}</a></h4>
            <p class="cart-quantity">Số lượng: {{$datas['quantity']}}</p>
            <p class="cart-price"><?php echo number_format($datas['price']- ($datas['price'] * $datas['sale'])/100) ?>₫</p>
        </div>
        <div class="cart-close">
            <a href="#" class="remove-product" id="{{$datas['id_product']}}" value="{{$datas['price'] * $datas['quantity']}}" title="Remove"><i class="ion-android-close"></i></a>
        </div>
    </li>

    @endforeach

    <!--Single Cart Item Start-->
    <!--Cart Total Start-->
    <li class="cart-total-amount mtb-20">
        <h4>TỔNG TIỀN: <span class="pull-right total"><?php echo number_format($count);?>₫</span></h4>
    </li>
    <!--Cart Total End-->
    <!--Cart Button Start-->
    <li class="cart-button">
        @if(\session()->has('email'))
         <a href="{{URL::to('checkout')}}" class="button2">THANH TOÁN</a>
        @else
        <a href="" class="button2 button-pay checkout">THANH TOÁN</a>
        @endif
        <a href="{{URL::to('shopping-cart')}}" class="button2">XEM GIỎ HÀNG</a>
    </li>
    <!--Cart Button End-->
</ul>

<script type="text/javascript" src="{{asset('frontend/js/menu/check-login.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/menu/removeProduct.js')}}"></script>