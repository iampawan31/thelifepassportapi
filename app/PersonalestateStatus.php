<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalestateStatus extends Model
{
    protected $fillable = ['user_id', 'has_personalestate', 'count'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
