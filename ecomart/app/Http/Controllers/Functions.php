<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CorePrivilege;
use App\Models\CoreUser;
use App\Models\Article_menu;
use App\Models\Category;
use App\Models\Product_menu;
class Functions extends Controller
{
    public function loadPageAdmin($str,$filter){
        
        $role_id = CoreUser::where('email',Auth::user()->email)->get()->pluck('role_id')->toArray()[0];

        $category_privilege = CorePrivilege::where('role_id',$role_id)->where('type',$filter)->get()->pluck('privilege_slug')->toArray();

        $check = !in_array($str,$category_privilege) ;

        return $check;

    }

    public function loadPageAdminTwo($str,$filter,$id){

         // phân quyền
        $role_id = CoreUser::where('email',Auth::user()->email)->get()->pluck('role_id')->toArray()[0];

        $filter_privilege = CorePrivilege::where('role_id',$role_id)->where('type',$filter)->get()->pluck('privilege_slug')->toArray();

        $check = !in_array($str.';'.$id,$filter_privilege);
        
        return $check ; 
        // hết phân quyền

    }

    // footer 

    public function get_article_menu(){
      return Article_menu::where('hot',1)->OrderBy('sort','ASC')->get();
    }

    public function get_category_footer(){
      return Category::where('type_id',1)->where('hot',1)->OrderBy('sort','ASC')->get();
    }

    public function get_introduce(){
      return Article_menu::where('category_id',10)->OrderBy('sort','ASC')->get()->toArray()[0];
    }

    public function product_menu(){
      return Product_menu::where('parent',0)->where('is_active',1)->OrderBy('sort','ASC')->get(); 
    }

    

    // conver text (chính)
    function convert($name){
        $str = self::convert_vi_to_en($name);
        $arrStr = explode(" ",$str);
        $convert = implode("-",$arrStr);
        return strtolower($convert).'-'.self::generateRandomString();
    }
    // random text
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // chuyển text sang tiếng việt
    function convert_vi_to_en($str) {
      $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
      $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
      $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
      $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
      $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
      $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
      $str = preg_replace("/(đ)/", "d", $str);
      $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
      $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
      $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
      $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
      $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
      $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
      $str = preg_replace("/(Đ)/", "D", $str);
      //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
      return $str;
    }
    // end conver text
}
