<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FooterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\RequestRegister;
use App\Http\Requests\Frontend\RequestLogin;
use App\Http\Requests\Frontend\RequestResetPass;
use App\User;
use App\Models\CoreUser;
use App\Models\CoreRole;
use App\Models\Constant;
use App\Models\Article_menu;
use App\Models\Article;
use App\Models\Product_menu;
use Carbon\Carbon;
use App\Mail\sendMailResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Functions;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getLogin(Request $request){
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

        return view('frontend.member.login',compact('get_category_footer','get_article_menu','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function getRegister(Request $request){
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

        return view('frontend.member.register',compact('get_category_footer','get_article_menu','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function postLogin(RequestLogin $request){
        
        $email = $request->email;

        $password = $request->password;


        
        $checkuser = User::selectRaw("Count(*) as Total")->where('email','=',$email)->where('level',1)->first();

        if(intval($checkuser->Total) > 0){

            $getpassword = User::select('Password')->where('email','=',$email)->first();
            
            if(password_verify($password, $getpassword->Password)){

                $request->session()->put('email',$email);

                if($email != ''){//hiển thị tên người dùng 
                    $user_name = User::where('email',$email)->get()->pluck('name')->toArray()[0];
                    $request->session()->put('user_name',$user_name);
                }

                return redirect('/');

            }else {

                return redirect('logins')->with('fail-login','Tài khoản hoặc mật khẩu không đúng !');

            }

        }else {

            return redirect('logins')->with('fail-login','Tài khoản hoặc mật khẩu không đúng');
            
        }
    }

    public function postRegister(RequestRegister $request){

        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        $data['level'] = 1 ;

        $checkEmail = User::where('email',$request->email)->first();

        if($checkEmail){
            return redirect()->back()->with('fail','Tài khoản đã tồn tại ,Vui lòng nhập tài khoản khác');
        }else {
            $result = User::create($data);
        
            if($result) {
                return redirect()->back()->with('success','Đăng Kí Thành Công!');
            }else {
                return redirect()->back()->with('fail','Đăng Kí Thất Bại !');
            }
        }
        

    }

    public function postLogout(Request $request){

        $request->session()->forget('email');
        return redirect('logins');
    }

    public function getSendMailReset(Request $request){
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

        return view('frontend.member.send_mail_reset',compact('get_article_menu','get_category_footer','get_introduce','product_menu','meta_desc','meta_keywords','meta_title','url_canonical'));

    }

    public function postSendMailReset(Request $request){
        $email = $request->email;

        $checkUser = User::where('email',$email)->where('level',1)->first();

        if(!$checkUser){
            return redirect()->back()->with('danger','Email không tồn tại !! Vui lòng đăng kí email để tiếp tục sử dung');
        }

        $code = md5(time().$email);

        $checkUser->code = $code ;
        $checkUser->time_code = Carbon::now();
        
        $result = $checkUser->save();

        $url_2 = route('get.reset-password',['code' => $checkUser->code,'email'=>$email]);

        $data = [
            'route' => $url_2
        ];

        $str = "Email lấy lại mật khẩu đã được gửi thành công \n Vui lòng kiểm tra email !";
        $str_fail = "Bạn đã thêm thất bại";
        $url = "reset-password";

        if($result){
            self::sendMail($email,$data);
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }


    }

    public function getFormReset(Request $request){

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

        $code = $request->code;

        $email = $request->email;

        $checkUser = User::where([
            'code' => $code ,
            'email' => $email
        ])->first();

        if(!$checkUser){
            return redirect()->back()->with('danger','Xin lỗi ! Đường dẫn lấy lại mật khẩu không đúng .');
        }

        return view('frontend.member.reset',compact('get_category_footer','get_article_menu','email','product_menu','get_introduce','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function postFormReset(RequestResetPass $request){
        $code = $request->code;
        $email = $request->email;

        $checkUser = User::where([
            'code' => $code ,
            'email' => $email
        ])->first();

        if(!$checkUser){
            return redirect()->back()->with('danger','Xin lỗi ! Đường dẫn lấy lại mật khẩu không đúng .');
        }

        $checkUser->password = bcrypt($request->password);

        $result = $checkUser->save();

        $str = "Mật khẩu đã được đổi thành công";
        $str_fail = "Bạn đã thêm thất bại";
        $url = "logins";

        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return view('uploadFileFail',compact('str_fail','url'));
        }

    }


    public function sendMail($mail,$data){

        Mail::to($mail)->send(new sendMailResetPassword($data));

    }
    // public function postLogin(RequestLogin $request){

    //     $email = $request->email;

    //     $password = $request->password;

    //     $data = [
    //         'email' => $email,
    //         'password' => $password,
    //         'level' => 1
    //     ];

    //     if(Auth::attempt($data, false)){

    //         return redirect('/');

    //     }else {

    //         return redirect()->back();

    //     }
    // }

    // public function postRegister(RequestRegister $request){

    //     $role_id = CoreRole::where('name','Khách')->get(['role_id'])->toArray()[0]['role_id'];

    //     $data = $request->all();

    //     $data['password'] = bcrypt($request->password);

    //     $data['role_id'] = $role_id ;


    // }

   
}
