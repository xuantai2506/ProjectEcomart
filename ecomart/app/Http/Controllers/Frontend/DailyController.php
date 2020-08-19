<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FooterController;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Frontend\RequestContact;
use App\Models\Constant;
use App\Mail\sendMailAgency;
use Illuminate\Support\Facades\Mail;
use App\Models\Article_menu;
use App\Models\Article;
use App\Models\Product_menu;
use App\Http\Controllers\Functions;
class DailyController extends Controller
{
    public function index(Request $request){
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
    	return view('frontend.contact.contact',compact('get_article_menu','get_category_footer','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));

    }

    public function postSendInforDaily(RequestContact $request){

    	$data = $request->all();

    	$data['is_active'] = 0;

    	$result = Contact::create($data);

    	$str = "Bạn đã thêm  thông tin đại lý thành công";
        $str_fail = "Bạn đã thêm thông tin đại lý thất bại";
        $url = "/dai-ly";

        if($result){
            self::sendMailAgency($data);

            return view('uploadFileSuccess',compact('str','url'));

        }else {

            return view('uploadFileFail',compact('str_fail','url'));

        }

    }

    public function sendMailAgency($data){

        $email_admin = Constant::where('type',1)->where('constant','SMTP_username')->get('value')->toArray()[0]['value'];
        
        Mail::to($email_admin)->send(new sendMailAgency($data));

        Mail::to($data['email'])->send(new sendMailAgency($data));

    }



}
