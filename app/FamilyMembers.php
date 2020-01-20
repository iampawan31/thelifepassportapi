<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMembers extends Model
{
    //protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 
        'legal_name', 
        'relationship_id', 
        'address', 
        'email', 
        'dob'
    ];

    public function getRouteKeyName() {
        return 'user_id';
    }

    public function FamilyPhone() {
        return $this->hasMany(\App\FamilyPhone::class, 'family_member_id')->select(['family_member_id', 'phone']);
    }

    public function FamilyRelation() {
        return $this->hasOne(\App\FamilyRelation::class, 'id', 'relationship_id')->select(['id', 'title']);
    }

    public function UsersPersonalDetailsCompletion() {
        return $this->hasMany(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 4);
    }
}
