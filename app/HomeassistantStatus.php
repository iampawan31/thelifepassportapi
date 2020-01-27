<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeassistantStatus extends Model
{
    protected $fillable = ['user_id', 'has_homeassistant', 'count'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
