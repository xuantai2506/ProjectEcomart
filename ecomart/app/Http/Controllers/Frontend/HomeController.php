<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FooterController;
use App\Http\Controllers\Functions;
use Illuminate\Http\Request;
use App\Models\Product_menu;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Gallery_menu;
use App\Models\Other;
use App\Models\Online;
use App\Models\OnlineDaily;
use App\Models\RegisterEmail;
use App\Models\Article_menu;
use App\Models\Article;
use App\Models\Constant;
use App\Http\Controllers\DateTime;
class HomeController extends Controller
{
    //  public function __construct()
    // {
    //     $this->middleware('admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
    *
    * $product_menu table product_menu where parent = 0 
    * $slider_list : danh sachs cac hinh anh cua slider
    * $offer_list : danh sachs cac hinh anh cua advertisement
    * $banner_list : danh sach cac hinh anh cua banner
    * $product_menu_hot : danh sach "menu" sanr pham duoc tick noi bat 
    * $product_menu_hot_small : Danh sach "menu con" nam trong $product_menu_hot 
    * $product_check : mục đích lấy ra toàn bộ product_menu_id để kiểm tra bên index
    *
    */

    public function index(Request $request)
    {   
        // ---------------------
        $functions = new Functions();

        $get_article_menu = $functions->get_article_menu();

        $get_category_footer = $functions->get_category_footer();

        $get_introduce = $functions->get_introduce();

        $product_menu = $functions->product_menu();
        // ---------------------

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

        // ---dếm số lượt truy cập---
        $ip = self::get_client_ip();
        self::check_isset_ip($ip);
        self::count_access_website();
        // ---end dếm số lượt truy cập---

        $slider_list = Gallery::where('gallery_menu_id',1)->get();

        $offer_list = Gallery::where('gallery_menu_id',2)->limit(3)->OrderBy('created_at','DESC')->get();

        $banner_list = Gallery::where('gallery_menu_id',3)->limit(1)->OrderBy('created_at','DESC')->get();

        $partner_list = Gallery::where('gallery_menu_id',6)->OrderBy('created_at','DESC')->get();

        $product_menu_hot = Product_menu::where('parent',0)->where('hot',1)->OrderBy('sort','ASC')->get();

        $product_menu_hot_small = Product_menu::all();

        $product_check = Product::get()->pluck('product_menu_id')->toArray();

        $product = Product::all();

        $news_hot_list = Article::join('article_menus','articles.article_menu_id','=','article_menus.article_menu_id')->where('article_menus.category_id',9)->where('articles.hot',1)->OrderBy('articles.created_at','DESC')->get(['articles.images','articles.article_id','articles.name','articles.comment','articles.created_at']);

        return view('frontend.index',compact('get_article_menu','get_category_footer','get_introduce','product_menu','slider_list','offer_list','banner_list','product_menu_hot','product_menu_hot_small','product_check','product','news_hot_list','partner_list','meta_desc','meta_keywords','url_canonical','meta_title'));
    }

    public function getRegisterEmail(){
        return redirect('');
    }
    public function postRegisterEmail(Request $request){
        $email = $request->email;
        $ip = 1;
        $data = [
            'email' => $email ,
            'ip' => $ip ,
        ];
        $result = RegisterEmail::create($data);

        $str = "Bạn đã đăng kí Email thành công";
        $str_fail = "Bạn đã đăng kí Email thất bại";
        $url = "/";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str','url'));
        }

    }

    public function getDetailProduct(Request $request,$slug_detail){
        $functions = new Functions();

        $get_article_menu = $functions->get_article_menu();
        
        $get_category_footer = $functions->get_category_footer();

        $get_introduce = $functions->get_introduce();

        // -----------------seo--------------
        $constant = Constant::where('type',0)->get(['constant','value']);
        foreach ($constant as $key => $value) {
            if($value['constant'] == 'keywords'){
                $meta_keywords = $value['value'];
            }else {
                $url_canonical = $request->url();
            }
        }

        // ----------------endseo-------------

        $other = Other::where('others_menu_id',71)->get();

        $product_detail = Product::where('slug',$slug_detail)->get()->toArray()[0];
        
        $meta_desc = $product_detail['description'];

        $meta_title = $product_detail['name'];

        $product = Product::all();

        $product_menu = Product_menu::all();

        return view('frontend.product.detail',compact('product_detail','product_menu','other','product','get_article_menu','get_category_footer','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }


     // Đếm số lượt truy cập
    function get_client_ip() {

        $ip = $_SERVER['REMOTE_ADDR'];

        return $ip;

    }

    function check_isset_ip($ip){

        $onlines_database = Online::pluck('ip')->toArray();

        if(!in_array($ip,$onlines_database)){

            $add_ip = Online::create(['ip' => $ip]);

        }

    }
    // gọi ra trang chính
    function count_access_website(){
        // cấu hình
        $expires = new \DateTime('NOW');

        $date_now = $expires->format('y/m/d');

        $date_database = OnlineDaily::pluck('created_at')->toArray();

        $date = [];

        foreach($date_database as $date_databases){

            $date_time = $date_databases->format('H:i:s');

            $date_format = $date_databases->format('y/m/d');

            array_push($date,$date_format);

        }

        //end cấu hình
        if(!in_array($date_now,$date)){

            $count = 1 ;

            OnlineDaily::create(['count' => $count]);

        }else {
            
            $date_check = '20'.$date_format." ".$date_time;

            $get_count = OnlineDaily::where('created_at',$date_check)->pluck('count')->toArray()[0];
            
            $update = OnlineDaily::where('created_at',$date_check)->update(['count' => $get_count + 1]);
            
        }
    }
}
