<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminFootercontent extends Model
{
    protected $fillable = [
        'content',
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
