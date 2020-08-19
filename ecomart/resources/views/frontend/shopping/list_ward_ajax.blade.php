<option value="0">Chọn phường xã…</option>
@foreach($get_ward as $get_wards)
<option value="{{$get_wards['wardid']}}">{{$get_wards['name']}}</option>
@endforeach
