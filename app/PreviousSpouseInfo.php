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
        'is_alimony_paid',
        'divorce_agreement_doc',
        'alimony_amount',
        'is_child_support',
        'child_support_amount'
    ];

    public function getMarriageDateAttribute($date)
    {
        return $this->attributes['marriage_date'] = date('m/d/Y', strtotime($date));
    }

    public function getDivorceDateAttribute($date)
    {
        return $this->attributes['divorce_date'] = date('m/d/Y', strtotime($date));
    }

    public function address()
    {
        return $this->hasOne(\App\PreviousSpouseAddress::class, 'user_id', 'user_id');
    }

    public function phones()
    {
        return $this->hasMany(\App\PreviousSpousePhone::class, 'user_id', 'user_id')->select(['user_id', 'phone', 'is_primary']);
    }

    public function documents()
    {
        return $this->hasOne(\App\DivorceDoc::class, 'user_id', 'user_id')->select(['user_id', 'title', 'url']);
    }

    public function childsupportdoc()
    {
        return $this->hasOne(\App\ChildSupportDoc::class, 'user_id', 'user_id')->select(['user_id', 'title', 'url']);
    }

    public function step()
    {
        return $this->hasOne(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 3);
    }

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
