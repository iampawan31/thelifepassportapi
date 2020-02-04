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

    protected $with = ['address', 'step'];

    public function address()
    {
        return $this->hasOne(PersonalEstateAddress::class, 'estate_id');
    }

    public function step()
    {
        return $this->hasOne(UsersPersonalDetailsCompletion::class, 'step_id', 7);
    }
}
