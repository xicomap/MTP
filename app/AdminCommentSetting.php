<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCommentSetting extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    
   
}
