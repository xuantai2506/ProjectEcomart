<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article_menu;
use App\Models\Article;
use App\Models\Product_menu;

class FooterController extends Controller
{	
	public function get_introduce(){
		return Article_menu::where('category_id',10)->where('is_active',1)->OrderBy('sort','ASC')->get()->toArray()[0];
	}

    public function get_tutorial(){
    	return Article_menu::where('category_id',5)->where('is_active',1)->OrderBy('sort','ASC')->get();
    }

    public function get_policy(){
    	return Article_menu::where('category_id',6)->where('is_active',1)->OrderBy('sort','ASC')->get();
    }

    public function product_menu(){
    	return Product_menu::where('parent',0)->where('is_active',1)->OrderBy('sort','ASC')->get(); 
    }
}
