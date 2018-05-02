<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',        
        'category_id',
        'admin_id',
        'total_comments',
        'total_views',        
        'status',
        'picture'
    ];
    
    public function category()
    {
        return $this->belongsTo('App\CategoryArticle');
    }

     public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    // Latest Article
    public static function latetsArticles()
    {
        $latest_article = Self::where('status',1)->orderBy('id', 'desc')->take(3)->get()->toArray();
        return $latest_article;
    }

     // Video Detail
    public static function relatedArticle($id)
    {
        $related_video = Self::where('id', '!=', $id)->get();
        return $related_video;
    }

     // Video Detail
    public static function videoDetail($id)
    {
        $video_detail = Self::where('id',$id)->first();
        return $video_detail;
    }
    
     // Video Category
    public static function catArticle($id)
    {
        $related_video = Self::where('category_id', '!=', $id)->get();
        return $related_video;
    }

    // Article list
    public static function articleList()
    {
        $articleList = Self::orderBy('id', 'desc')->get();
        return $articleList;
    }

    // POpular video
    public static function popularArticle()
    {
        $related_article = Self::orderBy('total_views', 'desc')->take(4)->get();
        return $related_article;
    }
}
