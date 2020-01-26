<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'email', 'password', 'is_primary'];

    public function getRouteKeyName()
    {
        return 'user_id';
    }

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }

    /**
     * Get the user that owns the email.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
