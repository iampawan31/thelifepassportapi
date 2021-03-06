<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousSpouseAddress extends Model
{
    protected $fillable = [
        'user_id',
        'street_address1',
        'street_address2',
        'city',
        'state',
        'zipcode'
    ];

    static function tableName()
    {
        return with(new static)->getTable();
    }
}
