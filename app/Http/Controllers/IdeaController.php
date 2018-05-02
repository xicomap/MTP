<?php
namespace App\Http\Controllers\UserAuth;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\IdeaApplicant;
use App\IdeaConversation;
use App\Article;
use App\IdeaInvitation;
use App\IdeaWishlist;
use App\PublicChallenge;
use App\AdminSetting;
use Illuminate\Support\Facades\Mail;
use App\AdminFootercontent;


class IdeaController extends Controller
{
    public function __construct()
    {
        $this->middleware('user', ['except' => ['postdetail','mlt_index','innovation','addchallenge']]);        
    }
    
    public function postdetail($id)
    {
         $admin_script = AdminSetting::all();
        $idea = Idea::findOrFail($id);
        $buttonname = "Apply Now";
        if (Auth::guard('user')->check())
        {
            $usertype = Auth::guard('user')->user()->user_type;
            if ($usertype == 1) {
                $buttonname = "Apply Now";
            } else if ($usertype == 2) {
                $buttonname = "I want to Sponser";
            } else if ($usertype == 3) {
                $buttonname = "I want to Invest";
            }
        }
        $ideas = Idea::where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->orderBy('id','desc')->paginate(25);
       
        //$top10 = IdeaApplicant::where('total','>',0)->orderBy('total','desc')->paginate(10);
        $top10 = DB::table('idea_applicants as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.user_id')
        ->select('u.id', 'u.first_name', 'u.last_name')
        ->where('i.type',1)
        ->where('iv.total','>',0)
        ->orderBy('iv.total','desc')->paginate(10);
        
        $top10ch = DB::table('idea_applicants as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.user_id')
        ->select('u.id', 'u.first_name', 'u.last_name')
        ->where('iv.total','>',0)
        ->where('i.type',2)
        ->orderBy('iv.total','desc')->paginate(10);
         $footercontent = AdminFootercontent::where('id',1)->first(); 
        return view('user.postdetail', compact('idea','id','buttonname','ideas','top10','top10ch','admin_script','footercontent'));
    }  
    
    /*
    public function apply(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|min:2',           
        ]);           
        try {
            $req = $request->all();
            $req['idea_id'] = $id;
            $req['user_id'] = Auth::guard('user')->user()->id;
            $req['status'] = 0;             
            $req = IdeaApplicant::create($req);            
            return back()->with('flash_success','Your request has been sent to the Admin. You will be received an email soon');
        } catch (Exception $e) {
            dd($e->getTraceAsString()); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try again');
        }
    }   
   
    public function proposals()
    {
        if (Auth::guard('user')->user()->user_type == 2) {
            $ideas = Idea::where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',1)->paginate(10);
        } else if (Auth::guard('user')->user()->user_type == 3) {
            $ideas = Idea::where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',1)->paginate(10);
        } else if (Auth::guard('user')->user()->user_type == 1) {
            $ideas = IdeaInvitation::where('user_id',Auth::guard('user')->user()->id)->orderBy('id','desc')->paginate(25);
        }
        return view('user.proposals', compact('ideas'));
    }
    */
    
    public function invitations(Request $request)
    {
         $admin_script = AdminSetting::all();
        //$invs = IdeaInvitation::with('idea')->where('user_id',Auth::guard('user')->user()->id)->orderBy('id','desc')->paginate(25);
        $type = $request->query('type');
        if ($type == "" || $type > 2) {
            $type = 1;
        }
        $invs = DB::table('idea_applicants as iv')
                ->join('ideas as i','i.id','=','iv.idea_id')
                ->select('i.title', 'i.description','i.id as ideaid','iv.created_at', 'iv.comment', 'iv.id', 'iv.status', 'iv.score', 'iv.vote', 'iv.total')
                ->where('i.solution_id',0)
                ->where('i.type',$type)
                ->where('iv.user_id',Auth::guard('user')->user()->id)
                ->orderBy('id','desc')->paginate(25); 

        $convs = array();
        if(!empty( $invs))
        {
            foreach ($invs as $key => $value) {                
                $convs[$value->ideaid] = IdeaConversation::where('idea_id', $value->ideaid)->where('to_user_id',Auth::guard('user')->user()->id)->where('is_read', 0)->orderBy('id','desc')->get()->count(); 
               
            }

        }

        $footercontent = AdminFootercontent::where('id',1)->first(); 
       
        return view('user.invitations', compact('invs','type','admin_script','convs','footercontent'));
    } 
    
    public function ideas(Request $request)
    {
         $admin_script = AdminSetting::all();
       $type = $request->query('type');
        if ($request->query('type') > 0) {
            $type = $request->query('type');
        }
        $ideas = Idea::where('type',$type)->where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->orderBy('id','desc')->paginate(25);

        $ideaids = array();
        if (Auth::guard('user')->check())
        {
            if(Auth::guard('user')->user()->id)
            {
                $current_user_id = Auth::guard('user')->user()->id;             
                $applications = IdeaApplicant::where('user_id',$current_user_id)->get();
              
                foreach($applications as $app)
                {                      
                   
                    $ideaids[] = $app->idea_id;                 
                }
            }
            else{
                $ideaids = "";
            }  

        }else{
            $ideaids = "";
        } 
        $footercontent = AdminFootercontent::where('id',1)->first(); 
        return view('user.ideas', compact('ideas','type','admin_script','ideaids','footercontent'));
    } 
    
    public function inv_detail($id)
    {
        $admin_script = AdminSetting::all();
        $idea = IdeaApplicant::findOrFail($id);       
        $convs = IdeaConversation::where('idea_id',$idea->idea_id)->where(function($q){ $q->where('from_user_id',Auth::guard('user')->user()->id)->orWhere('to_user_id',Auth::guard('user')->user()->id);})->orderBy('id','asc')->get();
        $footercontent = AdminFootercontent::where('id',1)->first(); 
            
        return view('user.inv_detail', compact('idea','id','convs','admin_script','footercontent'));
    }
    
    public function submit_solution(Request $request, $id)
    {     
        $this->validate($request, [
            'message' => 'required'                        
        ]);   
        $invd = IdeaApplicant::findOrFail($id);
        if ($invd->user_id != Auth::guard('user')->user()->id) {
            return back()->with('flash_error', 'Invalid access. Kindly contact to administrator');
        }       
        try {           
            $req = $request->all();
            if (isset($req['comment']) && $req['comment'] != "")
            {
                $invd->comment = $req['comment'];
                $invd->save();
            }
            if ($req['message'] != "") {
                $idea_detail = Idea::findOrFail($invd->idea_id);

              
                $con = array();
                $con['idea_id'] = $invd->idea_id;
                $con['from_user_id'] = Auth::guard('user')->user()->id;
                $con['to_admin_id'] = $idea_detail->admin_id;
                $con['description'] = $req['message'];
                $con = IdeaConversation::create($con);
                if($request->hasFile('attach')) {                    
                    $con->attach_file = $request->attach->store('idea/convers');
                    
                }
                $con->save();
                $email = $idea_detail->admin->email;
                //$email = "xicomtest11@gmail.com";
                $from = Auth::guard('user')->user()->first_name;
                $idea_name = $idea_detail->title;
                //Mail                
                 
                 Mail::send('emails.notification', ["data" => $req['message'],"from" => $from ,"idea_name" => $idea_name], function ($message) use ($email){
                                                    $message->from('no-reply@threat.com', "METIP");
                                                    $message->to($email)->subject('Notification');
                 });
            }            
            return back()->with('flash_success','Your idea has been sent successfully.');
        } catch (Exception $e) {       
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try again');
        }
    }
    
    public function mlt_index()
    {
         $admin_script = AdminSetting::all();
        $ideas = Idea::where('solution_id', '>', 0)->orderBy('id' , 'desc')->first();        
        $solutions = array();
        $winner = array();
        if (!empty($ideas)) {
            $solutions = IdeaApplicant::where('idea_id',$ideas->id)->orderBy('score','desc')->get();
            $winner = IdeaApplicant::where('id',$ideas->solution_id)->first();
        }
        $articles = Article::where('status',1)->orderBy('id' , 'desc')->get();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.mlt_index', compact('ideas','articles','solutions','winner','admin_script','footercontent'));
    }
    
    public function innovation()
    {  
         $admin_script = AdminSetting::all();      
        $ideas = Idea::where('type',1)->where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->orderBy('id','desc')->paginate(25);
        $pchallanges = Idea::where('type',2)->where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->orderBy('id','desc')->paginate(25);
        //$top10 = IdeaApplicant::where('total','>',0)->orderBy('total','desc')->paginate(10);
        $top10 = DB::table('idea_applicants as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.user_id')
        ->select('u.id', 'u.first_name', 'u.last_name')
        ->where('i.type',1)
        ->where('iv.total','>',0)
        ->orderBy('iv.total','desc')->paginate(10);
        
        $top10ch = DB::table('idea_applicants as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.user_id')
        ->select('u.id', 'u.first_name', 'u.last_name')
        ->where('iv.total','>',0)
        ->where('i.type',2)
        ->orderBy('iv.total','desc')->paginate(10);
         $footercontent = AdminFootercontent::where('id',1)->first();
        
        return view('user.innovation', compact('ideas','top10','pchallanges','top10ch','admin_script','footercontent'));
    }
    public function addchallenge( Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'title' => 'required',
            'description' => 'required',
            'captcha' => 'required|captcha'
        ]);
        try {
            $iaa = array();
            $iaa['name'] = $request->name;
            $iaa['mobile'] = $request->mobile;
            $iaa['title'] = $request->title;
            $iaa['description'] = $request->description;
            $iaa['email'] = $request->email;
            $iaa['status'] = 0;
            PublicChallenge::create($iaa);            
            return back()->with('flash_success', 'Your challenge has been saved successfully');
            
        } catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try again');
        }
    }
    
    public function innovation_apply(Request $request)
    {      

   /* echo "<pre>";
    print_r($request->all());
    die()*/
          
        $this->validate($request, [           
            'idea_id' => 'required'
        ]);
        try {
            $req = $request->all();
            $idea_info = Idea::findOrFail($req['idea_id']);
            $type = $idea_info->type;
            $userid = Auth::guard('user')->user()->id;
            $check = IdeaApplicant::where('idea_id',$req['idea_id'])->where('user_id',$userid)->first();
            if (empty($check))
            {
                $iaa['idea_id'] = $req['idea_id'];
                $iaa['user_id'] = $userid;
                $iaa['comment'] = '';
                $iaa['status'] = 0;
                $iaa['vote'] = 0;
                $iaa['score'] = 0;
                $iaa['total'] = 0;
                $iaa = IdeaApplicant::create($iaa);
                
                $ideainfo = Idea::findOrFail($req['idea_id']);
                $ideainfo->total_solutions = ($ideainfo->total_solutions + 1);
                $ideainfo->save();
                
                if ($type == 1) {
                    return redirect()->route('invdetail',$iaa->id)->with('flash_success','The competition has been added in your list');
                }
                else if ($type == 2) {                    
                    return redirect()->route('invdetail',$iaa->id)->with('flash_success','The public challenge has been added in your list');
                }
            }
            else
            {          
                if ($type == 1) {
                    return redirect()->route('invdetail',$check->id)->with('flash_success','The competition is already in your list');
                }  else if ($type == 2) {                    
                    return redirect()->route('invdetail',$check->id)->with('flash_success','The public challenge is already in your list');
                }
            }
        } catch (Exception $e) {
            //echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try again');
        }   
            /*
             * We remove the invitation logic for now
             * So we are adding a default solution to the user
             * Changed from rishi sir
            $check = IdeaInvitation::where('idea_id',$req['idea_id'])->where('user_id',$userid)->count();
            //echo "<pre>";
            //print_r($check); exit;
            if ($check == 0)
            {
                $iaa['idea_id'] = $req['idea_id'];
                $iaa['user_id'] = $userid;
                $iaa['notes'] = '';
                $iaa = IdeaInvitation::create($iaa);
                return redirect()->route('invitations')->with('flash_success','The competition has been added in your list');
            }            
            else 
            {
                return back()->with('flash_error','The competition is already in your list');
            }
            */
                
        
    }
    
    public function best_ideas(Request $request)
    {
         $admin_script = AdminSetting::all();
        //$ideas = IdeaApplicant::where('sent_sponsor_investor',1)->orderBy('id','desc')->paginate(25);
        $type = $request->query('type');
       /* $ideas = DB::table('idea_applicants as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.user_id')
        ->select('iv.id', 'iv.admin_comment', 'i.title','i.compid', 'u.id AS uid')
        ->where('i.type',$type)
        ->where('iv.sent_sponsor_investor',1)
        ->orderBy('iv.id','desc')->paginate(10);*/

         /*$ideas = Idea::where('type',1)->where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->orderBy('id','desc')->paginate(25);*/

         $ideas = Idea::where('type',2)->where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->orderBy('id','desc')->paginate(25);


        $ideaids = array();
        if (Auth::guard('user')->check())
        {
            if(Auth::guard('user')->user()->id)
            {
                $current_user_id = Auth::guard('user')->user()->id;             
                $applications = IdeaApplicant::where('user_id',$current_user_id)->get();
              
                foreach($applications as $app)
                {                      
                   
                    $ideaids[] = $app->idea_id;                 
                }
            }
            else{
                $ideaids = "";
            }  

        }else{
            $ideaids = "";
        } 
     
         $footercontent = AdminFootercontent::where('id',1)->first();
        
        return view('user.best_ideas', compact('ideas','type','admin_script','ideaids','footercontent'));
    }
    
    public function ideas_wishlist(Request $request)
    {            
        try {
            $req = $request->all();
            $appid = $req['appid'];
            $userid = Auth::guard('user')->user()->id;
            $check = IdeaWishlist::where('idea_applicant_id',$appid)->where('user_id',$userid)->first();
            if (empty($check))
            {
                $iw = array();
                $iw['idea_applicant_id'] = $appid;
                $iw['user_id'] = $userid;
                $iw['offer'] = 0;
                $iw['lookinfor'] = '';
                $iw['type'] = $req['type'];
                
                IdeaWishlist::create($iw);
                
                $appinfo = IdeaApplicant::findOrFail($appid);
                if (Auth::guard('user')->user()->user_type == 2)
                {
                    $appinfo->total_sponsor = ($appinfo->total_sponsor + 1);
                }
                else if (Auth::guard('user')->user()->user_type == 3)
                {
                    $appinfo->total_invester = ($appinfo->total_invester + 1);
                }                
                $appinfo->total_sponsor_invester = ($appinfo->total_sponsor + $appinfo->total_invester);
                $appinfo->save();
                if ($req['type'] == 1) {
                    return redirect()->route('userwishlist',['type'=>$req['type']])->with('flash_success','The idea has been added in your list');
                }
                else if ($req['type'] == 2) {
                    return redirect()->route('userwishlist',['type'=>$req['type']])->with('flash_success','The competition has been added in your list');
                }
            }
            else
            {
                if ($req['type'] == 1) {
                    return redirect()->route('userwishlist',['type'=>$req['type']])->with('flash_success','The idea is already in your wishlist');
                }
                else if ($req['type'] == 2) {
                    return redirect()->route('userwishlist',['type'=>$req['type']])->with('flash_success','The competition is already in yoru withlist');
                }
                
            }
        } catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try again');
        }   
    }
    
    public function wishlist(Request $request)
    {
         $admin_script = AdminSetting::all();
        $type = $request->query('type');
        $ideas = IdeaWishlist::where('type',$type)->where('user_id',Auth::guard('user')->user()->id)->orderBy('id','desc')->paginate(25);
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.wishlist', compact('ideas','type','admin_script','footercontent'));
    }   
    
    public function setoffer($id)
    {
         $admin_script = AdminSetting::all();
        $idea = IdeaWishlist::findOrFail($id);
        $convs = IdeaConversation::where('wishlist_id',$id)->where(function($q){ $q->where('from_user_id',Auth::guard('user')->user()->id)->orWhere('to_user_id',Auth::guard('user')->user()->id);})->orderBy('id','asc')->get();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.set_offer', compact('idea','id','convs','admin_script','footercontent'));
    }
    
    public function submitoffer(Request $request, $id)
    {   

        $invd = IdeaWishlist::findOrFail($id);
        try {
            $req = $request->all();
            if (isset($req['offer']) && $req['offer'] > 0)
            {
                $invd->offer = $req['offer'];               
                $invd->save();
            }
            if (isset($req['lookingfor']))
            {               
                $invd->lookingfor = $req['lookingfor'];
                $invd->save();
            }
            if ($req['message'] != "") {
                $idea_detail = Idea::findOrFail($invd->applicant->idea_id);
                $con = array();
                $con['wishlist_id'] = $id;
                $con['from_user_id'] = Auth::guard('user')->user()->id;
                $con['to_admin_id'] = $idea_detail->admin_id;
                $con['description'] = $req['message'];
                $con = IdeaConversation::create($con);
                if($request->hasFile('picture')) {
                    $con->attach_file = $request->picture->store('idea/convers');
                    $con->save();
                }
            }
            return back()->with('flash_success','Your offer has been sent successfully.');
        } catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try again');
        }
    }

    public function readconversation(Request $request)
    {  
        $idea_id =  $request->idea_id;
        IdeaConversation::where('idea_id',$idea_id)->update(['is_read' => 1]);

        die();
    }

    

   
}
