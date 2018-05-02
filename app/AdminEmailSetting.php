<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminEmailSetting extends Model
{
    protected $fillable = [
        'name',
        'message',
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
