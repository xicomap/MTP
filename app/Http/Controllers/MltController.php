<?php
namespace App\Http\Controllers\UserAuth;
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Category;
use App\Idea;
use App\Mltsetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Mltpost;
use App\Mltcomment;
use App\AdminSetting;
use App\AdminFootercontent;

class MltController extends Controller
{
    public function __construct()
    {
        $this->middleware('user',['except'=>['home']]);        
    } 
    
    public function home(Request $request)
    {       
        $admin_script = AdminSetting::all();
        $settings = Mltsetting::find(1);     
        $footercontent = AdminFootercontent::where('id',1)->first();  
        return view('user.mlt.home', compact('settings','admin_script','footercontent'));
    } 
    
    public function index(Request $request)
    {   
         $admin_script = AdminSetting::all();    
        $keyword = ""; $ca_id = ""; $conditions = array(); $conditions[] = ['status',1];
        if ($request->query('ca_id') != null) {
            $ca_id = $request->query('ca_id');
            $conditions[] = ['category_id',$ca_id];
        }
        if ($request->query('keyword') != null) {
            $keyword = $request->query('keyword');
            $conditions[] = ['title','like','%'.$keyword.'%'];
        }
        $cats = Category::getList();         
        $mps = Mltpost::where($conditions)->orderBy('id','desc')->paginate(25);
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.mlt.index', compact('mps','cats','ca_id','keyword','admin_script','footercontent'));
    } 
    
    public function userpost(Request $request)
    {
         $admin_script = AdminSetting::all();
        $type = 2;
        $mps = Mltpost::where('type',$type)->where('user_id',Auth::guard('user')->user()->id)->orderBy('id','desc')->paginate(25);
        $cats = Category::getList(); 
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.mlt.mypost', compact('mps','cats','admin_script','footercontent'));
    }      
    
    public function submitpost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'video' => 'mimes:mp4|max:10000',  
            'picture' => 'mimes:jpg,jpeg,bmp,png|max:2048',  
        ]);
        
        try{
            $mp = $request->all();
            $mp['type'] = 2;
            $mp['status'] = 0;
            $mp['user_id'] = Auth::guard('user')->user()->id;
            $mpost = Mltpost::create($mp);
            if($request->hasFile('picture')) {
                $mpost->picture_file = $request->picture->store('mlt/pictures');
                $mpost->save();
            }
            if($request->hasFile('video')) {
                $mpost->video_file = $request->video->store('mlt/videos');
                $mpost->save();
            }
            return back()->with('flash_success', 'Post has been added successfully');
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    } 
    
    public function show($id)
    {
         $admin_script = AdminSetting::all();
        $mp = Mltpost::findOrFail($id);        
        $comments = Mltcomment::where('mltpost_id',$id)->orderBy('id','asc')->get();
        $footercontent = AdminFootercontent::where('id',1)->first();
        //dd($comments); exit;
        return view('user.mlt.show', compact('mp','comments','admin_script','footercontent'));
    }
    
    public function submitcomment(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);
        
        try{
            $mp = $request->all();
            $mp['mltpost_id'] = $id;            
            $mp['user_id'] = Auth::guard('user')->user()->id;
            Mltcomment::create($mp);
            return back()->with('flash_success', 'You comment has been posted successfully');
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    } 
    
    public function mltupdate($id)
    {
        try {
            $info = Mltpost::FindOrFail($id);
            if ($info->user_id == Auth::guard('user')->user()->id)
            {
                $info->status = 3;
                $info->save();
                return back()->with('flash_success', 'Status has been updated successfully');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }
    public function mltdelete($id)
    {
        try {
            $info = Mltpost::FindOrFail($id);
            if ($info->user_id == Auth::guard('user')->user()->id)
            {                
                $info->delete();
                return back()->with('flash_success', 'Post has been deleted');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }
    
    public function editpost($id)
    {        
        $mp = Mltpost::findOrFail($id);
        $cats = Category::getList(); 
        $footercontent = AdminFootercontent::where('id',1)->first();          
        return view('user.mlt.edit',compact('mp','cats','footercontent'));        
    }    
    
    public function updatepost(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'video' => 'mimes:mp4|max:10000',
            'picture' => 'mimes:jpg,jpeg,bmp,png|max:2048',  
        ]);
        
        try {
            $mp = Mltpost::findOrFail($id);
            $mp->title = $request->title;
            $mp->description = $request->description;               
            $mp->save();
            if($request->hasFile('picture')) {
                $mp->picture_file = $request->picture->store('mlt/pictures');
                $mp->save();
            }
            if($request->hasFile('video')) {
                $mp->video_file = $request->video->store('mlt/videos');
                $mp->save();
            }
            return back()->with('flash_success', 'Post has been updated successfully');
        }
        
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Error occured. Please try again');
        }
    }
    
    public function updatesol($id)
    {
        try {
            $mp = Mltcomment::findOrFail($id);
            if ($mp->mltpost->user_id == Auth::guard('user')->user()->id && $mp->mltpost->correctans == 0)
            {      
                $mpinfo = Mltpost::findOrFail($mp->mltpost_id);
                $mpinfo->correctans = $id;            
                $mpinfo->save();
                return back()->with('flash_success', 'Thank you for you feedback');
            }
            else {
                return back()->with('flash_error', 'You are not authorize to update');
            }
            
        }        
        catch (ModelNotFoundException $e) {
            echo $e->getMessage();exit;
            return back()->with('flash_error', 'Error occured. Please try again');
        }
    }
}
