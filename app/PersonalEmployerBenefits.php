<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalEmployerBenefits extends Model
{
    
    protected $fillable = [
                            'user_id', 
                            'benefit_id'
                        ];
    
    static function tableName() {
        return with(new static)->getTable();
    }
}
