<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'embd_code',
        'category_id',
        'admin_id',
        'total_comments',
        'total_views',
        'is_private',
        'is_featured',
        'status'
    ];
    
   /* public function category()
    {
        return $this->belongsTo('App\Category');
    }*/
    
       public function category()
    {
        return $this->belongsTo('App\CategoryVideo');
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

     // Latest Video
    public static function latetsVideos()
    {
        $latest_videos = Self::where('status',1)->orderBy('id', 'desc')->take(12)->get();
        return $latest_videos;
    }

     // Latest Product
    public static function marked()
    {
        $featured_video = Self::where('status',1)->where('is_featured',1)->first();
        return $featured_video;
    }

     // Recent Video
    public static function lastVideo()
    {
        $latest_videos = Self::where('status',1)->orderBy('id', 'desc')->take(1)->first();
        return $latest_videos;
    }

     // Video Detail
    public static function videoDetail($id)
    {
        $video_detail = Self::where('id',$id)->first();
        return $video_detail;
    }

    // Video Detail
    public static function relatedVideo($id)
    {
        $related_video = Self::where('id', '!=', $id)->get();
        return $related_video;
    }
    
      // Video Category
    public static function catVideo($id)
    {
        $related_video = Self::where('category_id', '!=', $id)->get();
        return $related_video;
    }

     // POpular video
    public static function popularVideo()
    {
        $related_video = Self::orderBy('total_views', 'desc')->take(4)->get();
        return $related_video;
    }
}
