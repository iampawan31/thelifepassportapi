<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarriageStatus extends Model
{
    protected $fillable = ['user_id', 'is_married'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
