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

    public function employer()
    {
        return $this->belongsTo(SpouseEmployer::class, 'id', 'employer_id');
    }

    public function benefits()
    {
        return $this->belongsTo(EmployerBenefitsMaster::class, 'benefit');
    }
}
