<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Article;
use App\CategoryArticle;

class ArticleResource extends Controller
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
        $articles = Article::orderBy('created_at' , 'desc')->get();
        return view('admin.articles.index', compact('articles'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = CategoryArticle::getList();
        return view('admin.articles.create', compact('cats'));
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
            'category_id' => 'required',            
            'description' => 'required',
        ]);
        
        try{
            $product = $request->all();
            $product['admin_id'] = Auth::guard('admin')->user()->id;
            $product['status'] = 1;
            $product['total_comments'] = 0;
            $product['total_views'] = 0;  
            if($request->hasFile('picture')) {                   
                $product['picture'] = $request->picture->store('user/article');               
            }  
         
            $product = Article::create($product);
            return back()->with('flash_success','Article has been added successfully');
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
            $article = Article::findOrFail($id);
            return view('admin.articles.article-details', compact('article'));
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
            $article = Article::findOrFail($id);
            $cats = CategoryArticle::getList();
            return view('admin.articles.edit',compact('article','cats'));
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
        ]);        
        try {
            $product = Article::findOrFail($id);
            $product->title = $request->title;
            $product->description = $request->description;
            $product->category_id = $request->category_id;            
            $product->status = $request->status;
            if($request->hasFile('picture')) {             
                //$product['picture'] = $request->picture->store('user/article');
                $product->picture =  $request->picture->store('user/article');                
            }
            $product->save();
            return redirect()->route('admin.article.index')->with('flash_success', 'Article has been updated successfully');
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
            Article::find($id)->delete();
            return back()->with('message', 'Article has been deleted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
}
