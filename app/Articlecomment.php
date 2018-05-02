<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articlecomment extends Model
{
    protected $fillable = [
        'comment',        
        'user_id',
        'article_id'       
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function article()
    {
        return $this->belongsTo('App\Article');
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
