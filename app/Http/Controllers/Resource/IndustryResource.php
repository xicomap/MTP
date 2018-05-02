<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Industry;

class IndustryResource extends Controller
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
        $industries = Industry::orderBy('created_at' , 'desc')->get();
        return view('admin.industries.index', compact('industries'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.industries.create');
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
            'name' => 'required|max:255',
        ]);
        
        try{
            $industry = $request->all();
            $industry = Industry::create($industry);
            return back()->with('flash_success','Industry has been posted successfully');
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
            $industry = Industry::findOrFail($id);
            return view('admin.industries.industry-details', compact('industry'));
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
            $industry = Industry::findOrFail($id);
            return view('admin.industries.edit',compact('industry'));
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
            'name' => 'required|max:255',
        ]);
        
        try {
            $industry = Industry::findOrFail($id);
            $industry->name = $request->name;
            $idea->save();
            return redirect()->route('admin.industry.index')->with('flash_success', 'Industry has been updated successfully');
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
            Industry::find($id)->delete();
            return back()->with('message', 'Industry has been deleted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
}
