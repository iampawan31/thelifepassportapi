<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEmail extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = ['user_id', 'email', 'password', 'is_primary'];

    public function getRouteKeyName() {
        return 'user_id';
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
