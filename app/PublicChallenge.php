<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicChallenge extends Model
{
    protected $fillable = [
        'title',
        'description',
        'name',
        'email',
        'mobile',
        'status'
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
