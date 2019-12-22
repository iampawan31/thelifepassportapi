<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPersonalDetailsCompletion extends Model
{
    protected $fillable = ['step_id', 'user_id', 'is_filled'];

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
