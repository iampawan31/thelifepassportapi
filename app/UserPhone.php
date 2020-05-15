<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPhone extends Model
{
    protected $fillable = ['user_id', 'phone', 'is_primary'];

    /**
     * Get the user that owns the phone number.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
