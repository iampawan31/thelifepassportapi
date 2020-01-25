<?php

namespace App;

use App\EmployerAddress;
use Illuminate\Database\Eloquent\Model;

class UserEmployer extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
                            'user_id', 
                            'employer_name', 
                            'employer_phone', 
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

    public function EmployerAddress() {
        return $this->hasOne(EmployerAddress::class, 'employer_id', 'id');
    }
}
