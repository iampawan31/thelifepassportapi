<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
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
        'mother_birth_place'
    ];

    protected $casts = [
        'country_id' => 'integer'
    ];

    protected $table = 'personal_info';

    public function getDobAttribute($date)
    {
        if ($date) {
            return $this->attributes['dob'] = date('m/d/Y', strtotime($date));
        } else {
            return $this->attributes['dob'] = "";
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
