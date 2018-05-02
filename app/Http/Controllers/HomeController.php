<?php
namespace App\Http\Controllers\UserAuth;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Idea;
use App\CategoryVideo;
use App\Article;
use App\Product;
use App\Video;
use App\CategoryArticle;
use App\CategoryProduct;
use Session;
use App\AdminSetting;
use App\Tool;
use App\Rule;
use App\BranchDepartment;
use App\BranchRule;
use App\CategoryTool;
use App\Page;
use App\IdeaApplicant;
use App\IdeaConversation;
use App\AdminCommentSetting;
use App\Articlecomment;
use App\Videocomment;
use App\Productcomment;
use App\AdminFootercontent;

class HomeController extends Controller
{
    public function __construct()
    {                
        $this->middleware('guest');
    }
    
    public function index() {
        
        $ideas = Idea::where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->paginate(10);
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.index', compact('ideas','footercontent'));
    }
    
    public function thanks() {
        return view('user.thanks');
    }
    
    public function marketing() {
        $admin_script = AdminSetting::all();
        $categories = CategoryVideo::getList(); 
        $latest_articles = Article::latetsArticles(); 
        $latest_product = Product::latetsProducts(); 
        $latest_videos = Video::latetsVideos();
        if($latest_videos ->isEmpty())
        {
            $latest_videos = "";
        }
        $featured_video = Video::marked(); 
        $featured_product = Product::featueredProduct();
        if($featured_product->isEmpty())
        {
            $featured_product = "";
        }
        /*else
        {
            $featured_video = Video::lastVideo();
        }*/
        $popular_video = Video::popularVideo();
        if($popular_video ->isEmpty())
        {
            $popular_video = "";
        }
        $footercontent = AdminFootercontent::where('id',1)->first();

        return view('user.marketing',compact('categories','latest_articles','latest_product','latest_videos','featured_video','featured_product','popular_video','admin_script','footercontent'));
    }

    public function videoDetail($id) {
    	$admin_script = AdminSetting::all();
    	$latest_articles = Article::latetsArticles(); 
        $featured_product = Product::featueredProduct();
        $categories = CategoryVideo::getList();
        $videoKey = 'video_' . $id;
        if (!Session::has($videoKey)) {
            Video::where('id', $id)->increment('total_views');
            Session::put($videoKey, 1);
        }
        $video_detail = Video::videoDetail($id);
        $related_video = Video::relatedVideo($id);
        $setting = AdminCommentSetting::where('id',3)->first();
        $video_comment = Videocomment::all();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.video-detail',compact('video_detail','related_video','admin_script','latest_articles','featured_product','categories','setting','video_comment','footercontent'));
    }

    public function articleDetail($id) {
    	$related_video = Product::featueredProduct();
        $latest_articles = Article::latetsArticles();   
        if(empty($latest_articles))
        {
            $latest_articles = "";
        }   
        $latest_videos = Video::latetsVideos();
        if($latest_videos->isEmpty())
        {
            $latest_videos = "";
        }
        $featured_product = Product::featueredProduct();
        if($featured_product->isEmpty())
        {
            $featured_product = "";
        }
        $articleKey = 'article_' . $id;
        $admin_script = AdminSetting::all();
        $setting = AdminCommentSetting::where('id',1)->first();

        if (!Session::has($articleKey)) {
            Article::where('id', $id)->increment('total_views');
            Session::put($articleKey, 1);
        }
        $video_detail = Article::videoDetail($id);
        $related_video = Article::relatedArticle($id);
        $cats = CategoryArticle::all();
        $popular_article = Article::popularArticle();
        $article_comment = Articlecomment::all();
        $footercontent = AdminFootercontent::where('id',1)->first();
       return view('user.article_detail',compact('video_detail','related_video','cats','admin_script','featured_product','latest_videos','latest_articles','popular_article','setting','article_comment','footercontent'));
    }
    
    public function articleList() {
    	$related_video = Product::featueredProduct();
        $latest_articles = Article::latetsArticles();  
        if(empty($latest_articles))
        {
            $latest_articles = "";
        }    
        $latest_videos = Video::latetsVideos();
        if($latest_videos->isEmpty())
        {
            $latest_videos = "";
        }
        $featured_product = Product::featueredProduct();
        if($featured_product->isEmpty())
        {
            $featured_product = "";
        }
    	$admin_script = AdminSetting::all();
        $cat_article = Article::articleList();
        $cats = CategoryArticle::all();
        $popular_article = Article::popularArticle();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.article_list',compact('cat_article','cats','admin_script','featured_product','latest_videos','latest_articles','popular_article','footercontent'));
    }
    
     public function catvideolist($id) {
     	$latest_articles = Article::latetsArticles(); 
        $featured_product = Product::featueredProduct();
     	$admin_script = AdminSetting::all();
        $cat_video = Video::catVideo($id);
        $cats = CategoryVideo::all();
        $cat_name = CategoryVideo::where('id',$id)->first();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.cat_video',compact('cat_video','cats','cat_name','admin_script','latest_articles','featured_product','footercontent'));
    }

    public function catarticlelist($id) {
    	$related_video = Product::featueredProduct();
        $latest_articles = Article::latetsArticles();      
        $latest_videos = Video::latetsVideos();
        $featured_product = Product::featueredProduct();
    	$admin_script = AdminSetting::all();
        $cat_article = Article::catArticle($id);
        $cats = CategoryArticle::all();
        $cat_name = CategoryArticle::where('id',$id)->first();
        $popular_article = Article::popularArticle();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.cat_article',compact('cat_article','cats','cat_name','admin_script','featured_product','latest_videos','latest_articles','popular_article','footercontent'));
    }

    public function catproductlist($id) {
    	$admin_script = AdminSetting::all();
        $cat_article = Product::catProduct($id);
        $cats = CategoryProduct::all();
        $cat_name = CategoryProduct::where('id',$id)->first();
         $related_video = Product::featueredProduct();
        $latest_articles = Article::latetsArticles();      
        $latest_videos = Video::latetsVideos();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.cat_product',compact('cat_article','cats','cat_name','related_video','latest_articles','latest_videos','admin_script','footercontent'));
    }
    
    public function productlist() {
    	$admin_script = AdminSetting::all();
        $cat_article = Product::paginate(20);
        if(empty($cat_article))
        {
            $cat_article = "";
        }
        $cats = CategoryProduct::all();
        $related_video = Product::featueredProduct();
        if($related_video->isEmpty())
        {
            $related_video = "";
        }
        $latest_articles = Article::latetsArticles();      
        $latest_videos = Video::latetsVideos();
        if($latest_videos->isEmpty())
        {
            $latest_videos = "";
        }
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.product_list',compact('cat_article','cats','related_video','latest_articles','latest_videos','admin_script','footercontent'));
    }

    public function productDetail($id) {
    	$admin_script = AdminSetting::all();
        $articleKey = 'product_' . $id;

        if (!Session::has($articleKey)) {
            Product::where('id', $id)->increment('total_views');
            Session::put($articleKey, 1);
        }
       $video_detail = Product::productDetail($id);
       $cats = CategoryProduct::all();
       $related_video = Product::featueredProduct();
       $lates_product = Product::latetsProducts();
       $latest_videos = Video::latetsVideos();
       $setting = AdminCommentSetting::where('id',2)->first();
       $product_comment = Productcomment::all();
       $footercontent = AdminFootercontent::where('id',1)->first();
       return view('user.product_detail',compact('video_detail','related_video','cats','lates_product','latest_videos','admin_script','setting','product_comment','footercontent'));
    }

    public function rules() {
    	$admin_script = AdminSetting::all();
        
        $dept = BranchDepartment::all();
        $branch = BranchRule::all();

        if (Auth::guard('user')->check())
        {
            $usertype = Auth::guard('user')->user()->user_type;
            if ($usertype == 6) {
                 $rules = Rule::paginate(20);
            }else
            {
                $rules = Rule::where('private',0)->paginate(20);
            }
        }else{
            $rules = Rule::where('private',0)->paginate(20);
        }
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.rules',compact('rules','dept','branch','admin_script','footercontent'));
    }

    public function tools() {
    	$cats = CategoryTool::all();
    	$admin_script = AdminSetting::all();
        if (Auth::guard('user')->check())
        {
            $usertype = Auth::guard('user')->user()->user_type;
            if ($usertype == 6) {
                 $tools = Tool::paginate(20);
            }else
            {
                $tools = Tool::where('private',0)->paginate(20);
            }
        }else{
            $tools = Tool::where('private',0)->paginate(20);
        }
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.tools',compact('tools','admin_script','cats','footercontent'));
    }

    public function cattoollist($id){
    	$cats = CategoryTool::all();
    	 $cat_name = CategoryTool::where('id',$id)->first();
    	$admin_script = AdminSetting::all();
        if (Auth::guard('user')->check())
        {
            $usertype = Auth::guard('user')->user()->user_type;
            if ($usertype == 6) {
                 $tools = Tool::paginate(20);
            }else
            {
                $tools = Tool::where('private',0)->paginate(20);
            }
        }else{
            $tools = Tool::where('private',0)->paginate(20);
        }
        $footercontent = AdminFootercontent::where('id',1)->first();
    	return view('user.cat_tools',compact('tools','admin_script','cats','cat_name','footercontent'));
    }

     public function homeSearch(Request $request)
    {
        if($request->has('q')){           
            $search = Video::where( 'title', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->paginate(20);
        }else
        {
            $search ="";
        }
         $serach_name = $request->q;
         $footercontent = AdminFootercontent::where('id',1)->first();
         return view('user.search',compact('search','serach_name','footercontent'));
    }


    public function x(Request $request)
    {

        if($request->has('category_name')){           
                    $category_name =  $request->category_name;
                    $users = BranchDepartment::where('branch_id', $category_name)->get();  
         if(!empty($users)){?>
            <option value="">Select Department</option>
        <?php foreach($users as $user){?>
            <option value="<?php echo $user->id;?>"><?php echo $user->name;?></option>

        <?php }
        }
    }   

       
        die();             
    }

    public function ruleSearch(Request $request)
    {
        if($request->has('q') && $request->has('branch_name') && $request->has('department_name')){          
            

                if (Auth::guard('user')->check())
                {
                    $usertype = Auth::guard('user')->user()->user_type;
                    if ($usertype == 6) {
                         $rules = Rule::orWhere( 'article_number', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->where('branch_name',$request->branch_name)->where('department_name',$request->department_name)->paginate(20);
                    }else
                    {
                       $rules = Rule::orWhere( 'article_number', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->where('branch_name',$request->branch_name)->where('department_name',$request->department_name)->where('private',0)->paginate(20);
                    }
                }else{
                    $rules = Rule::orWhere( 'article_number', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->where('branch_name',$request->branch_name)->where('department_name',$request->department_name)->where('private',0)->paginate(20);
                }             

        }else
        {
            $rules = "";
        }

        $branch_name =  $request->branch_name;
             $department_name =  $request->department_name;
             $department_name = BranchDepartment::where('id', $department_name)->first();
             $department_id = $department_name->id; 
             $department_name =  $department_name->name;
             $branch_name = BranchRule::where('id', $branch_name)->first(); 
             $branch_id = $branch_name->id;
             $branch_name =  $branch_name->name;
             $term = $request->q ;

        $admin_script = AdminSetting::all();
        
        $dept = BranchDepartment::all();
        $branch = BranchRule::all();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.cat_rules',compact('rules','admin_script','dept','search','branch','department_name','branch_name','branch_id','department_id','term','footercontent'));
    }

    public function competitonIdea(){

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

        $page_content = Page::where('id',5)->first();
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
/*
        echo "<pre>";
        print_r($ideaids);
*/
       $footercontent = AdminFootercontent::where('id',1)->first();

        return view('user.idea_competition', compact('ideas','top10','pchallanges','top10ch','admin_script','page_content','ideaids','footercontent'));
        // return view('user.idea_competition');
    }

    public function publicChallenge(){

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

        $page_content = Page::where('id',6)->first();

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
        return view('user.public_challenge', compact('ideas','top10','pchallanges','top10ch','admin_script','page_content','ideaids','footercontent'));
    }

    public function send_public_challenge(){
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
        $page_content = Page::where('id',7)->first();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.send_public_challenge', compact('ideas','top10','pchallanges','top10ch','admin_script','page_content','footercontent'));
    }

    public function sponser(){
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
        $page = "sponser";
         $page_content = Page::where('id',8)->first();
         $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.sponser', compact('ideas','top10','pchallanges','top10ch','admin_script','page','page_content','footercontent'));
        //return view('user.sponser');
    }

    public function winner(){
        $admin_script = AdminSetting::all();      
        $ideas = Idea::where('type',1)->where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->orderBy('id','desc')->paginate(25);
        $pchallanges = Idea::where('type',2)->where('publish',1)->where('approve',1)->where('active',1)->where('sent_sponsor_investor',0)->where('start_date','<=',date("Y-m-d"))->where('end_date','>=',date("Y-m-d"))->orderBy('id','desc')->paginate(25);
        //$top10 = IdeaApplicant::where('total','>',0)->orderBy('total','desc')->paginate(10);
     /*   $top10 = DB::table('idea_applicants as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.user_id')
        ->select('u.id', 'u.first_name', 'u.last_name')
        ->where('i.type',1)
        ->where('iv.total','>',0)
        ->orderBy('iv.total','desc')->paginate(10);*/

        $top10 = DB::table('idea_conversations as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.to_user_id')
        ->select('u.id', 'u.first_name', 'u.last_name')
        ->where('iv.publish',1)
        ->where('i.type',1) 
        ->groupBy('iv.to_user_id')       
        ->paginate(10);

        $top10ch = DB::table('idea_conversations as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.to_user_id')
        ->select('u.id', 'u.first_name', 'u.last_name')
        ->where('iv.publish',1)
        ->where('i.type',2) 
        ->groupBy('iv.to_user_id')       
        ->paginate(10);


        
        /*$top10ch = DB::table('idea_applicants as iv')
        ->join('ideas as i','i.id','=','iv.idea_id')
        ->join('users as u','u.id','=','iv.user_id')
        ->select('u.id', 'u.first_name', 'u.last_name')
        ->where('iv.total','>',0)
        ->where('i.type',2)
        ->orderBy('iv.total','desc')->paginate(10);*/
        
        $page_content = Page::where('id',9)->first();
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.winner', compact('ideas','top10','pchallanges','top10ch','admin_script','page_content','footercontent'));
    }

    public function metec_employee(){
         $admin_script = AdminSetting::all();
         $page = "metec";
         $page_content = Page::where('id',10)->first();
         $footercontent = AdminFootercontent::where('id',1)->first();
         return view('user.sponser', compact('admin_script','page','page_content','footercontent'));

    }

    public function toolSearch(Request $request){
        if($request->has('q') && $request->has('branch_name'))
        {         
                if (Auth::guard('user')->check())
                {

                    $usertype = Auth::guard('user')->user()->user_type;
                    if ($usertype == 6) {
                         $tools = Tool::where( 'title', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->where('category_id',$request->branch_name)->paginate(20);
                    }else
                    {
                         $tools = Tool::where( 'title', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->where('category_id',$request->branch_name)->where('private',0)->paginate(20);
                    }
                }else{

                   
                     $tools = Tool::where('private','!=',1)->where( 'title', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->where('category_id',$request->branch_name)->paginate(20);

                    
                }

        }elseif($request->has('q'))
        {           
           if (Auth::guard('user')->check())
                {


                    $usertype = Auth::guard('user')->user()->user_type;
                    if ($usertype == 6) {
                         $tools = Tool::where( 'title', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->paginate(20);
                    }else
                    {
                         $tools = Tool::where( 'title', 'LIKE', '%' . $request->q . '%' )->orWhere( 'description', 'LIKE', '%' . $request->q . '%' )->where('private',0)->paginate(20);
                    }
                }
        }  

        $cat_name = CategoryTool::where('id',$request->branch_name)->first();
       
        $cats = CategoryTool::all();
        $admin_script = AdminSetting::all();
        $cat_id = $request->branch_name;
        $footercontent = AdminFootercontent::where('id',1)->first();
        return view('user.cat_tools',compact('tools','admin_script','cats','cat_name','cat_id','footercontent'));

    }

    public function article_comment(Request $request, $id){
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);
        
        try{
            $mp = $request->all();
            $mp['article_id'] = $id;  
            if(Auth::guard('user')->check()) 
            {
                $mp['user_id'] = Auth::guard('user')->user()->id;
            }else{
                $mp['user_id'] = 0;
            }       
            
            Articlecomment::create($mp);
            
            return back()->with('flash_success', 'You comment has been posted successfully');
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }

    public function product_comment(Request $request, $id){
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);
        
        try{
            $mp = $request->all();
            $mp['product_id'] = $id;  
            if(Auth::guard('user')->check()) 
            {
                $mp['user_id'] = Auth::guard('user')->user()->id;
            }else{
                $mp['user_id'] = 0;
            }       
            
            Productcomment::create($mp);
            return back()->with('flash_success', 'You comment has been posted successfully');
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }
    }

    public function video_comment(Request $request, $id){

        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);
        
        try{
            $mp = $request->all();
            $mp['video_id'] = $id;  
            if(Auth::guard('user')->check()) 
            {
                $mp['user_id'] = Auth::guard('user')->user()->id;
            }else{
                $mp['user_id'] = 0;
            }       
            
            Videocomment::create($mp);
            return back()->with('flash_success', 'You comment has been posted successfully');
        }
        catch (Exception $e) {
            echo $e->getMessage(); exit;
            return back()->with('flash_error', 'Sorry.. error occured. Please try later');
        }

    }

}
