<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaApplicant extends Model
{
    protected $fillable = [
        'idea_id',
        'user_id',
        'comment',
        'status',
        'score',
        'vote',
        'total',
        'type'
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
