<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerBenefitsMaster extends Model
{
    
    protected $fillable = [
                            'title', 
                            'status'
                        ];
    
    static function tableName() {
        return with(new static)->getTable();
    }
}
