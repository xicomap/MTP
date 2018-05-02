<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicInvitation extends Model
{
    protected $fillable = [
        'user_id',
    ];
    
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
