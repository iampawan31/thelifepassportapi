<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalDetailsSteps extends Model
{
    protected $fillable = ['step', 'slug', 'percentage'];

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
