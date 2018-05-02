<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{
    public function index(Request $request) {     
        
        $faqs = Faq::get();       
        if( $faqs ){  
            //$static = $static['0'];
            return view('user.faq', compact('faqs'));
        }else{           
            return response()->json(['error' => trans('Invalid URL')], 400);            
        }      
    }
}
