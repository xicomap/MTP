<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use App\Admin;

class AdminResource extends Controller
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
        $admins = Admin::where('id','!=',1)->orderBy('created_at' , 'desc')->get();
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:users,email|email|max:255',           
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required',
        ]);

        try{
            $admin = $request->all();
            //print_r($user); exit;
            $admin['password'] = bcrypt($request->password);
            $admin['status'] = 1;  
            
            $admin = Admin::create($admin);
            return back()->with('flash_success','Admin has been saved successfully');
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
            $admin = Admin::findOrFail($id);
            return view('admin.admins.admin-details', compact('admin'));
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
            $admin = Admin::findOrFail($id);
            return view('admin.admins.edit',compact('admin'));
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',             
        ]);

        try {
            $admin = Admin::findOrFail($id);            
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;            
            $admin->status = $request->status;            
            $admin->role_id = $request->role_id;
            $admin->status = intval($request->status);
            $admin->save();
            return redirect()->route('admin.admin.index')->with('flash_success', 'Admin Updated Successfully');
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Admin Not Found');
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

            Admin::find($id)->delete();
            return back()->with('message', 'Admin deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Admin Not Found');
        }
    }


}
