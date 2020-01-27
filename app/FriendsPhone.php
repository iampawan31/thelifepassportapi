<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendsPhone extends Model
{
    protected $fillable = ['user_id', 'friend_id', 'phone'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
