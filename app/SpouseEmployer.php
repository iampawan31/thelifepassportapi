<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEmployer extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'user_id', 
        'employer_name', 
        'employer_phone', 
        'employer_address', 
        'computer_username', 
        'computer_password', 
        'benefits_used'
    ];

    public function getRouteKeyName() {
        return 'user_id';
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }

    public function Address() {
        return $this->hasOne(SpouseEmployerAddress::class, 'employer_id', 'id');
    }

    public function Benefits() {
        return $this->hasMany(SpouseEmployerBenefits::class, 'employer_id', 'id');
    }
}
