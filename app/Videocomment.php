<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videocomment extends Model
{
    protected $fillable = [
        'comment',        
        'user_id',
        'video_id'       
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function video()
    {
        return $this->belongsTo('App\Video');
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
