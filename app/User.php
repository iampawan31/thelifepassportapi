<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['personal', 'address', 'phones', 'emails', 'socials', 'employers', 'steps'];

    /**
     * Get the personal info associated with the user.
     */
    public function personal()
    {
        return $this->hasOne(PersonalInfo::class);
    }

    public function address()
    {
        return $this->hasOne(PersonalAddress::class);
    }

    public function phones()
    {
        return $this->hasMany(UserPhone::class)->select(['user_id', 'phone', 'is_primary']);
    }

    public function emails()
    {
        return $this->hasMany(UserEmail::class)->select(['user_id', 'email', 'password', 'is_primary']);
    }

    public function socials()
    {
        return $this->hasMany(UserSocialMedia::class);
    }

    public function employers()
    {
        return $this->hasMany(UserEmployer::class);
    }

    public function steps()
    {
        return $this->belongsToMany(PersonalDetailsSteps::class, 'users_personal_details_completions', 'user_id', 'step_id')
            ->withPivot(['is_filled', 'is_visited', 'is_completed']);
    }

    public function stepCompleted($step)
    {
        return $this->steps()->wherePivot('step_id', $step)->first()->pivot->is_completed;
    }
}
