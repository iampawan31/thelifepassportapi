<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = ['title', 'status'];

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
