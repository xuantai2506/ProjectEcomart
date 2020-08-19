<option value="0">Chọn quận huyện…</option>
@foreach($get_district as $get_districts)
<option value="{{$get_districts['districtId']}}">{{$get_districts['name']}}</option>
@endforeach

<script type="text/javascript" src="{{URL::to('frontend/js/menu/shopping.js')}}"></script>