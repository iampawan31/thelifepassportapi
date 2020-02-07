<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEmployer extends Model
{
    protected $fillable = [
        'user_id',
        'employer_name',
        'employer_phone',
        'computer_username',
        'computer_password',
        'benefits_used'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['address', 'benefits'];

    public static function boot()
    {
        parent::boot();
//
//        static::deleting(function ($userEmployer) { // before delete() method call this
//            $userEmployer->address()->delete();
//            $userEmployer->benefits()->delete();
//        });
    }

    public function address()
    {
        return $this->hasOne(SpouseEmployerAddress::class, 'employer_id', 'id');
    }

    public function benefits()
    {
        return $this->morphToMany(EmployerBenefitsMaster::class, 'benefits');

    }

    public function user()
    {
        return $this->belongsTo(SpouseInfo::class);
    }
}
