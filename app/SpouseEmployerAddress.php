<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEmployerAddress extends Model
{
    protected $fillable = [
        'user_id', 
        'employer_id',
        'street_address1', 
        'street_address2', 
        'city', 
        'state', 
        'zipcode'
    ];

    static function tableName() {
        return with(new static)->getTable();
    }

    public function employer() {
        return $this->hasOne(SpouseEmployer::class, 'id', 'employer_id');
    }
}
