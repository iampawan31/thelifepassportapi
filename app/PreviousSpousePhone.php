<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousSpousePhone extends Model
{
    protected $fillable = ['user_id', 'phone', 'is_primary'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
