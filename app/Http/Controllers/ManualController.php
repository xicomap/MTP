<?php
namespace App\Http\Controllers\UserAuth;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Manual;
use App\Helpers\Helper;
use App\Category;

class ManualController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');        
    }
    
    public function index(Request $request)
    {       
        $keyword = ""; $cid = ""; $conditions = array(); 
        if ($request->query('cid') != null) {
            $cid = $request->query('cid');
            $conditions[] = ['category_id',$cid];
        }
        if ($request->query('keyword') != null) {
            $keyword = $request->query('keyword');
            $conditions[] = ['title','like','%'.$keyword.'%'];
        }
        $type = $request->query('type');
        if ($type == "")
        {
            $type = 1;
        }
        $heading = Helper::getManualName($type);
        $manuals = Manual::where($conditions)->where('type',$type)->get();
        $cats = Category::getList();
        return view('user.manual.index', compact('heading','type','manuals','cats','cid','keyword'));
    }  
    
    
}
