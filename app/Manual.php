<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $fillable = [
        'title',
        'description',        
        'type',
        'category_id',        
        'admin_id'
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
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
