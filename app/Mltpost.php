<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mltpost extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'admin_id',
        'user_id',
        'video_file',
        'type',
        'status',
        'picture_file',
        'metec_id',
        'correctans',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
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
}
