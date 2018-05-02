<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mltcomment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'mltpost_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function mltpost()
    {
        return $this->belongsTo('App\Mltpost');
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
