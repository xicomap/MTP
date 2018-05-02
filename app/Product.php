<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'admin_id',
        'url',
        'picture',
        'is_featured',
        'pdf_link',
        'total_views',
    ];
    
    public function category()
    {
        return $this->belongsTo('App\CategoryProduct');
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

     // Latest Product
    public static function latetsProducts()
    {
        $latest_product = Self::orderBy('id', 'desc')->take(4)->get();
        return $latest_product;
    }

    // Video Category
    public static function catProduct($id)
    {
        $related_video = Self::where('category_id', '!=', $id)->get();
        return $related_video;
    }

    // Video Category
    public static function featueredProduct()
    {
        $related_video = Self::where('is_featured', '=', 1)->take(4)->get();
        return $related_video;
    }

     // Video Detail
    public static function productDetail($id)
    {
        $video_detail = Self::where('id',$id)->first();
        return $video_detail;
    
    }
}
