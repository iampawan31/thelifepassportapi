<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class PersonalDetailsSteps extends Model
{
    protected $fillable = ['step', 'slug', 'percentage', 'sequence'];

    /**
     * The users that has steps.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_personal_details_completions', 'step_id', 'user_id')
            ->withPivot(['is_filled', 'is_visited', 'is_completed']);
    }

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }
}
