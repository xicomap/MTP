<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Exception;

class ContactController extends Controller
{
    public function index() {
        return view('user.contact');
    }
    
    public function submit_contact(Request $request)
    {        
        $this->validate($request, [            
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'subject' => 'required',
            'message' => 'required',
        ]);
        
        try {
            $contact = new Contact;
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();    
            return redirect('contact')->with('flash_success',"Thank you for your request. We will get back to you soon.");
        } catch (Exception $e) {
            return response()->json(['error' => trans('Oops.. error occured. Please try later')], 500);
        }
    }
}
