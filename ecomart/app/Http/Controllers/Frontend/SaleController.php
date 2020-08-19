<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FooterController;
use Illuminate\Http\Request;
use App\Models\Article_menu;
use App\Models\Article;
use App\Models\Product_menu;
use App\Models\Constant;
use App\Http\Controllers\Functions;
class SaleController extends Controller
{
    public function getSale(Request $request){

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

        $sale_menu = Article_menu::where('category_id',9)->where('is_active',1)->get();

        $arr_sale = Article::join('article_menus','articles.article_menu_id','=','article_menus.article_menu_id')->where('article_menus.category_id',9)->select(['articles.article_id','articles.name','articles.images','articles.slug','articles.content','articles.comment','articles.created_at'])->where('articles.hot',1)->OrderBy('created_at','DESC')->paginate(10);

    	return view('frontend.news.news',compact('product_menu','get_category_footer','get_article_menu','arr_sale','get_introduce','sale_menu','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function getSaleDetail(Request $request,$id){

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

        $article_menu_id = Article::where('article_id',$id)->get('article_menu_id')->toArray()[0]['article_menu_id'];

        $sale_related = Article::where('article_id','!=',$id)->where('article_menu_id',$article_menu_id)->get();

        $sale_detail = Article::where('article_id',$id)->get()->toArray()[0];

        $sale_menu = Article_menu::where('category_id',9)->where('is_active',1)->get();

        return view('frontend.news.detail',compact('product_menu','get_category_footer','get_article_menu','sale_detail','sale_menu','get_introduce','sale_related','meta_desc','meta_keywords','meta_title','url_canonical'));

    }

    public function getSaleMonth(Request $request,$slug){
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

        $article_menu_id = Article_menu::where('slug',$slug)->get()->pluck('article_menu_id')->toArray()[0];

        $sale_menu = Article_menu::where('category_id',9)->where('is_active',1)->get();

        $arr_sale = Article::where('article_menu_id',$article_menu_id)->paginate(10);

        if($arr_sale->items() == []){
        	return view('error.404',compact('product_menu','get_category_footer','get_article_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
        }
        return view('frontend.news.news',compact('product_menu','get_category_footer','get_article_menu','arr_sale','get_introduce','sale_menu','meta_desc','meta_keywords','meta_title','url_canonical'));

    }
}
