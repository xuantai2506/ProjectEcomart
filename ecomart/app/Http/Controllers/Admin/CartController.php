<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Models\Oder;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Product;

class CartController extends Controller
{

    public function loadPageAdmin($str,$arr_privilege_slug){

        $check = !in_array($str,$arr_privilege_slug) ;

        return $check;

    }

    public function index(){

    	$get_cart = Oder::paginate(15);

    	$get_province = Province::all();

    	$get_district = District::all();

    	$get_ward = Ward::all();

    	$get_product = Product::all();

        // phân quyền
        $role_id = CoreUser::where('email',Auth::user()->email)->get()->pluck('role_id')->toArray()[0];

        $category_privilege = CorePrivilege::where('role_id',$role_id)->where('type','category')->get()->pluck('privilege_slug')->toArray();

        $check = self::loadPageAdmin('order_list',$category_privilege);

        if($check){
            $str = 'Bạn không được cấp quyền vào trang này !';
            $url = 'home';
            return view('loadPage.loadPageAdmin',compact('str','url'));
        }
        // hết phân quyền

    	return view('admin.cart.manager',compact('get_cart','get_province','get_district','get_ward','get_product'));
    	
    }

    public function getIsViewCart(){

    	$id_cart = $_POST['id_cart'];

    	$is_view = Oder::where('order_id',$id_cart)->pluck('is_view')[0];

        if($is_view == 1){
            Oder::where('order_id',$id_cart)->update(['is_view' => 0]);
            // $html = "<button type='button' id='$id_cart' class='btn btn-sm-sm btn-warning is_view_cart' data-toggle='tooltip' data-placement='top' rel='0; data-original-title='Chuyển sang: Đã xem'>Chưa xem</button>";
        }else {
           Oder::where('order_id',$id_cart)->update(['is_view' => 1]);
           // $html = "<button type='button' id='$id_cart' class='btn btn-sm-sm btn-success is_view_cart' data-toggle='tooltip' data-placement='top'   rel='1' data-original-title='Chuyển sang: Chưa xem'>Đã xem</button>";
        }

        // return $html;

    }

    public function getIsShowCart(){

    	$id_cart = $_POST['id_cart'];

    	$is_show = Oder::where('order_id',$id_cart)->pluck('is_show')[0];

        if($is_show == 1){
            Oder::where('order_id',$id_cart)->update(['is_show' => 0]);
        }else {
           Oder::where('order_id',$id_cart)->update(['is_show' => 1]);
        }

    }


     public function postDellCart(Request $request){

        $str = "Bạn đã xóa thành công";
        $str_fail = "Bạn đã xóa thất bại";
        $url = "admin/cart_manager";

        $order_database = Oder::get()->pluck('order_id')->toArray();
        $remove = $request->delete ;
        
        if($remove != null){
            foreach($remove as $removes){
                if(in_array($removes,$order_database)){

                    $result = Oder::where('order_id',$removes)->delete();
                }
            }
        }else {
            return redirect()->back();
        }
        
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }
        
    }
}
