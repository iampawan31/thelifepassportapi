<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyStatus extends Model
{
    protected $fillable = ['user_id', 'has_family_member', 'count'];

    protected $casts = [
        'has_family_member' => 'boolean',
        'count' => 'integer'
    ];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
