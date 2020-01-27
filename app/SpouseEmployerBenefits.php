<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEmployerBenefits extends Model
{
    protected $fillable = [
        'user_id',
        'employer_id',
        'benefit_id'
    ];

    static function tableName()
    {
        return with(new static)->getTable();
    }
}
