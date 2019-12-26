<?php

namespace App;

use DB;
use App\User;
use Carbon\Carbon;
use App\UserPhone;
use App\UserEmail;
use Session, Auth;  
use App\UserSocailMedia;
use App\UserEmployer;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $fillable = [
                            'user_id', 
                            'legal_name', 
                            'nickname', 
                            'home_address', 
                            'dob', 
                            'country_id', 
                            'passport_number', 
                            'father_name',
                            'father_birth_place',
                            'mother_name',
                            'mother_birth_place'
                        ];
    
    protected $table = 'personal_info';

    public function getRouteKeyName() {
        return 'user_id';
    }

    public function getDobAttribute($date) {
        return $this->attributes['dob'] = date('m/d/Y', strtotime($date));
    }

    public function UserPhone() {
        //, Auth::user()->id
        return $this->hasMany(UserPhone::class, 'user_id')->select(['user_id', 'phone', 'is_primary']);
    }

    public function UserEmail() {
        return $this->hasMany(UserEmail::class, 'user_id')->select(['user_id', 'email', 'password', 'is_primary']);
    }

    public function UserSocailMedia() {
        return $this->hasMany(UserSocailMedia::class, 'user_id');
    }

    public function UserEmployer() {
        return $this->hasMany(UserEmployer::class, 'user_id');
    }


    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
