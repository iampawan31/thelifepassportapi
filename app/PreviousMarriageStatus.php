<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousMarriageStatus extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = ['user_id', 'is_previously_married'];

    public function getRouteKeyName() {
        return 'user_id';
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
