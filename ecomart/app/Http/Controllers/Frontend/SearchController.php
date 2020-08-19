<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FooterController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_menu;
use App\Models\Article_menu;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Constant;
use App\Models\Gallery_menu;
use App\Models\Other;
use App\Models\Online;
use App\Models\OnlineDaily;
use App\Models\RegisterEmail;
use App\Http\Controllers\DateTime;
use App\Http\Controllers\Functions;
class SearchController extends Controller
{
	// public function getProductSearch(){
 //        dd("oke");
	// 	return view('');
	// }
    public function postProductSearch(Request $request){
        $product = Product::all();

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

    	$search = $request->search;

    	$product_list = Product::where('name','like','%'.$search.'%')->paginate(32);

    	return view('frontend.search.search',compact('product_list','get_category_footer','get_article_menu','product_menu','product','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function getDetailProductMenu(Request $request,$slug_product_menu){
        $product = Product::all();

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

        // parent của đối tượng mình vừa click -> dienj nang luong mat troi 0 , combo : 1 ,inverter : 1 ;
        $parent_product = Product_menu::where('slug',$slug_product_menu)->pluck('parent')->toArray()[0];
        
        // lấy toàn bộ product_menu_id trong bảng product
        $product_id = Product::pluck('product_menu_id')->toArray();

        //kiểm tra ,nếu $parent_product == 0 -> nếu click vào dien-nang-luong-mat-troi thì parent_product = 0 
        if($parent_product == 0){

            $product_list  = [];
            // tìm kiếm id của đối tượng vừa click -> gán id đó là parent của các product_menu_child
            $parent = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];

            // mình tìm các product_menu_child có parent bằng với id của product_menu_main
            $product_menu_id = Product_menu::where('parent',$parent)->pluck('product_menu_id')->toArray();

            // mình lặp kiểm tra từng product_menu_id có trong bảng product không ?
            foreach($product_menu_id as $product_menu_ids){

                //nếu có tồn tại product_menu_ids
                if(in_array($product_menu_ids,$product_id)){

                    // thì lấy các đối tượng có product_menu_ids ra gán vào products
                    $products = Product::where('product_menu_id',$product_menu_ids)->get()->toArray();

                    // lặp từng phần tử trong mảng vừa tìm được là products
                    foreach($products as $productss){

                        //push nó vào 1 mảng mới
                        array_push($product_list,$productss);
                        //ta có một mảng product_list là mảng cần tìm
                        
                    }
                }
            }

        }else { //nếu clcik vào product_menu_child nên parent_product không bao giờ bằng 0
            //ví dụ : $slug_product_menu = 'combo' => tìm kiếm id_product_menu có slug = $slug_product_menu => lấy được id = 30
            $id_product_menu = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            //mình vào bảng product tìm kiếm những sản phẩm nào có product_menu_id = 30
            $product_list = Product::where('product_menu_id',$id_product_menu)->paginate(32);
            // tìm kiếm parent này để xài vào dòng thứ 101 
            $parent = Product_menu::where('product_menu_id',$id_product_menu)->pluck('parent')->toArray()[0];

        } 
        $other = Other::where('others_menu_id',71)->get();
        $product_menu_main = Product_menu::where('slug',$slug_product_menu)->get()->toArray()[0];
        $product_menu_child = Product_menu::where('parent',$parent)->get();
        
        
        return view('frontend.shopping.shopping_detail',compact('product_list','product_menu_main','product_menu_child','slug_product_menu','other','get_category_footer','get_article_menu','product','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }


    public function searchProductPrice(Request $request,$slug_product_menu,$id_price){
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

        $product = Product::all();
        $arrPrice = self::ArrPrice($id_price - 1);
        // parent của đối tượng mình vừa click -> dienj nang luong mat troi 0 , combo : 1 ,inverter : 1 ;
        $parent_product = Product_menu::where('slug',$slug_product_menu)->pluck('parent')->toArray()[0];
        // lấy toàn bộ product_menu_id trong bảng product
        $product_id = Product::pluck('product_menu_id')->toArray();

        if($parent_product == 0){
            $product_list  = [];
            // tìm kiếm id của đối tượng vừa click -> gán id đó là parent của các product_menu_child
            $parent = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            // mình tìm các product_menu_child có parent bằng với id của product_menu_main
            $product_menu_id = Product_menu::where('parent',$parent)->pluck('product_menu_id')->toArray();
            // mình lặp kiểm tra từng product_menu_id có trong bảng product không ?
            foreach($product_menu_id as $product_menu_ids){
                //nếu có tồn tại product_menu_ids
                if(in_array($product_menu_ids,$product_id)){
                    // thì lấy các đối tượng có product_menu_ids ra gán vào products
                    $products = Product::where('product_menu_id',$product_menu_ids)->whereBetween('price',$arrPrice)->get()->toArray();
                    // lặp từng phần tử trong mảng vừa tìm được là products
                    foreach($products as $productss){
                        //push nó vào 1 mảng mới
                        array_push($product_list,$productss);
                        //ta có một mảng product_list là mảng cần tìm
                    }
                }
            }
        }else { //nếu clcik vào product_menu_child nên parent_product không bao giờ bằng 0
            //ví dụ : $slug_product_menu = 'combo' => tìm kiếm id_product_menu có slug = $slug_product_menu => lấy được id = 30
            $id_product_menu = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            //mình vào bảng product tìm kiếm những sản phẩm nào có product_menu_id = 30
            $product_list = Product::where('product_menu_id',$id_product_menu)->whereBetween('price',$arrPrice)->paginate(32);
            // tìm kiếm parent này để xài vào dòng thứ 101 
            $parent = Product_menu::where('product_menu_id',$id_product_menu)->pluck('parent')->toArray()[0];

        } 
        $other = Other::where('others_menu_id',71)->get();
        $product_menu_main = Product_menu::where('slug',$slug_product_menu)->get()->toArray()[0];
        $product_menu_child = Product_menu::where('parent',$parent)->get();

        return view('frontend.shopping.shopping_detail',compact('product_list','product_menu_main','product_menu_child','slug_product_menu','other','id_price','get_article_menu','get_category_footer','product','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function searchProductOther(Request $request,$slug_product_menu,$others_id){

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

        $product = Product::all();
        // parent của đối tượng mình vừa click -> dienj nang luong mat troi 0 , combo : 1 ,inverter : 1 ;
        $parent_product = Product_menu::where('slug',$slug_product_menu)->pluck('parent')->toArray()[0];
        // lấy toàn bộ product_menu_id trong bảng product
        $product_id = Product::pluck('product_menu_id')->toArray();
        if($parent_product == 0){
            $product_list  = [];
            // tìm kiếm id của đối tượng vừa click -> gán id đó là parent của các product_menu_child
            $parent = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            // mình tìm các product_menu_child có parent bằng với id của product_menu_main
            $product_menu_id = Product_menu::where('parent',$parent)->pluck('product_menu_id')->toArray();
            // mình lặp kiểm tra từng product_menu_id có trong bảng product không ?
            foreach($product_menu_id as $product_menu_ids){
                //nếu có tồn tại product_menu_ids
                if(in_array($product_menu_ids,$product_id)){
                    // thì lấy các đối tượng có product_menu_ids ra gán vào products
                    $products = Product::where('product_menu_id',$product_menu_ids)->where('producer',$others_id)->get()->toArray();
                    // lặp từng phần tử trong mảng vừa tìm được là products
                    foreach($products as $productss){
                        //push nó vào 1 mảng mới
                        array_push($product_list,$productss);
                        //ta có một mảng product_list là mảng cần tìm
                    }
                }
            }
        }else { //nếu clcik vào product_menu_child nên parent_product không bao giờ bằng 0
            //ví dụ : $slug_product_menu = 'combo' => tìm kiếm id_product_menu có slug = $slug_product_menu => lấy được id = 30
            $id_product_menu = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            //mình vào bảng product tìm kiếm những sản phẩm nào có product_menu_id = 30
            $product_list = Product::where('product_menu_id',$id_product_menu)->where('producer',$others_id)->paginate(32);
            // tìm kiếm parent này để xài vào dòng thứ 101 
            $parent = Product_menu::where('product_menu_id',$id_product_menu)->pluck('parent')->toArray()[0];

        } 
        $other = Other::where('others_menu_id',71)->get();
        $product_menu_main = Product_menu::where('slug',$slug_product_menu)->get()->toArray()[0];
        $product_menu_child = Product_menu::where('parent',$parent)->get();

        return view('frontend.shopping.shopping_detail',compact('product_list','product_menu_main','product_menu_child','slug_product_menu','other','others_id','get_category_footer','get_article_menu','product','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function searchProductPriceOthers(Request $request,$slug_product_menu,$id_price,$others_id){

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

        $product = Product::all();
        $arrPrice = self::ArrPrice($id_price - 1);
        // parent của đối tượng mình vừa click -> dienj nang luong mat troi 0 , combo : 1 ,inverter : 1 ;
        $parent_product = Product_menu::where('slug',$slug_product_menu)->pluck('parent')->toArray()[0];
        // lấy toàn bộ product_menu_id trong bảng product
        $product_id = Product::pluck('product_menu_id')->toArray();

        if($parent_product == 0){
            $product_list  = [];
            // tìm kiếm id của đối tượng vừa click -> gán id đó là parent của các product_menu_child
            $parent = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            // mình tìm các product_menu_child có parent bằng với id của product_menu_main
            $product_menu_id = Product_menu::where('parent',$parent)->pluck('product_menu_id')->toArray();
            // mình lặp kiểm tra từng product_menu_id có trong bảng product không ?
            foreach($product_menu_id as $product_menu_ids){
                //nếu có tồn tại product_menu_ids
                if(in_array($product_menu_ids,$product_id)){
                    // thì lấy các đối tượng có product_menu_ids ra gán vào products
                    $products = Product::where('product_menu_id',$product_menu_ids)->where('producer',$others_id)->whereBetween('price',$arrPrice)->get()->toArray();
                    // lặp từng phần tử trong mảng vừa tìm được là products
                    foreach($products as $productss){
                        //push nó vào 1 mảng mới
                        array_push($product_list,$productss);
                        //ta có một mảng product_list là mảng cần tìm
                    }
                }
            }
        }else { //nếu clcik vào product_menu_child nên parent_product không bao giờ bằng 0
            //ví dụ : $slug_product_menu = 'combo' => tìm kiếm id_product_menu có slug = $slug_product_menu => lấy được id = 30
            $id_product_menu = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            //mình vào bảng product tìm kiếm những sản phẩm nào có product_menu_id = 30
            $product_list = Product::where('product_menu_id',$id_product_menu)->where('producer',$others_id)->whereBetween('price',$arrPrice)->paginate(32);
            // tìm kiếm parent này để xài vào dòng thứ 101 
            $parent = Product_menu::where('product_menu_id',$id_product_menu)->pluck('parent')->toArray()[0];

        } 
        $other = Other::where('others_menu_id',71)->get();
        $product_menu_main = Product_menu::where('slug',$slug_product_menu)->get()->toArray()[0];
        $product_menu_child = Product_menu::where('parent',$parent)->get();

        return view('frontend.shopping.shopping_detail',compact('product_list','product_menu_main','product_menu_child','slug_product_menu','other','id_price','get_article_menu','get_category_footer','product','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function searchProductOthersPrice(Request $request,$slug_product_menu,$others_id,$id_price){
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

        $product = Product::all();
        $arrPrice = self::ArrPrice($id_price - 1);
        // parent của đối tượng mình vừa click -> dienj nang luong mat troi 0 , combo : 1 ,inverter : 1 ;
        $parent_product = Product_menu::where('slug',$slug_product_menu)->pluck('parent')->toArray()[0];
        // lấy toàn bộ product_menu_id trong bảng product
        $product_id = Product::pluck('product_menu_id')->toArray();

        if($parent_product == 0){
            $product_list  = [];
            // tìm kiếm id của đối tượng vừa click -> gán id đó là parent của các product_menu_child
            $parent = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            // mình tìm các product_menu_child có parent bằng với id của product_menu_main
            $product_menu_id = Product_menu::where('parent',$parent)->pluck('product_menu_id')->toArray();
            // mình lặp kiểm tra từng product_menu_id có trong bảng product không ?
            foreach($product_menu_id as $product_menu_ids){
                //nếu có tồn tại product_menu_ids
                if(in_array($product_menu_ids,$product_id)){
                    // thì lấy các đối tượng có product_menu_ids ra gán vào products
                    $products = Product::where('product_menu_id',$product_menu_ids)->where('producer',$others_id)->whereBetween('price',$arrPrice)->get()->toArray();
                    // lặp từng phần tử trong mảng vừa tìm được là products
                    foreach($products as $productss){
                        //push nó vào 1 mảng mới
                        array_push($product_list,$productss);
                        //ta có một mảng product_list là mảng cần tìm
                    }
                }
            }
        }else { //nếu clcik vào product_menu_child nên parent_product không bao giờ bằng 0
            //ví dụ : $slug_product_menu = 'combo' => tìm kiếm id_product_menu có slug = $slug_product_menu => lấy được id = 30
            $id_product_menu = Product_menu::where('slug',$slug_product_menu)->pluck('product_menu_id')->toArray()[0];
            //mình vào bảng product tìm kiếm những sản phẩm nào có product_menu_id = 30
            $product_list = Product::where('product_menu_id',$id_product_menu)->where('producer',$others_id)->whereBetween('price',$arrPrice)->paginate(32);
            // tìm kiếm parent này để xài vào dòng thứ 101 
            $parent = Product_menu::where('product_menu_id',$id_product_menu)->pluck('parent')->toArray()[0];

        } 
        $other = Other::where('others_menu_id',71)->get();
        $product_menu_main = Product_menu::where('slug',$slug_product_menu)->get()->toArray()[0];
        $product_menu_child = Product_menu::where('parent',$parent)->get();

        return view('frontend.shopping.shopping_detail',compact('product_list','product_menu_main','product_menu_child','slug_product_menu','other','id_price','others_id','get_article_menu','get_category_footer','product','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function ArrPrice($id_price){
        $arrPrice = [
            [-1,500001],
            [500001,1000001],
            [1000001,3000001],
            [3000001,5000001],
            [5000001,8000001],
            [8000001,10000001],
            [10000001,999999999],
        ];
        return $arrPrice[$id_price];
    }
}
