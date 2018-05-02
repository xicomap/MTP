<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Rule;
use App\Branch;
use App\BranchDepartment;
use App\BranchRule;

class RulesResource extends Controller
{
   
    public function __construct()
    {
        
    }    
  
    public function index()
    {
        $rules = Rule::orderBy('created_at' , 'desc')->get();
        return view('admin.rules.index', compact('rules'));
    }
    
   
    public function create()
    {
       $branch = BranchRule::all();
       $department = BranchDepartment::all();

       return view('admin.rules.create',compact('branch','department'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'branch_name' => 'required|max:255',
            'department_name' => 'required',
            'article_number' => 'required',
            'description' => 'required',
            'pdf' => 'required',                    
        ]);
        
        try{
            $rules = $request->all(); 
            if($request->hasFile('pdf')) {
                $rules['pdf'] = $request->pdf->store('user/pdf');
            }  
      
            $rules = Rule::create($rules);
            return back()->with('flash_success','Rule has been posted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }
  
    public function show($id)
    {
        try {
            $rule = Rule::findOrFail($id);
            return view('admin.rules.rule-details', compact('rule'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    
  
    public function edit($id)
    {
        $branch = BranchRule::all();
         $department = BranchDepartment::all();
        try {
            $rule = Rule::findOrFail($id);
            return view('admin.rules.edit',compact('rule','branch','department'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'branch_name' => 'required|max:255',
            'department_name' => 'required',
            'article_number' => 'required',
            'description' => 'required',
            'pdf' => 'required',                    
        ]);
        
        try {
            $tool = Rule::findOrFail($id);
            $tool->branch_name = $request->branch_name;
            $tool->department_name = $request->department_name;
            $tool->article_number = $request->article_number;            
            $tool->description = $request->description;            
            $tool->private = $request->private;
            
            if($request->hasFile('pdf')) {
                $tool->pdf = $request->pdf->store('user/pdf');
            }

            $tool->save();
            return redirect()->route('admin.rule.index')->with('flash_success', 'Rule has been updated successfully');
        }
        
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Error occured. Please try again');
        }
    }
    

    public function destroy($id)
    {
        try {
            Rule::find($id)->delete();
            return back()->with('message', 'Industry has been deleted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }

   
}
