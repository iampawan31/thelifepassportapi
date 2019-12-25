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
    
    protected $table = 'personal_info';

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
