<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meticcomment extends Model
{
    protected $fillable = [
        'comment',        
        'user_id',
        'meticpost_id'       
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function meticpost()
    {
        return $this->belongsTo('App\Meticpost');
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
