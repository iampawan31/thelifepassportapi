<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseInfo extends Model
{
    protected $fillable = [
        'user_id',
        'legal_name',
        'nickname',
        'home_address',
        'dob',
        'country_id',
        'passport_number',
        'father_name',
        'father_birth_place',
        'mother_name',
        'mother_birth_place',
        'marriage_date',
        'marriage_location'
    ];

    protected $with = ['address', 'phones', 'emails', 'socials', 'employers', 'step', 'country'];

    public function getMarriageDateAttribute($date)
    {
        return $this->attributes['marriage_date'] = date('m/d/Y', strtotime($date));
    }

    public function getDobAttribute($date)
    {
        return $this->attributes['dob'] = date('m/d/Y', strtotime($date));
    }

    public function address()
    {
        return $this->hasOne(SpouseAddress::class, 'user_id');
    }

    public function phones()
    {
        return $this->hasMany(SpousePhone::class, 'user_id')->select(['user_id', 'phone', 'is_primary']);
    }

    public function emails()
    {
        return $this->hasMany(SpouseEmail::class, 'user_id')->select(['user_id', 'email', 'password', 'is_primary']);
    }

    public function socials()
    {
        return $this->hasMany(SpouseSocialMedia::class, 'user_id');
    }

    public function employers()
    {
        return $this->hasMany(SpouseEmployer::class, 'user_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id')->select(['id', 'country_name']);
    }

    public function step()
    {
        return $this->hasOne(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 2);
    }
}
