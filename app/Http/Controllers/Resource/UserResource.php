<?php

namespace App\Http\Controllers\Resource;

use App\User;
use App\UserRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use App\Mail\AccountApprovalMail;
use App\PublicInvitation;

class UserResource extends Controller
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
        $users = User::orderBy('created_at' , 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'mobile' => 'digits_between:6,20',            
        ]);

        try{
           
            $user = $request->all();
            //print_r($user); exit;
            $user['password'] = bcrypt($request->password);
            $user['status'] = 1;
            $user['user_type'] = $request->user_type;
            
            if($request->hasFile('picture')) {
                $user['picture'] = $request->picture->store('user/profile');
            }
            if ($request->dob != "") {
             $user['dob'] =  Helper::convertDate($request->dob);
            }
            $user = User::create($user);
            return back()->with('flash_success','User Details Saved Successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'User Not Found');
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
            $user = User::findOrFail($id);
            return view('admin.users.user-details', compact('user'));
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
            $user = User::findOrFail($id);
            return view('admin.users.edit',compact('user'));
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
            'mobile' => 'digits_between:6,13',           
        ]);

        try {
            $user = User::findOrFail($id);
            if($request->hasFile('picture')) {
                Storage::delete($user->picture);
                $user->picture = $request->picture->store('user/profile');
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->mobile = $request->mobile;
            $user->status = intval($request->status);
            $user->sex = $request->sex;
            $user->description = $request->description;
            $user->user_type = $request->user_type;
            if ($request->dob != "") {
                $user->dob = Helper::convertDate($request->dob);
            }
            $user->save();
            if (request()->getHttpHost() != "localhost") {
                Mail::to($user->email)->send(new AccountApprovalMail($user));
            }
            return redirect()->route('admin.user.index')->with('flash_success', 'User Updated Successfully');
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'User Not Found');
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

            User::find($id)->delete();
            return back()->with('message', 'User deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'User Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function request($id){

        try{

            $requests = UserRequests::where('user_requests.user_id',$id)
                    ->RequestHistory()
                    ->get();

            return view('admin.request.index', compact('requests'));
        }

        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }

    }
    
    public function submit_invites(Request $request)
    {       
        try{
            $user = $request->all();
            if (count($user['ids']) <=0 || $user['action'] == "") {
                return back()->with('flash_error', 'Please select atleast one user and action below');
            }
            $ids = $user['ids'];
            $action = $user['action'];
            if ($action == "invite")
            {
                for($i=0; $i<(count($ids)); $i++)
                {
                    $check = PublicInvitation::where('user_id',$ids[$i])->count();
                    if ($check == 0)
                    {
                        $us = array();
                        $us['user_id'] = $ids[$i];
                        PublicInvitation::create($us);
                    }
                }
                return back()->with('flash_success', 'User(s) have been invited successfully');
            }
        }
        catch (Exception $e) {            
            //dd($e->getMessage());
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }    
    }

}
