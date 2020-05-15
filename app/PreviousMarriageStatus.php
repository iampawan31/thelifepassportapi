<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousMarriageStatus extends Model
{
    protected $fillable = ['user_id', 'is_previously_married'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
