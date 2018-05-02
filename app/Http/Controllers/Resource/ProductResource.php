<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Product;
use App\CategoryProduct;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class ProductResource extends Controller
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
        $products = Product::orderBy('created_at' , 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = CategoryProduct::getList(); 
        return view('admin.products.create', compact('cats'));
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
            'category_id' => 'required|max:255', 
            'description' =>  'required',
            'picture' =>  'required',
            'pdf_link' =>  'required',
        ]);

        try{           
            
            $product = $request->all();
            $product['admin_id'] = Auth::guard('admin')->user()->id;
            if($request->hasFile('picture')) {
                $product['picture'] = $request->picture->store('user/product');
            }

            if($request->hasFile('pdf_link')) {
                $product['pdf_link'] = $request->picture->store('user/pdf');
            }
           
          
            $product['total_views'] = 0;
            $product['url'] = #;  
             
         
            $product = Product::create($product);
             //$product->save();
            return back()->with('flash_success','Product has been added successfully');
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
            $product = Product::findOrFail($id);
            return view('admin.products.product-details', compact('product'));
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
            $product = Product::findOrFail($id);
            $cats = CategoryProduct::getList(); 
            return view('admin.products.edit',compact('product','cats'));
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
            $product = Product::findOrFail($id);            
            $product->title = $request->title;
            $product->description = $request->description;
            $product->category_id = $request->category_id;

            if($request->hasFile('picture')) {             
               
                //$product['picture'] = $request->picture->store('user/article');
                $product->picture =  $request->picture->store('user/product');                
            }
            $product->is_featured = $request->is_featured;
             if($request->hasFile('pdf_link')) {
                $product['pdf_link'] = $request->picture->store('user/pdf');
            }

            $product->save();
            return redirect()->route('admin.product.index')->with('flash_success', 'Product has been updated successfully');
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
            Product::find($id)->delete();
            return back()->with('message', 'Product has been deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }


    public function productMail(Request $request) 
    {
		$this->validate($request, [          
            'captcha' => 'required|captcha'
        ]);
        $input =  Input::all();
        $email = $input['send_mail'];
        $product_id = $input['product_id'];
        $product_detail = Product::productDetail($product_id);
        //"xicomtest11@gmail.com"

       

         Mail::send('emails.product', ["data" => $product_detail], function ($message) use ($email){
                                        $message->from('no-reply@threat.com', "METIP");
                                        $message->to($email)->subject('Product Details');
         });

         return back()->with('message', 'Mail has been sent successfully');
       
    }
}
