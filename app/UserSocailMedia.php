<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocailMedia extends Model
{
    protected $fillable = ['user_id', 'social_id', 'username', 'password', 'is_primary'];

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
