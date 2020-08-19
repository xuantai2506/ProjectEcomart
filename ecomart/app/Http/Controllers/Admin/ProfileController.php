<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\DateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\CoreUser;
use App\User;
class ProfileController extends Controller
{
    public function getProfile(){

        $email = Auth::user()->email;

        $get_profile = CoreUser::where('email',$email)->get()->toArray()[0];

        return view('admin.profile.profile',compact('get_profile'));
    }

    public function getUpdateProfile(){

        return redirect('admin/home');
    }
    public function postUpdateProfile(Request $request){

        $profile_user = CoreUser::where('email',Auth::user()->email)->get()->toArray();
        $data = request()->except(['_token']);
        $data = self::checkImages($request,$data,$profile_user);
        $result = CoreUser::where('email',$request->email)->update($data);

        $str = "Bạn đã chỉnh sửa thông tin thành công";
        $str_fail = "Bạn đã chỉnh sửa thông tin thất bại";
        $url = "admin/home";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return redirect('');
        }

    }

    public function getChangePassword(){
        $email = Auth::user()->email;

        $get_profile = CoreUser::where('email',$email)->get()->toArray()[0];

        return view('admin.profile.change_password',compact('get_profile'));
    }

    public function getchangePassword2(){
        return redirect('admin/home');
    }

    public function postChangePassword(Request $request){
        $password_check = Auth::user()->password;

        if(password_verify($request->password2old, $password_check)){

            $email = Auth::user()->email;

            CoreUser::where('email',$email)->update(['password' =>bcrypt($request->password)] );

            $result = User::where('email',$email)->update(['password' => bcrypt($request->password)]);

        }else {
            return redirect('admin/profile');
        }

        $str = "Bạn đã đổi mật khẩu thành công";
        $str_fail = "Bạn đã đổi mật khẩu thất bại";
        $url = "admin/home";
        if($result){
            return view('uploadFileSuccess',compact('str','url'));
        }else {
            return redirect('');
        }
    }

    public function checkImages($request,$data,$database = ''){
        if($request->hasFile('images')){
            $file = $request->images;
            // Tên files (Name)
            $file_name = $file->getClientOriginalName();
            // đuôi file (Extension)
            $file_tail = $file->getClientOriginalExtension();
            // đường dẫn tạm thời
            $file_temp = $file->getRealPath();
            // kích cỡ file
            $file_syze = $file->getSize();
            // Kiểu file 
            $file_type = $file->getMimeType();
            // =----------UPLOAD----------
            $file->move('upload/admin/user', $file_name);
            $data['images'] = $file_name ;
        }else if($database != ''){
            if($database[0]['images'] !== 'no' && isset($database[0]['images']))
            {
                $data['images'] = $database[0]['images'];
            }else {
                $data['images'] = 'no';
            }
            
        }else {
            $data['images'] = 'no';
        }
        return $data;
    }
}
