<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Manual;
use App\Category;
use App\Industry;

class ManualResource extends Controller
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
        if ($type == "" || $type > 3) {
            $type = 1;
        }
        $heading = helper::getManualName($type);        
        $manuals = Manual::where('type',$type)->orderBy('created_at' , 'desc')->get();
        return view('admin.manuals.index', compact('manuals','type','heading'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->query('type');
        if ($type == "" || $type > 3) {
            $type = 1;
        }        
        $cats = Category::getList(); 
        $inds = Industry::getList(); 
        $heading = helper::getManualName($type);    
        return view('admin.manuals.create', compact('type','heading','cats','inds'));
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
            'description' => 'required',
            'type' => 'required',
            'attach' => 'required'
        ]);

        try{
            $manual = $request->all();            
            $manual['admin_id'] = Auth::guard('admin')->user()->id;             
            $manual = Manual::create($manual);
            if($request->hasFile('attach')) {
                $manual->picture = $request->attach->store('mlt/manuals');
                $manual->save();
            }
            $heading = helper::getManualName($request->type); 
            return back()->with('flash_success',$heading.' has been created successfully');
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
            $manual = Manual::findOrFail($id);
            return view('admin.manuals.manual-details', compact('manual'));
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
            $manual = Manual::findOrFail($id);          
            $heading = helper::getManualName($manual->type);    
            $cats = Category::getList();
            $inds = Industry::getList(); 
            return view('admin.manuals.edit',compact('manual','heading','cats','inds'));
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
            'description' => 'required',             
        ]);

        try {
            $manual = Manual::findOrFail($id);            
            $manual->title = $request->title;
            $manual->description = $request->description;            
            $manual->category_id = $request->category_id;  
            $manual->save();
            if($request->hasFile('attach')) {
                $manual->picture = $request->attach->store('mlt/manuals');
                $manual->save();
            }
            return redirect('/admin/manual?type='.$manual->type)->with('flash_success', 'Record updated successfully');
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
            Manual::find($id)->delete();
            return back()->with('message', 'Record has been deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
}
