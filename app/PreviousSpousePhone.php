<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousSpousePhone extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = ['user_id', 'phone', 'is_primary'];

    public function getRouteKeyName() {
        return 'user_id';
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
