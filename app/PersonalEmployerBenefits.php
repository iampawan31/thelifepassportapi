<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalEmployerBenefits extends Model
{
    protected $fillable = [
        'user_id',
        'employer_id',
        'benefit_id'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['first_name', 'last_name'];

    static function tableName()
    {
        return with(new static)->getTable();
    }

    public function employer()
    {
        return $this->belongsTo(UserEmployer::class, 'id', 'employer_id');
    }

    public function benefits()
    {
        return $this->belongsTo(EmployerBenefitsMaster::class);
    }
}
