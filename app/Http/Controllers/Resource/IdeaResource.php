<?php

namespace App\Http\Controllers\Resource;

use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Idea;
use App\Category;
use App\Industry;
use App\IdeaInvitation;
use App\User;
use App\IdeaApplicant;
use App\Http\Controllers\IdeaController;
use App\IdeaConversation;
use App\IdeaWishlist;
use Illuminate\Support\Facades\Mail;


class IdeaResource extends Controller
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
    public function index(Request $request)
    {
        $type = $request->query('type');
        if ($type == "" || $type > 4) {
            $type = 1;
        }
        $heading = helper::getChallengeName($type);        
        $ideas = Idea::where('type',$type)->where('admin_id','>',0)->where('sent_sponsor_investor',0)->orderBy('id' , 'desc')->get();
        return view('admin.ideas.index', compact('ideas','type','heading'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->query('type');
        if ($type == "" || $type > 4) {
            $type = 1;
        }        
        $cats = Category::getList(); 
        $inds = Industry::getList(); 
        $heading = helper::getChallengeName($type);    
        return view('admin.ideas.create', compact('type','heading','cats','inds'));
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
            'compid' => 'required|max:20',
            'description' => 'required',
            'type' => 'required'
        ]);

        try{
            $idea = $request->all();            
            $idea['admin_id'] = Auth::guard('admin')->user()->id; 
            $idea['start_date'] = Helper::convertDate($request->start_date);
            $idea['end_date'] = Helper::convertDate($request->end_date);            
            $idea['sent_sponsor_investor'] = 0;            
            $idea = Idea::create($idea);
            $heading = helper::getChallengeName($request->type); 
            if($request->type == 1) {
                //return redirect()->route('admin.idea.invite',['idea_id'=>$idea->id])->with('flash_success','Idea has been posted successfully. Invite to the competitors to post there solutions');
                return redirect()->route('admin.idea.index')->with('flash_success','Idea has been posted successfully. Invite to the competitors to post there solutions');
            } else {
                return back()->with('flash_success',$heading.' has been created successfully');
            }
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
            $idea = Idea::findOrFail($id);
            return view('admin.ideas.idea-details', compact('idea'));
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
            $idea = Idea::findOrFail($id);          
            $heading = helper::getChallengeName($idea->type);    
            $cats = Category::getList();
            $inds = Industry::getList(); 
            return view('admin.ideas.edit',compact('idea','heading','cats','inds'));
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
            'description' => 'required',             
        ]);

        try {
            $idea = Idea::findOrFail($id);              
            $idea->title = $request->title;
            $idea->compid = $request->compid;
            $idea->description = $request->description;            
            $idea->publish = $request->publish; 
            $idea->approve = $request->approve;            
            $idea->active = $request->active;               
            if ($request->start_date != "") {
                $idea->start_date= Helper::convertDate($request->start_date);
            }
            if ($request->end_date != "") {
                $idea->end_date= Helper::convertDate($request->end_date);
            }
            if ($request->type == 3 || $request->type == 4){
                $idea->category_id = $request->category_id;
                $idea->industry_id = $request->industry_id;       
            }
            $idea->save();
            return redirect('/admin/idea?type='.$idea->type)->with('flash_success', 'Record updated successfully');
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
            Idea::find($id)->delete();
            return back()->with('message', 'Record has been deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
    
    public function move_idea($id)
    {
        $appinfo = IdeaApplicant::findOrFail($id);
        return view('admin.ideas.move_idea', compact('appinfo','id'));
    }
    public function send_idea(Request $request, $id)
    {
        try{
            $reqs = $request->all();                    
            $ide = IdeaApplicant::findOrFail($id);
            $ide->sent_sponsor_investor = 1;
            $ide->admin_comment = $reqs['message'];
            $ide->sent_date = date("Y-m-d");
            $ide->save();            
            return redirect()->route('admin.idea.solutions',['idea_id'=>$ide->idea_id])->with('flash_success', 'Ideas have been sent successfully');
        }
        catch (Exception $e) {            
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }        
    }
    
    public function move_ideas(Request $request)
    {            
        
        try{
            $idea = $request->all();
            if (count($idea['ids']) <=0 || $idea['action'] == "") {
                return back()->with('flash_error', 'Please select the ideas with checkbox and action below');
            }
            $ids = $idea['ids'];                   
            for($i=0; $i<(count($ids)); $i++)
            {
                $ide = Idea::findOrFail($ids[$i]);
                $ide->sent_sponsor_investor = 1;               
                $ide->save();
            }
            return back()->with('flash_success', 'Ideas have been moved to investor and sponser successfully');
        }
        catch (Exception $e) {
            dd($e->getMessage()); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }
    
    public function sponser_index(Request $request, $id)
    {       
        $type = $request->query('type');
        $ideas = IdeaWishlist::where('type',$type)->orderBy('created_at' , 'desc')->get();
        return view('admin.ideas.sponser_index', compact('ideas','type'));
    }
    
    public function investor_index(Request $request)
    {        
        $type = $request->query('type');
        //$ideas = IdeaApplicant::where('type',$type)->where('sent_sponsor_investor',1)->orderBy('created_at' , 'desc')->get();
        $ideas = DB::table('idea_applicants as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.user_id')
        ->select('iv.id', 'iv.admin_comment', 'i.title','i.compid', 'u.id AS uid', 'u.first_name','u.last_name','iv.total_sponsor_invester')
        ->where('i.type',$type)
        ->where('iv.sent_sponsor_investor',1)
        ->orderBy('iv.id','desc')->paginate(10);
        return view('admin.ideas.investor_index', compact('ideas','type'));
    }    
    
    public function solutions(Request $request, $id=null)
    {
        $idea_id = "";
        $user_id = "";
        $conditions = array();        
        $idea_info = array();
        if ($request->query('idea_id') > 0) {
            $idea_id = $request->query('idea_id');
            $conditions[] = ['idea_id',$idea_id];
            $idea_info = Idea::findOrFail( $idea_id);
        }
        if ($request->query('user_id') > 0) {
            $user_id = $request->query('user_id');
            $conditions[] = ['user_id',$user_id];
        }
        $type = $idea_info->type;
        $ideas_list = Idea::where('type',$type)->where('solution_id',0)->orderBy('title' , 'asc')->get();
        $users_list = User::where('user_type',$type)->where('status',1)->orderBy('first_name' , 'asc')->get();
        $solutions = IdeaApplicant::where($conditions)->orderBy('total','desc')->get();        
        return view('admin.ideas.solutions', compact('ideas_list','id','users_list','idea_id','user_id','solutions','type'));
    }
    
    public function delete_solution($id)
    {
        try {            
            $ii = IdeaApplicant::find($id);
            $ideainfo = Idea::find($ii->idea_id);
            $ideainfo->total_solutions = ($ideainfo->total_solutions - 1);
            $ideainfo->save();            
            $ii->delete();
            return back()->with('message', 'Record has been deleted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Error occured');
        }
    }
    /*
    public function bulk_delete_solutions(Request $request)
    {
        try{
            $invs = $request->all();
            if (count($invs['ids']) <=0 || $invs['action'] == "") {
                return back()->with('flash_error', 'Please select atleast one invitation and action below');
            }
            $ids = $invs['ids'];
            
            if ($invs['action'] == "remove_sol")
            {
                for($i=0; $i<(count($ids)); $i++)
                {
                    $ii = IdeaApplicant::find($ids[$i]);
                    $ii2 = IdeaApplicant::where('idea_id',$ii->idea_id)->where('user_id',$ii->user_id)->count();
                    $idea = Idea::findOrFail($ii->idea_id);
                    if ($idea->total_solutions > 0 && $ii2 == 1) {
                        $idea->total_solutions = ($idea->total_solutions - 1);
                        $idea->save();
                    }
                    $ii->delete();
                }
                return back()->with('flash_success', 'Soution has been removed');
            }
            else  if ($invs['action'] == "update_score")
            {
                for($i=0; $i<(count($ids)); $i++)
                {
                    $ii = IdeaApplicant::find($ids[$i]);
                    $ii->score = $invs['score_'.$ii->id];
                    $ii->save();
                }
                return back()->with('flash_success', 'Score has been updated successfully');
            } 
            else  if ($invs['action'] == "top10")
            {               
                if (count($ids) != 10)
                {
                    return back()->with('flash_error', 'Please select 10 solutions for this action');
                }
                IdeaApplicant::whereNotIn('id', $ids)->delete();
                return back()->with('flash_success', 'Top10 solution have been selected successfully');
            }   
        }
        catch (Exception $e) {
            //dd($e->getMessage()); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later. Make sure you have selected checkboxes and action');
        }
    }
    */
    
    public function award_solution($id) {
        try {
        $idea = IdeaApplicant::find($id);
        $idea->status = 1;
        $idea->save();
        
        $ide = Idea::find($idea->idea_id);
        $ide->solution_id = $id;
        $ide->save();
        
        return redirect('/admin/idea?type=1')->with('flash_success', 'Winner has been set for this idea');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Error occured.. please try again');
        }
    }
    
    public function edit_solution($id)
    {
        try {
            $sol = IdeaApplicant::findOrFail($id); 
            $user_id =  $sol->user_id;

                  
            $convs = IdeaConversation::where('idea_id',$sol->idea_id)->where('from_user_id',$user_id)->orWhere('to_user_id',$user_id)->orderBy('id','asc')->get();

           /* $convs = IdeaConversation::where('idea_id',$sol->idea_id)->where(function($q){ $q->where('from_user_id','!=',Auth::guard('user')->user()->id)->orWhere('to_user_id','!=',Auth::guard('user')->user()->id);})->orderBy('id','asc')->get();*/
  
            
            return view('admin.ideas.edit_solution',compact('sol','convs'));
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
    public function update_solution(Request $request, $id)
    {   

          
         $this->validate($request, [
            'message' => 'required|max:255',           
           
        ]);  

        
        try {
            $sol = IdeaApplicant::findOrFail($id);
            
            $idea = Idea::findOrFail($sol->idea_id);            
            $idea->publish = $request->publish;
            $idea->approve = $request->approve;
            $idea->active = $request->active;            
            if ($request->end_date != "") {
                $idea->end_date= Helper::convertDate($request->end_date);
            }               
            $sol->score = $request->score;
            $sol->vote = $request->vote;
            $sol->total = ($request->score + $request->vote);
            $sol->save();


            
            if ($request->message != "") {
                $con = array();
                $con['idea_id'] = $sol->idea_id;
                $con['from_admin_id'] = Auth::guard('admin')->user()->id;
                $con['to_user_id'] = $sol->user_id;
                $con['description'] = $request->message;               
                $con = IdeaConversation::create($con);                
                if($request->hasFile('attach')) {                    
                    $con->attach_file = $request->attach->store('idea/convers');                   
                }
                $con['publish'] = $request->publish;
                $con->save();

                $email = $sol->user->email;
                //$email = "xicomtest11@gmail.com";
                $from = Auth::guard('admin')->user()->first_name;
                $idea_name = $idea->title;


                //Mail               
                 
                Mail::send('emails.notification', ["data" =>  $request->message,"from" => $from ,"idea_name" => $idea_name], function ($message) use ($email){
                                                    $message->from('no-reply@threat.com', "METIP");
                                                    $message->to($email)->subject('Notification');
                });
            }


            return redirect()->route('admin.idea.solutions',['idea_id'=>$sol->idea_id])->with('flash_success', 'Record updated successfully');
        }
        
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Error occured. Please try again');
        }
    }
    
    public function offerdetails($id)
    {
        try {
            $sol = IdeaWishlist::findOrFail($id);
            $convs = IdeaConversation::where('wishlist_id',$id)->where(function($q){ $q->where('from_admin_id',Auth::guard('admin')->user()->id)->orWhere('to_admin_id',Auth::guard('admin')->user()->id);})->orderBy('id','asc')->get();            
            return view('admin.ideas.offer_details',compact('sol','convs'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    
    public function submitoffer(Request $request, $id)
    {
        $idinfo = IdeaWishlist::findOrFail($id);
        $idinfo->status = $request->status;
        $idinfo->save();
        if ($request->message != "") {
            $con = array();
            $con['wishlist_id'] = $id;
            $con['from_admin_id'] = Auth::guard('admin')->user()->id;
            $con['to_user_id'] = $idinfo->user_id;
            $con['description'] = $request->message;
            $con = IdeaConversation::create($con);
            if($request->hasFile('attach')) {
                $con->attach_file = $request->attach->store('idea/convers');
                
            }
            $con->save();
        }
        return redirect()->route('admin.idea.offerdetails',$id)->with('flash_success', 'Record updated successfully');
    }

    public function destroyall(Request $request)
    {
        try {
            $selected_ids = $request->ids;
            Idea::whereIn('id', $selected_ids)->delete();
            print_r('success');
           die();
        } catch (ModelNotFoundException $e) {
            print_r('fail');
           die();
        }
        
    }
    
}
