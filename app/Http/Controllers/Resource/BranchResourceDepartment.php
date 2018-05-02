<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\BranchRule;
use App\BranchDepartment;

class BranchResourceDepartment extends Controller
{
   
    public function __construct()
    {
       
    }
 
    public function index()
    {
       
        $categories = BranchDepartment::orderBy('created_at' , 'desc')->get();
        return view('admin.branche-department.index', compact('categories'));
    }

   
    public function create()
    {
        $categories = BranchRule::orderBy('created_at' , 'desc')->get();
      
        return view('admin.branche-department.create', compact('categories'));
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
            'branch_id' => 'required', 
            'name' => 'required',                       
        ]);

        try{
            $category = $request->all();                                  
            $category = BranchDepartment::create($category);
            return back()->with('flash_success','Category has been posted successfully');
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
            $category = BranchDepartment::findOrFail($id);
            return view('admin.branche-department.branch-details', compact('category'));
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
            $category = BranchDepartment::findOrFail($id);
            $categories = BranchRule::orderBy('created_at' , 'desc')->get();
            return view('admin.branche-department.edit',compact('category','categories'));
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
            'branch_id' => 'required',
            'name' => 'required',                         
        ]);

        try {
            $category = BranchDepartment::findOrFail($id);            
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.departmemnt.index')->with('flash_success', 'Category has been updated successfully');
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
            BranchDepartment::find($id)->delete();
            return back()->with('message', 'Category has been deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
}
