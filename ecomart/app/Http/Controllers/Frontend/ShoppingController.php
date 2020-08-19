<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FooterController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_menu;
use App\Models\Province;
use App\Models\Ward;
use App\Models\District;
use App\User;
use App\Models\Article_menu;
use App\Models\Article;
use App\Models\Oder;
use App\Models\Constant;
use App\Http\Requests\Frontend\RequestCheckout;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Functions;
class ShoppingController extends Controller
{
    
    public function getShoppingCart(Request $request){

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
        $data = self::getSession();

        return view('frontend.shopping.shopping-cart',compact('data','get_article_menu','get_category_footer','get_introduce','product_menu','meta_desc','meta_keywords','meta_title','url_canonical'));

    }

    public function getPurchaseNow(Request $request){

        $province = Province::all();
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

        $product_id = $_GET['product_id'];

        $quantity = $_GET['quantity'];

        $product_detail = Product::where('product_id',$product_id)->get()->toArray()[0];

        return view('frontend.shopping.checkout',compact('get_article_menu','get_category_footer','product_menu','get_introduce','province','product_detail','quantity','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function getCheckout(Request $request){

        $province = Province::all();

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

        return view('frontend.shopping.checkout',compact('province','get_category_footer','get_article_menu','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
        
    }


    public function postCheckout(RequestCheckout $request){

        $address_detail = [];

        array_push($address_detail,$request->province,$request->district,$request->ward);

        $id_product = [];

        $quantity = [];

        $price = [];
        // mua ngay
        if(isset($request->purchase_now)){

            $product_id = $_GET['product_id'];

            $product_detail = Product::where('product_id',$product_id)->get()->toArray()[0];

            if(\session()->has('email')){

                $user_id = User::where('email',\session()->get('email'))->first()->toArray()['id'];

                $email = User::where('email',\session()->get('email'))->first()->toArray()['email'];

            } 

            array_push($id_product,$_GET['product_id']);

            array_push($quantity,$_GET['quantity']);

            array_push($price,$product_detail['price']);

        }else{//mua nhiều sản phẩm

            if(\session()->has('email')){

                $user_id = User::where('email',\session()->get('email'))->first()->toArray()['id'];

                $email = User::where('email',\session()->get('email'))->first()->toArray()['email'];

            }

            if(\session()->has('product')){

                foreach(\session()->get('product') as $product){

                    array_push($id_product,$product['id_product']);

                    array_push($quantity,$product['quantity']);

                    array_push($price,$product['price']);

                }

            }

        }

        

        if(!isset($request->is_active)){

            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address_detail' => $request->address_detail,
                'address' => json_encode($address_detail),
                'content' => $request->content,
                'method_purchase' => $request->method_purchase,
                'id_product' => json_encode($id_product),
                'quantity' => json_encode($quantity),
                'price' => json_encode($price),
                'user_id' => $user_id ,
                'is_view' => 0,
                'is_show' => 0
            ];

        }else {

            $address_dif_detail = [];

            array_push($address_dif_detail,$request->province_difference,$request->district_difference,$request->ward_difference);

            $data = [
                'name' => $request->name,
                'name_dif' => $request->name_dif,
                'phone' => $request->phone,
                'phone_dif' => $request->phone_dif,
                'email' => $request->email,
                'email_dif' => $request->email_dif,
                'address_detail' => $request->address_detail,
                'address' => json_encode($address_detail),
                'address_dif_detail' => $request->address_dif_detail,
                'address_dif' => json_encode($address_dif_detail),
                'content' => $request->content,
                'method_purchase' => $request->method_purchase,
                'id_product' => json_encode($id_product),
                'quantity' => json_encode($quantity),
                'price' => json_encode($price),
                'user_id' => $user_id ,
                'is_view' => 0,
                'is_show' => 0
            ];
        }

        $result = Oder::create($data);

        $str = "Bạn đã mua hàng thành công \n Đã gửi email về cho bạn ! .";
        $str_fail = "Bạn đã mua hàng thất bại";
        $url = "/";

        if($result){
            //để tránh nhầm lẫn khi mua nhanh và mua nhiều sản phẩm 
            if(isset($request->purchase_now)){

                self::sendMail($data);

                return view('uploadFileSuccess',compact('str','url'));

            }else {
                self::sendMail($data);

                \session()->forget('product');

                return view('uploadFileSuccess',compact('str','url'));
            }

        }else {

            return view('uploadFileFail',compact('str','url'));

        }

    }

    public function sendMail($data){

        // nếu muốn gửi bằng email của user thì dòng thứ 50
        Mail::to($data['email'])->send(new sendEmail($data));

        if(isset($data['email_dif'])){

            Mail::to($data['email_dif'])->send(new sendEmail($data));

        }

    }

    // ajax province -> district
    public function getDistrictAjax(){

        $idProvince = $_POST['idProvince'];

        $get_district = District::where('provinceId',$idProvince)->get();

        return view('frontend.shopping.list_district_ajax',compact('get_district'));

    }

    // ajax district -> ward
    public function getWardAjax(){

        $idDistrict = $_POST['idDistrict'];

        $get_ward = Ward::where('districtid',$idDistrict)->get();
        
        return view('frontend.shopping.list_ward_ajax',compact('get_ward'));

    }
    
    public function setSession($request,$product){
        $check = true ;
        if($request->session()->has('product')){
            $arr = $request->session()->get('product');
            foreach($arr as $key => $value){
                if($value['id_product'] == $product['id_product']){
                    $arr[$key]['quantity'] = $arr[$key]['quantity'] + 1;
                    $request->session('product')->put('product',$arr);
                    $check = false ;
                }
            }
            if($check){
                $arr = $request->session()->get('product');
                array_push($arr,$product);
                array_values($arr);
                $request->session('product')->put('product',$arr);
            }
        }else {
            $arr = [];
            array_push($arr, $product);
            array_values($arr);
            $request->session()->put('product',$arr);
        }    
    }
    // get session
    public function getSession(){
        if(\session()->has('product')){
            $arr = \session()->get('product');
            return $arr ;
        }
    }

    // ajax add product
    public function postAddProduct(Request $request){

        $count = 0;

    	$id_product = $_POST['id_product'];

    	$get_product = Product::where('product_id',$id_product)->get()->toArray()[0];

    	$images = $get_product['images'];

    	$product_key = ['id_product','slug','name_product','price','sale','quantity','images'];

    	$product_value = [$id_product,$get_product['slug'],$get_product['name'],$get_product['price'],$get_product['sale'],1,$images];

        $sumtotal = 0 ; // để chạy được thằng remove phía dưới nhé ! thân ai sửa code mình

    	$product = array_combine($product_key,$product_value);

    	self::setSession($request,$product);

    	$data = self::getSession();

    	return view('frontend.shopping.shopping-header',compact('data','sumtotal'));

    }

    // ajax click
    public function postRemoveProduct(Request $request){

        $id_product = $_POST['id_product'];

        $data = self::getSession();

        if($request->session()->has('product')){

            $sumtotal = 0;

            foreach($data as $key => $value) {

                if($data[$key]['id_product'] == $id_product){

                    unset($data[$key]);

                }else {

                    $sumtotal += ($data[$key]['quantity' ] * ($data[$key]['price'] - ($data[$key]['price'] * $data[$key]['sale'])/100)); 

                }

            }
            $sumtotal = number_format($sumtotal);

            $data = array_values($data);

            $request->session()->put('product',$data);

        }

        return view('frontend.shopping.shopping-header',compact('data','sumtotal'));
       
    }
    // ajax change
    public function postChangeQuantity(Request $request){

        $quantity_number = $_POST['quantity_number'];

        $id_product = $_POST['id_product'];

        $total = $_POST['total'] ;

        $data = self::getSession();


        if($request->session()->has('product')){
            $sumtotal = 0;
            foreach($data as $key => $value) {

                if($data[$key]['id_product'] == $id_product){

                    $data[$key]['quantity'] = $quantity_number;

                }

                $sumtotal += ($data[$key]['quantity' ] * ($data[$key]['price'] - ($data[$key]['price'] * $data[$key]['sale'])/100)); 

                if($data[$key]['quantity'] <= 0){

                    unset($data[$key]);

                }
                
            }

            $request->session()->put('product',$data);

        }

        $arrCountTotal = [];

        $arr_key = ['count','sumtotal','total'];

        array_push($arrCountTotal,count($data),number_format($sumtotal),number_format($total));

        $arrCountTotal = array_combine($arr_key,$arrCountTotal);

        return $arrCountTotal;
    }

}
