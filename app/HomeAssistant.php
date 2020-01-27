<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeAssistant extends Model
{
    protected $fillable = [
        'user_id',
        'person_name',
        'provider_name',
        'assistant_frequency',
        'care_date',
        'care_time'
    ];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }

    public function address()
    {
        return $this->hasOne(FriendsAddress::class, 'assistant_id');
    }
}
