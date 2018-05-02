<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'branch_name',
        'department_name',
        'article_number',
        'description',  
        'pdf', 
        'private'    
    ];


    public function branchrule()
    {
        return $this->belongsTo('App\BranchRule');
    }
}
