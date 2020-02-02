<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarriageStatus extends Model
{
    protected $fillable = ['user_id', 'is_married'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_married' => 'boolean',
        'user_id' => 'integer'
    ];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
