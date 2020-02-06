<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEstateStatus extends Model
{
    protected $fillable = ['user_id', 'has_spouseestate', 'count'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
