<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalEstate extends Model
{
    protected $fillable = [
        'user_id', 
        'legal_name', 
        'relationship', 
        'company', 
        'phone', 
        'email', 
        'website'
    ];

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }

    public function Address() {
        return $this->hasOne(PersonalestateAddress::class, 'estate_id');
    }
}
