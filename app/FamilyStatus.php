<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyStatus extends Model
{
    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'has_family_member', 'count'];

    public function getRouteKeyName() {
        return 'user_id';
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
