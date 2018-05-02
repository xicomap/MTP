<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaInvitation extends Model
{
    protected $fillable = [
        'user_id',
        'idea_id',
        'notes'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
   
    public function idea()
    {
        return $this->belongsTo('App\Idea');
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
