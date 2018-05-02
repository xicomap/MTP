<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchDepartment extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    
    public static function getList()
    {
        $cats = Self::get()->toArray();
        return $cats;
    }
}
