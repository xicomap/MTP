<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Idea;
use App\User;
use App\Helpers\Helper;
use App\PublicInvitation;
use App\Branch;
use App\AdminFootercontent;

class UserController extends Controller
{
    public function __construct()
    {                
        $this->middleware('web');
    }
    
    public function home() {  
        
        $user = Auth::guard('user')->user();
        return view('user.home', compact('user'));
    }
    
    public function profile() {
        $userinfo = Auth::guard('user')->user();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.profile', compact('userinfo','footercontent'));
    }
    
    public function addpost() {
        $checkinv = PublicInvitation::where('user_id',Auth::guard('user')->user()->id)->count();
         $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.addpost', compact('checkinv','footercontent'));
    }
    
    public function create_post(Request $request) {       
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'type' => 'required'
        ]);
        
        try{
            $post = $request->all();
            $post['admin_id'] = 0;  
            $post['type'] = 2;
            $post['user_id'] = Auth::guard('user')->user()->id;            
            $post = Idea::create($post);            
            return back()->with('flash_success','Post has been sent to the admin.');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }
    
    public function edit_profile() {
        $user = Auth::guard('user')->user();   
        $bchs = Branch::getList();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.edit_profile', compact('user','bchs','footercontent'));       
    }
    
    public function update(Request $request) {
        $id = Auth::guard('user')->user()->id;
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'digits_between:6,13',  
            'kebel' => 'mimes:doc,docx,txt,pdf|max:2048',  
            'cv' => 'mimes:doc,docx,txt,pdf|max:2048',  
        ]);
        
        try {
            $user = User::findOrFail($id);
            if($request->hasFile('kebel')) {
                Storage::delete($user->kebel);
                $user->kebel_id = $request->kebel->store('user/kebels');
            }
            if($request->hasFile('cv')) {
                Storage::delete($user->cv);
                $user->cv = $request->cv->store('user/cvs');
            }
            if($request->hasFile('profilepic')) {
                Storage::delete($user->profilepic);
                $user->picture = $request->profilepic->store('user/pictures');
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->mobile = $request->mobile;           
            $user->sex = $request->sex;
            if ($request->description != "") {
                $user->description = $request->description;
            }
            if ($request->org_type != "") {
                $user->org_type = $request->org_type;
            }
            if ($request->position != "") {
                $user->position = $request->position;
            }           
            if ($request->dob != "") {
                $user->dob = Helper::convertDate($request->dob);
            }
            $user->save();           
            return back()->with('flash_success', 'Your profile updated Successfully');
        }
        
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'User Not Found');
        }
        return back()->with('flash_success', 'Your profile has been updated successfully');        
    }
}
