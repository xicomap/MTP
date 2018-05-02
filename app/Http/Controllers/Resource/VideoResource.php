<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Video;
use App\CategoryVideo;

class VideoResource extends Controller
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
    public function index()
    {
        $videos = Video::orderBy('created_at' , 'desc')->get();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = CategoryVideo::getList(); 
        $featured_video = Video::marked();
        return view('admin.videos.create', compact('cats','featured_video'));
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
            'embd_code' => 'required',   
            'description' => 'required',   
        ]);

        try{           
            $product = $request->all();            
            $product['admin_id'] = Auth::guard('admin')->user()->id;    
            $product['status'] = 1;
            $product['total_comments'] = 0;
            $product['total_views'] = 0;
            $product = Video::create($product);
            return back()->with('flash_success','Video has been added successfully');
        } 
        catch (Exception $e) {
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
            $video = Video::findOrFail($id);
            return view('admin.videos.video-details', compact('video'));
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
            $video = Video::findOrFail($id);
            $cats = CategoryVideo::getList(); 
            $featured_video = Video::marked();
            if(!empty($featured_video))
            {
                $featured_video_id = $featured_video->id;
                if($featured_video_id  == $id)
                {
                    $featured_videod = "";
                }else
                {
                    $featured_video = $featured_video;
                }
            }
            
            
            return view('admin.videos.edit',compact('video','cats','featured_video'));
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
        ]);

        try {
            $product = Video::findOrFail($id);            
            $product->title = $request->title;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->embd_code = $request->embd_code;
            $product->is_private = $request->is_private;
            $product->is_featured = $request->is_featured;
            $product->status = $request->status;
            $product->save();
            return redirect()->route('admin.video.index')->with('flash_success', 'Video has been updated successfully');
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
            Video::find($id)->delete();
            return back()->with('message', 'Video has been deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
}
