<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class PersonalDetailsSteps extends Model
{
    protected $fillable = ['step', 'slug', 'percentage', 'sequence'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
