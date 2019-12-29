<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousSpouseInfo extends Model
{
    protected $fillable = [
        'user_id', 
        'legal_name', 
        'marriage_date', 
        'marriage_location', 
        'divorce_date', 
        'divorce_location', 
        'email',
        'is_alimony_paid'
    ];

    public function getRouteKeyName() {
        return 'user_id';
    }

    public function getMarriageDateAttribute($date) {
        return $this->attributes['marriage_date'] = date('m/d/Y', strtotime($date));
    }

    public function getDivorceDateAttribute($date) {
        return $this->attributes['divorce_date'] = date('m/d/Y', strtotime($date));
    }

    public function PreviousSpousePhone() {
        return $this->hasMany(\App\PreviousSpousePhone::class, 'user_id')->select(['user_id', 'phone', 'is_primary']);
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
