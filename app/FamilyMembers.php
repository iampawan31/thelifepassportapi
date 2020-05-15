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

    protected $casts = [
        'dob' => 'datetime:m/d/Y'
    ];

    protected $with = ['address', 'phone', 'relation', 'step'];

    public function address()
    {
        return $this->hasOne(FamilyMemberAddress::class, 'family_member_id');
    }

    public function phone()
    {
        return $this->hasMany(FamilyPhone::class, 'family_member_id', 'id')->select(['family_member_id', 'phone']);
    }

    public function relation()
    {
        return $this->hasOne(FamilyRelation::class, 'id', 'relationship_id')->select(['id', 'title']);
    }

    public function step()
    {
        return $this->hasOne(UsersPersonalDetailsCompletion::class, 'user_id')->where('step_id', 4);
    }
}
