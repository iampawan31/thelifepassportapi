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
        'name', 'email', 'phone_number', 'password',
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
        return $this->hasOne(PersonalAddress::class, 'user_id');
    }

    public function phones()
    {
        //, Auth::user()->id
        return $this->hasMany(UserPhone::class, 'user_id')->select(['user_id', 'phone', 'is_primary']);
    }

    public function emails()
    {
        return $this->hasMany(UserEmail::class, 'user_id')->select(['user_id', 'email', 'password', 'is_primary']);
    }

    public function socials()
    {
        return $this->hasMany(UserSocialMedia::class, 'user_id');
    }

    public function employers()
    {
        return $this->hasMany(UserEmployer::class, 'user_id');
    }

    public function steps()
    {
        return $this->hasOne(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 1);
    }
}
