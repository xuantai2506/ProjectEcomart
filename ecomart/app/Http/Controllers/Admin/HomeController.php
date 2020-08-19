<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Online;
use App\Models\OnlineDaily;
use App\Http\Controllers\DateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\CoreUser;
use App\User;

class HomeController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request,$month = '')
    {

        $count_access = 0 ;

        $online_daily = OnlineDaily::pluck('count')->toArray();

        foreach($online_daily as $counts){

            $count_access = $count_access + $counts;

        }

        return view('admin.index',compact('count_access','month'));
    }
    // xử lý truyền về js
    public function getAllMonthCount(){
        
        $month = $_POST['month'];

        $day_count = [];

        $day = [];

        $count = [];
        // khi khách hàng lựa chọn xem theo từng tháng
        if($month !== '') {

            $month = $month ;

        }else {

            $expires = new \DateTime('NOW');

            $month = $expires->format('y-m');

        }

        $online_daily = OnlineDaily::where('created_at','like','%'.$month.'%')->get()->toArray();

        foreach($online_daily as $online_dailies){

            $days = date('d-m', strtotime($online_dailies['created_at']));

            array_push($count,$online_dailies['count']);

            array_push($day,$days);

        }

        array_push($day_count,$day,$count);

        return $day_count;
        
    }

    
   
}
