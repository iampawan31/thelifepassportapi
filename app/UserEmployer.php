<?php

namespace App;

use App\EmployerAddress;
use Illuminate\Database\Eloquent\Model;

class UserEmployer extends Model
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

        static::deleting(function ($userEmployer) { // before delete() method call this
            $userEmployer->address()->delete();
            $userEmployer->benefits()->delete();
        });
    }

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }

    public function address()
    {
        return $this->hasOne(EmployerAddress::class, 'employer_id', 'id');
    }

    public function benefits()
    {
        return $this->hasMany(PersonalEmployerBenefits::class, 'employer_id', 'id');
    }
}
