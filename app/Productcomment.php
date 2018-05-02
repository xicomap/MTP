<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productcomment extends Model
{
    protected $fillable = [
        'comment',        
        'user_id',
        'product_id'       
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
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
