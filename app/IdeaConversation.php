<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaConversation extends Model
{
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'description',
        'quotation',
        'idea_id',
        'attach_file',
        'from_admin_id',
        'to_admin_id',
        'wishlist_id',
        'publish'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    
    public function fromuser()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }
    public function touser()
    {
        return $this->belongsTo('App\User', 'to_user_id');
    }
    public function fromadmin()
    {
        return $this->belongsTo('App\Admin', 'from_admin_id');
    }
    public function toadmin()
    {
        return $this->belongsTo('App\Admin', 'to_admin_id');
    }
}
