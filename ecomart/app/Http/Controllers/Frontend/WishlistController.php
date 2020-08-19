<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FooterController;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\User;
use App\Models\Constant;
use App\Models\Article_menu;
use App\Models\Product_menu;
use App\Http\Controllers\Functions;
class WishlistController extends Controller
{
	public function getWishlist(Request $request){
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

		$user_id = User::where('email',\session()->get('email'))->get()->pluck('id')->toArray()[0];

		$get_wishlist = Wishlist::where('user_id',$user_id)->get();

		$product = Product::all();

		return view('frontend.wishlist.wishlist',compact('product','get_wishlist','get_category_footer','get_article_menu','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));

	}

    public function postAddWishlist(){

    	$product_id = $_POST['product_id'];

    	$user_id = User::where('email',\session()->get('email'))->get()->pluck('id')->toArray()[0];


    	$count = count(Wishlist::where('product_id',$product_id)->where('user_id',$user_id)->get());

		if($count == 0){

			Wishlist::create(['product_id' => $product_id ,'user_id' => $user_id]);

		}
    	
    }

    public function removeWishlist(){

    	$product_id = $_POST['product_id'];

    	$user_id = User::where('email',\session()->get('email'))->get()->pluck('id')->toArray()[0];

    	Wishlist::where('product_id',$product_id)->where('user_id',$user_id)->delete();

    }
}
