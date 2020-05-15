<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyPhone extends Model
{
    protected $fillable = ['user_id', 'family_member_id', 'phone'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
