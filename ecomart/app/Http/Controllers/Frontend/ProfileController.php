<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product_menu;
use App\Models\Constant;
use App\Http\Controllers\Functions;
use App\User;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Http\Requests\Frontend\RequestProfile;
class ProfileController extends Controller
{
    public function getProfile(Request $request){
    	// --------------------------
    	$functions = new Functions();

        $get_article_menu = $functions->get_article_menu();
        
        $get_category_footer = $functions->get_category_footer();

        $product_menu = $functions->product_menu();

        $get_introduce = $functions->get_introduce();
    	// ----------!!!!------------
    	// -----------------seo--------------
        $constant = Constant::where('type',0)->get(['constant','value']);
        foreach ($constant as $key => $value) {
            if($value['constant'] == 'description'){
                $meta_desc = $value['value'];
            }elseif($value['constant'] == 'keywords'){
                $meta_keywords = $value['value'];
            }elseif($value['constant'] == 'title'){
                $meta_title = $value['value'];
            }else {
                $url_canonical = $request->url();
            }
        }
        // ----------------endseo-------------
        if(!empty(\session('email'))){
        	$profile = User::where('email',\session('email'))->get()->toArray()[0];
        }
        return view('frontend.profile.profile',compact('get_article_menu','get_category_footer','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical','profile'));
    }

    public function getUpdateProfile(Request $request){

    	// --------------------------
    	$functions = new Functions();

        $get_article_menu = $functions->get_article_menu();
        
        $get_category_footer = $functions->get_category_footer();

        $product_menu = $functions->product_menu();

        $get_introduce = $functions->get_introduce();
    	// ----------!!!!------------

    	// -----------------seo--------------
        $constant = Constant::where('type',0)->get(['constant','value']);
        foreach ($constant as $key => $value) {
            if($value['constant'] == 'description'){
                $meta_desc = $value['value'];
            }elseif($value['constant'] == 'keywords'){
                $meta_keywords = $value['value'];
            }elseif($value['constant'] == 'title'){
                $meta_title = $value['value'];
            }else {
                $url_canonical = $request->url();
            }
        }
        // ----------------endseo-------------

        $province = Province::all();
        $district = District::all();
        $ward 	  = Ward::all();


        if(!empty(\session('email'))){
        	$profile = User::where('email',\session('email'))->get()->toArray()[0];
        }

        if($profile['address'] != null){
            $province_id = json_decode($profile['address'])[0];
            $district_id = json_decode($profile['address'])[1];
            $ward_id = json_decode($profile['address'])[2];
        }else {
            $province_id = 0;
            $district_id = 0;
            $ward_id = 0;
        }

        return view('frontend.profile.update-profile',compact('get_article_menu','get_category_footer','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical','profile','province','district','ward','province_id','district_id','ward_id'));
    }

    public function postUpdateProfile(RequestProfile $request){

    	$address = [];

        array_push($address,$request->province,$request->district,$request->ward);

        $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address_detail' => $request->address_detail,
                'address' => json_encode($address),
            ];

        $result = User::where('email',\session('email'))->update($data);

        $str = "Bạn đã cập nhật thông tin thành công";
        $str_fail = "Bạn đã cập nhật thông tin thất bại";
        $url = "/update-profile";

        if($result){

            return view('uploadFileSuccess',compact('str','url'));

        }else {

            return view('uploadFileFail',compact('str_fail','url'));

        }
    }
}
