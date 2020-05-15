<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivorceDoc extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'url'
    ];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
