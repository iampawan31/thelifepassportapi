<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendsStatus extends Model
{
    protected $fillable = ['user_id', 'has_friends', 'count'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
