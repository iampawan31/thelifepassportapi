<?php

namespace App;

use DB;
use App\User;
use Carbon\Carbon;
use App\UserPhone;
use App\UserEmail;
use Session, Auth;  
use App\UserEmployer;
use App\UserSocailMedia;
use App\UsersPersonalDetailsCompletion;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
                            'user_id', 
                            'legal_name', 
                            'nickname', 
                            'home_address', 
                            'street_address1',
                            'street_address2',
                            'city',
                            'state',
                            'zipcode',
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
        if($date) {
            return $this->attributes['dob'] = date('m/d/Y', strtotime($date));
        } else {
            return $this->attributes['dob'] = "";
        }
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

    public function UsersPersonalDetailsCompletion() {
        return $this->hasMany(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 1);
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
