<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $fillable = [
        'user_id', 
        'legal_name', 
        'address', 
        'email'
    ];

    public function getRouteKeyName() {
        return 'user_id';
    }

    public function FriendsPhone() {
        return $this->hasMany(\App\FriendsPhone::class, 'friend_id')->select(['friend_id', 'phone']);
    }

    public function UsersPersonalDetailsCompletion() {
        return $this->hasMany(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 5);
    }
}
