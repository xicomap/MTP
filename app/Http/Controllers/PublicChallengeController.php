<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Idea;
use App\PublicChallenge;

class PublicChallengeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(Request $request) {
        
        $pcs = PublicChallenge::orderBy('id','desc')->get();
        return view('admin.publicchallenges.index', compact('pcs'));
    }
    
    public function show(Request $request) { 
       
        $pc = PublicChallenge::orderBy('id','desc')->first();
        return view('admin.publicchallenges.show', compact('pc'));
    }       
    
    public function destroy($id)
    {       
        try {
            PublicChallenge::find($id)->delete();
            return back()->with('message', 'Record has been deleted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
    
    public function update($id, Request $request)
    {
        try {
            $pc = PublicChallenge::findOrFail($id);
            if ($request->status == 1)
            {                
                $idea = array();
                $idea['admin_id'] = Auth::guard('admin')->user()->id;
                $idea['type'] = 2;
                $idea['publish'] = 0;
                $idea['active'] = 0;
                $idea['approve'] = 0;
                $idea['title'] = $pc->title;
                $idea['description'] = $pc->description;
                $ids = Idea::create($idea); 
                $pc->delete();
                return redirect()->route('admin.idea.edit',$ids->id)->with('flash_success', 'Public challange has been approved successfully');
            }
            else
            {
                $pc->status = $request->status;
                $pc->save();
                return back()->with('flash_success', 'Staus has been updated successfully');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Error occured.. Please try again');
        }
    }
}
