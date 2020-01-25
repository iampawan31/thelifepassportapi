<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousSpouseInfo extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'user_id', 
        'legal_name', 
        'marriage_date', 
        'marriage_location', 
        'divorce_date', 
        'divorce_location', 
        'email',
        'address',
        'is_alimony_paid',
        'divorce_agreement_doc',
        'alimony_amount'
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

    public function Address () {
        return $this->hasOne(PreviousSpouseAddress::class, 'user_id');
    }

    public function PreviousSpousePhone() {
        return $this->hasMany(\App\PreviousSpousePhone::class, 'user_id')->select(['user_id', 'phone', 'is_primary']);
    }

    public function DivorceDoc() {
        return $this->hasMany(\App\DivorceDoc::class, 'user_id')->select(['user_id', 'title', 'url']);
    }

    public function UsersPersonalDetailsCompletion() {
        return $this->hasMany(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 3);
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
