<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEmployer extends Model
{
    protected $fillable = [
        'user_id',
        'employer_name',
        'employer_phone',
        'employer_address',
        'computer_username',
        'computer_password',
        'benefits_used'
    ];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }

    public function address()
    {
        return $this->hasOne(SpouseEmployerAddress::class, 'employer_id', 'id');
    }

    public function benefits()
    {
        return $this->hasMany(SpouseEmployerBenefits::class, 'employer_id', 'id');
    }
}
