<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Category;
use App\CategoryTool;
use App\Tool;

class ToolResource extends Controller
{
    
    public function __construct()
    {
        
    }
 
    public function index()
    {
       $tools = Tool::orderBy('id' , 'desc')->get();      
       return view('admin.tools.index',compact('tools'));
    }
    
 
    public function create()
    {
        $cats = CategoryTool::getList(); 
        return view('admin.tools.create',compact('cats'));
    }
  
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'pdf' => 'required',                    
        ]);

        
        try{
            $tool = $request->all(); 
            if($request->hasFile('pdf_link')) {
                $tool['pdf'] = $request->picture->store('user/pdf');
            }  
      
            $tool = Tool::create($tool);
            return back()->with('flash_success','Tool has been posted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }
   
    public function show($id)
    {
        try {
            $tool = Tool::findOrFail($id);
            return view('admin.tools.tool-details', compact('tool'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    
    
    public function edit($id)
    {
        try {
            $tool = Tool::findOrFail($id);            
            $cats = CategoryTool::getList();
            return view('admin.tools.edit',compact('tool','cats'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required',
            
        ]);
        
        try {
            $tool = Tool::findOrFail($id);
            $tool->title = $request->title;
            $tool->description = $request->description;
            $tool->category_id = $request->category_id;            
            $tool->private = $request->private;
            
            if($request->hasFile('pdf')) {
                $tool->pdf = $request->pdf->store('user/pdf');
            }

            $tool->save();
            return redirect()->route('admin.tool.index')->with('flash_success', 'Tool has been updated successfully');
        }
        
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Error occured. Please try again');
        }
    }
    
   
    public function destroy($id)
    {
        try {
            Tool::find($id)->delete();
            return back()->with('message', 'Tool has been deleted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
}
