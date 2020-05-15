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

    public function address()
    {
        return $this->hasOne(FriendsAddress::class, 'friend_id');
    }

    public function phone()
    {
        return $this->hasMany(\App\FriendsPhone::class, 'friend_id')->select(['friend_id', 'phone']);
    }

    public function step()
    {
        return $this->hasOne(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 5);
    }
}
