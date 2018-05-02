<?php

namespace App\Http\Controllers\Resource;

use App\Category;
use App\Mltsetting;
use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Mltpost;

class MltResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->query('type');
        $heading = "Inside MLT";
        if ($type == 2) {
            $heading = "Employee Post";
        }
        $keyword = ""; $ca_id = ""; $conditions = array(); $conditions[] = ['type',$type];
        if ($request->query('ca_id') != null) {
            $ca_id = $request->query('ca_id');
            $conditions[] = ['category_id',$ca_id];
        }
        if ($request->query('keyword') != null) {
            $keyword = $request->query('keyword');
            $conditions[] = ['title','like','%'.$keyword.'%'];
        }
        $cats = Category::getList(); 
        
        $posts = Mltpost::where($conditions)->orderBy('created_at' , 'desc')->get();
        return view('admin.mlt.index', compact('posts','type','heading','cats','ca_id','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::getList(); 
        return view('admin.mlt.create',compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required'
        ]);

        try{
            $mp = $request->all();           
            $mp['type'] = 1;
            $mp['status'] = 1;
            $mp['admin_id'] = Auth::guard('admin')->user()->id;
            $mpost = Mltpost::create($mp);
            if($request->hasFile('picture')) {
                $mpost->picture_file = $request->picture->store('mlt/pictures');
                $mpost->save();
            }
            if($request->hasFile('video')) {
                $mpost->video_file = $request->video->store('mlt/videos');
                $mpost->save();
            }
            return redirect()->route('admin.mlt.index',['type'=>1])->with('flash_success','Post has been added successfully');
        } 
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = Mltpost::findOrFail($id);
            return view('admin.mlt.mlt-details', compact('category'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $mp = Mltpost::findOrFail($id);
            $cats = Category::getList(); 
            $heading = "Update Post";
            return view('admin.mlt.edit',compact('mp','cats','heading'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required'
        ]);

        try {
            $mp = Mltpost::findOrFail($id);          
            $mp->title = $request->title;
            $mp->description = $request->description;
            $mp->status = $request->status;
            $mp->mlt_id = $request->mlt_id;
            $mp->save();
            if($request->hasFile('picture')) {
                $mp->picture_file = $request->picture->store('mlt/pictures');
                $mp->save();
            }
            if($request->hasFile('video')) {
                $mp->video_file = $request->video->store('mlt/videos');
                $mp->save();
            }
            return redirect()->route('admin.mlt.index',['type'=>$mp->type])->with('flash_success', 'Post has been updated successfully');
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Error occured. Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        try {
            Mltpost::find($id)->delete();
            return back()->with('message', 'Post has been deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function pagesetup()
    {
        try {
            $mp = Mltsetting::findOrFail(1);
            return view('admin.mlt.pagesetup',compact('mp'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatepage(Request $request)
    {
        $this->validate($request, [            
            'description' => 'required'
        ]);
        
        try {
            $mp = Mltsetting::findOrFail(1);           
            $mp->description = $request->description;            
            $mp->save();
            if($request->hasFile('picture')) {
                $mp->picture_file = $request->picture->store('mlt/banners');
                $mp->save();
            }            
            return redirect()->route('admin.mlt.pagesetup')->with('flash_success', 'Page has been updated successfully');
        }
        
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Error occured. Please try again');
        }
    }
}
