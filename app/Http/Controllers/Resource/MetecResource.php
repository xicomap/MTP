<?php

namespace App\Http\Controllers\Resource;

use App\Category;
use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Meticpost;

class MetecResource extends Controller
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
        $heading = "Metec Post";
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
        
        $posts = Meticpost::where($conditions)->orderBy('created_at' , 'desc')->get();
        return view('admin.metec.index', compact('posts','type','heading','cats','ca_id','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::getList(); 
        return view('admin.metec.create',compact('cats'));
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
            $mpost = Meticpost::create($mp);
            if($request->hasFile('picture')) {
                $mpost->picture_file = $request->picture->store('metec/pictures');
                $mpost->save();
            }
            if($request->hasFile('video')) {
                $mpost->video_file = $request->video->store('metec/videos');
                $mpost->save();
            }
            return redirect()->route('admin.metec.index',['type'=>1])->with('flash_success','Post has been added successfully');
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
            $category = Meticpost::findOrFail($id);
            return view('admin.metec.metec-details', compact('category'));
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
            $mp = Meticpost::findOrFail($id);
            $cats = Category::getList(); 
            $heading = "Update Post";
            return view('admin.metec.edit',compact('mp','cats','heading'));
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
            $mp = Meticpost::findOrFail($id);          
            $mp->title = $request->title;
            $mp->description = $request->description;
            $mp->status = $request->status;
            $mp->metec_id = $request->metec_id;
            $mp->save();
            if($request->hasFile('picture')) {
                $mp->picture_file = $request->picture->store('metec/pictures');
                $mp->save();
            }
            if($request->hasFile('video')) {
                $mp->video_file = $request->video->store('metec/videos');
                $mp->save();
            }
            return redirect()->route('admin.metec.index',['type'=>$mp->type])->with('flash_success', 'Post has been updated successfully');
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
            Meticpost::find($id)->delete();
            return back()->with('message', 'Post has been deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
}
