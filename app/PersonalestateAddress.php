<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalestateAddress extends Model
{
    protected $fillable = [
        'user_id', 
        'estate_id', 
        'street_address1', 
        'street_address2', 
        'city', 
        'state', 
        'zipcode'
    ];

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
