<?php

namespace App\Http\Controllers\UserAuth;

use App\User;
use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\AdminEmailSetting;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home/thanks';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'required|max:15',
            'user_type' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'kebel' => 'mimes:doc,docx,txt,pdf|max:5120',  
            'cv' => 'mimes:doc,docx,txt,pdf|max:5120'            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data,$kebel_id,$cv)
    {
        
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'user_type' => $data['user_type'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'kebel_id' => $kebel_id,
            'cv' => $cv,
        ]); 
       
       $user_first_name = $data['first_name'];
       $user_email = $data['email'];


        $user_type = $data['user_type'];
        if($user_type == 1 || $user_type == 2 || $user_type == 3 || $user_type == 4)
        {
            //Compitetion Sponsor, Investor,METEC Employees
            $usertype = AdminEmailSetting::where('type',$user_type)->get()->pluck('name');
            $usertype = $usertype[0];
            $subject = "Registration";
       
            //Innovation
            $message = AdminEmailSetting::where('name','Innovation Admin')->get()->pluck('message');
            $message = $message[0];

            $innovation_admin = $admin = Admin::where('role_id',2)->get()->toArray();
            if(!empty($innovation_admin))
            {
                foreach($innovation_admin as $innovation)
                {
                    $innovation_email = $innovation['email'];
                    $innovation_name = $innovation['first_name'];
                    $data = array('name'=>$user_first_name, 'usertype'=>$usertype, 'content'=>$message);
                    Mail::send('emails.register', $data, function($message) use ($innovation_email,$innovation_name)
                    {   
                        $message->from('no-reply@threat.com', "METIP");
                        $message->to( $innovation_email,$innovation_name)->subject('New User Registration');
                    });
                }
            }
        }
        elseif($user_type == 5)
        {
            $usertype = AdminEmailSetting::where('type',$user_type)->get()->pluck('name');
            $usertype = $usertype[0];
            $subject = "Registration";

            //Market
            $message = AdminEmailSetting::where('name','Mlt Admin')->get()->pluck('message');
            $message = $message[0];

            $innovation_admin = $admin = Admin::where('role_id',3)->get()->toArray();
            if(!empty($innovation_admin))
            {
                foreach($innovation_admin as $innovation)
                {
                    $innovation_email = $innovation['email'];
                    $innovation_name = $innovation['first_name'];
                    $data = array('name'=>$user_first_name, 'usertype'=>$usertype, 'content'=>$message);
                    Mail::send('emails.register', $data, function($message) use ($innovation_email,$innovation_name)
                    {   
                       $message->from('no-reply@threat.com', "METIP");
                       $message->to( $innovation_email,$innovation_name)->subject('New User Registration');
                    });
                }
            }
        }
        elseif($user_type == 6)
        {
            $usertype = AdminEmailSetting::where('type',$user_type)->get()->pluck('name');
            $usertype = $usertype[0];
            $subject = "Registration";

            //Document
            $message = AdminEmailSetting::where('name','Document Admin')->get()->pluck('message');
            $message = $message[0];

            $innovation_admin = $admin = Admin::where('role_id',4)->get()->toArray();
            if(!empty($innovation_admin))
            {
                foreach($innovation_admin as $innovation)
                {
                    $innovation_email = $innovation['email'];
                    $innovation_name = $innovation['first_name'];
                    $data = array('name'=>$user_first_name, 'usertype'=>$usertype, 'content'=>$message);
                    Mail::send('emails.register', $data, function($message) use ($innovation_email,$innovation_name)
                    {   
                        $message->from('no-reply@threat.com', "METIP");
                        $message->to( $innovation_email,$innovation_name)->subject('New User Registration');
                    });
                }
            }
        }

        $message = AdminEmailSetting::where('type',$user_type)->get()->pluck('message');
        $message = $message[0];  
        $user  = array(); 
        //User
        $data = array('name'=>$user_first_name, 'usertype'=>$usertype, 'content'=>$message);
        Mail::send('emails.register', $data, function($message) use ($user_email,$user_first_name)
        {   
            $message->from('no-reply@threat.com', "METIP");
            $message->to($user_email, $user_first_name)->subject('Registration with METIP ');
        });
      

        //SuperAdmin
        $admin = Admin::where('role_id',1)->first();
        $admin_email = $admin->email; 
        $admin_name = $admin->first_name; 
        $message = AdminEmailSetting::where('name','Super Admin')->get()->pluck('message');
        $message = $message[0];  
        $data = array('name'=>$user_first_name, 'usertype'=>$usertype, 'content'=>$message);
        Mail::send('emails.register', $data, function($message) use ($admin_email,$admin_name)
        {   
            $message->from('no-reply@threat.com', "METIP");
            $message->to($admin_email,$admin_name)->subject('New User Registration');
        });


          
       /* if (request()->getHttpHost() != "localhost") {
            Mail::to($user['email'])->send(new RegisterMail($user));
        }*/
        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
    
    public function register(Request $request)
    { 
        $this->validator($request->all())->validate();
         if($request->hasFile('kebel')) {
               
            $kebel = $request->kebel->store('user/kebels');
         }else
         {
            $kebel = "";
         }

         if($request->hasFile('cv')) {
                $cv = $request->cv->store('user/cvs');
         } else
         {
            $cv = "";
         }
     
        event(new Registered($user = $this->create($request->all(),$kebel,$cv))); 
                
        return $this->registered($request, $user)
        ?: redirect($this->redirectPath());
    }
}
