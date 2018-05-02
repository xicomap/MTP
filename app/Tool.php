<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'pdf', 
        'private'      
    ];
}
