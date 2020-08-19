<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FooterController;
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
use App\Http\Controllers\Functions;
class ComboController extends Controller
{
    public function getCombo(Request $request){

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
        $product_list = Product::paginate(32);

        $product_menu_child = Product_menu::all();

        $product = Product::where('hot',1)->get();

        $other = Other::where('others_menu_id',71)->get();

    	return view('frontend.combo.combo',compact('product_menu','get_article_menu','get_category_footer','product_list','product','product_menu_child','other','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));

    }

    public function searchComboPrice(Request $request,$id_price){
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

    	$arrPrice = self::ArrPrice($id_price - 1);

    	$product_menu_child = Product_menu::all();

    	$product_list = Product::where('hot',1)->whereBetween('price',$arrPrice)->paginate(32);

    	$product = Product::where('hot',1)->whereBetween('price',$arrPrice)->get();

    	$other = Other::where('others_menu_id',71)->get();

    	return view('frontend.combo.combo',compact('product_menu','get_article_menu','get_category_footer','product_menu_child','product','product_list','other','id_price','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));

    }

    public function searchComboOther(Request $request,$other_id){
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

    	$product_menu_child = Product_menu::all();

    	$product_list = Product::where('hot',1)->where('producer',$other_id)->paginate(32);

    	$product = Product::where('hot',1)->where('producer',$other_id)->get();

    	$other = Other::where('others_menu_id',71)->get();

    	return view('frontend.combo.combo',compact('product_menu','get_article_menu','get_category_footer','product_menu_child','product','product_list','other','other_id','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));

    }

    public function searchComboPriceOther (Request $request,$id_price,$other_id){
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

    	$arrPrice = self::ArrPrice($id_price - 1);

    	$product_menu_child = Product_menu::all();

    	$product_list = Product::where('hot',1)->where('producer',$other_id)->whereBetween('price',$arrPrice)->paginate(32);

    	$product = Product::where('hot',1)->where('producer',$other_id)->whereBetween('price',$arrPrice)->get();

    	$other = Other::where('others_menu_id',71)->get();

    	return view('frontend.combo.combo',compact('product_menu','get_article_menu','get_category_footer','product_menu_child','product','product_list','other','id_price','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function searchComboOtherPrice(Request $request,$other_id,$id_price){
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

    	$arrPrice = self::ArrPrice($id_price - 1);

    	$product_menu_child = Product_menu::all();

    	$product_list = Product::where('hot',1)->where('producer',$other_id)->whereBetween('price',$arrPrice)->paginate(32);

    	$product = Product::where('hot',1)->where('producer',$other_id)->whereBetween('price',$arrPrice)->get();

    	$other = Other::where('others_menu_id',71)->get();

    	return view('frontend.combo.combo',compact('product_menu','get_article_menu','get_category_footer','product_menu_child','product','product_list','other','other_id','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));

    }



    public function ArrPrice($id_price){
        $arrPrice = [
            [-1,500001],
            [500001,1000001],
            [1000001,3000001],
            [3000001,5000001],
            [5000001,8000001],
            [8000001,10000001],
            [10000001,999999999999],
        ];
        return $arrPrice[$id_price];
    }
}
