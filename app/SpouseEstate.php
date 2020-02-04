<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEstate extends Model
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

    protected $with = ['address'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }

    public function address()
    {
        return $this->hasOne(SpouseEstateAddress::class, 'spouse_estate_id');
    }
}
