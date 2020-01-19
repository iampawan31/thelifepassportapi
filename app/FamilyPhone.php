<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyPhone extends Model
{   
    protected $fillable = ['user_id', 'family_member_id', 'phone'];

    // public function getRouteKeyName() {
    //     return 'user_id';
    // }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
