<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\AdminSetting;
class PageController extends Controller
{
    public function index(Request $request, $type) {     
        
        $static = Page::where('slug', $type)->first();  
         $admin_script = AdminSetting::all();     
        if( $static ){  
            //$static = $static['0'];
            return view('user.static', compact('static','admin_script'));
        }else{           
            return response()->json(['error' => trans('Invalid URL')], 400);            
        }      
    }
}
