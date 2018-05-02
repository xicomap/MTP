<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Faq;

class FaqResource extends Controller
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
        $faqs = Faq::orderBy('created_at' , 'desc')->get();
        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
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
            'question' => 'required|max:255',                       
            'answer' => 'required',                       
        ]);

        try{
            $faq = $request->all();                                  
            $faq = Faq::create($faq);
            return back()->with('flash_success','Faq has been added successfully');
        } 
        catch (Exception $e) {
			echo $e->getMessage(); exit;
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
            $mp = Faq::findOrFail($id);
            return view('admin.faq.faq-details', compact('mp'));
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
            $mp = Faq::findOrFail($id);
            return view('admin.faq.edit',compact('mp'));
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
            'question' => 'required|max:255',                       
            'answer' => 'required',                                
        ]);

        try {
            $mp = Faq::findOrFail($id);            
            $mp->question = $request->question;
            $mp->answer = $request->answer;
            $mp->save();
            return redirect()->route('admin.faq.index')->with('flash_success', 'Faq has been updated successfully');
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
            Faq::find($id)->delete();
            return back()->with('message', 'Faq has been deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
}
