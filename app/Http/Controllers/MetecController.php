<?php
namespace App\Http\Controllers\UserAuth;
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Category;
use App\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Meticpost;
use App\Meticcomment;

class MetecController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');        
    } 
    
    public function index(Request $request)
    {       
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
        $mps = Meticpost::where($conditions)->orderBy('id','desc')->paginate(25);
        $comment = array();
        foreach($mps as $mp){
           $comment_count =  Meticcomment::where('meticpost_id',$mp->id)->latest()->count();
           $comments[$mp->id][] =  $comment_count;
        }
        return view('user.metec.index', compact('mps','cats','ca_id','keyword','comments'));
    } 
    
    public function userpost(Request $request)
    {
        $type = 2;
        $mps = Meticpost::where('type',$type)->where('user_id',Auth::guard('user')->user()->id)->orderBy('id','desc')->paginate(25);
        $cats = Category::getList(); 
        return view('user.metec.mypost', compact('mps','cats'));
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
            $mpost = Meticpost::create($mp);
            if($request->hasFile('picture')) {
                $mpost->picture_file = $request->picture->store('metec/pictures');
                $mpost->save();
            }
            if($request->hasFile('video')) {
                $mpost->video_file = $request->video->store('metec/videos');
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
        $mp = Meticpost::findOrFail($id);        
        $comments = Meticcomment::where('meticpost_id',$id)->orderBy('id','asc')->get();
        //dd($comments); exit;
        return view('user.metec.show', compact('mp','comments'));
    }
    
    public function submitcomment(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);
        
        try{
            $mp = $request->all();
            $mp['meticpost_id'] = $id;            
            $mp['user_id'] = Auth::guard('user')->user()->id;
            Meticcomment::create($mp);
            return back()->with('flash_success', 'You comment has been posted successfully');
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    } 
    
    public function metecupdate($id)
    {
        try {
            $info = Meticpost::FindOrFail($id);
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
    public function metecdelete($id)
    {
        try {
            $info = Meticpost::FindOrFail($id);
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
        $mp = Meticpost::findOrFail($id);
        $cats = Category::getList();           
        return view('user.metec.edit',compact('mp','cats'));        
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
            $mp = Meticpost::findOrFail($id);
            $mp->title = $request->title;
            $mp->description = $request->description;               
            $mp->save();
            if($request->hasFile('picture')) {
                $mp->picture_file = $request->picture->store('metec/pictures');
                $mp->save();
            }
            if($request->hasFile('video')) {
                $mp->video_file = $request->video->store('metec/videos');
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
            $mp = Meticcomment::findOrFail($id);
            if ($mp->meticpost->user_id == Auth::guard('user')->user()->id && $mp->meticpost->correctans == 0)
            {      
                $mpinfo = Meticpost::findOrFail($mp->meticpost_id);
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
