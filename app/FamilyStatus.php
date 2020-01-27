<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyStatus extends Model
{
    protected $fillable = ['user_id', 'has_family_member', 'count'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
