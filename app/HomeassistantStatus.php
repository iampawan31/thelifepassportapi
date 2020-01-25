<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeassistantStatus extends Model
{
    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'has_homeassistant', 'count'];

    public function getRouteKeyName() {
        return 'user_id';
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
