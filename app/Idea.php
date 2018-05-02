<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'publish',
        'admin_id',
        'approve',
        'active',
        'type',
        'category_id',
        'industry_id',
        'user_id',
        'solution_id',
        'compid'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function conversations()
    {
        return $this->hasMany('App\IdeaConversation')->orderBy('id','desc');
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
