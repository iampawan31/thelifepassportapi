<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseestateAddress extends Model
{
    protected $fillable = [
        'user_id',
        'spouse_estate_id',
        'street_address1',
        'street_address2',
        'city',
        'state',
        'zipcode'
    ];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
