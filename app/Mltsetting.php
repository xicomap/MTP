<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mltsetting extends Model
{
    protected $fillable = [       
        'description',
        'picture_file',
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
