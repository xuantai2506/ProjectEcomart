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
class ArticleController extends Controller{
    
    public function getArticle(Request $request,$slug_article){
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

    	$article_menu_id = Article_menu::where('slug',$slug_article)->get()->pluck('article_menu_id')->toArray()[0];

    	$get_article = Article::where('article_menu_id',$article_menu_id)->get()->toArray();

    	if(count($get_article) == 1){

            $get_article = $get_article[0];

    		return view('frontend.article.article',compact('get_article_menu','get_category_footer','get_article','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));

    	}else if(count($get_article) == 0){

    		return view('error.404',compact('get_article_menu','get_category_footer','get_article','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));

    	}else {

            dd("nhieu qua");
            
        }
    }
}
