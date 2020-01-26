<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseestateStatus extends Model
{
    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'has_spouseestate', 'count'];

    public function getRouteKeyName() {
        return 'user_id';
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
