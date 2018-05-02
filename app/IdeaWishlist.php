<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaWishlist extends Model
{
    protected $fillable = [
        'user_id',
        'idea_applicant_id',
        'offer',
        'lookingfor',
        'type'
    ];
    
    public function applicant()
    {
        return $this->belongsTo('App\IdeaApplicant','idea_applicant_id');
        //return $this -> hasMany( 'App\IdeaApplicant', 'id', 'idea_applicant_id' );
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
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
