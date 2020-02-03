<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPersonalDetailsCompletion extends Model
{
    protected $fillable = ['step_id', 'user_id', 'is_visited', 'is_filled', 'is_completed'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_filled' => 'boolean',
        'is_completed' => 'boolean',
        'is_visited' => 'boolean',
    ];

    /**
     * The roles that belong to the user.
     */
    public function steps()
    {
        return $this->belongsToMany(PersonalDetailsSteps::class, 'users_personal_details_completions', 'user_id', 'step_id');
    }

    public function updatestepinfo($request, $user_id)
    {
        $inputs     = $request;
        $step_id    = $inputs['step_id'];

        $arrData        = [];
        $is_visited     = @$inputs['is_visited'] ? '1' : '0';
        $is_filled      = @$inputs['is_filled'] ? '1' : '0';
        $is_completed   = @$inputs['is_completed'] ? '1' : '0';

        $arrData['step_id'] = $step_id;
        $arrData['user_id'] = $user_id;

        if ($is_visited) {
            $arrData['is_visited'] = $is_visited;
        }

        if ($is_filled) {
            $arrData['is_filled'] = $is_filled;
        }

        if ($is_completed) {
            $arrData['is_completed'] = $is_completed;
        }

        //check if record exists
        $result = self::where('step_id', $step_id)->where('user_id', $user_id)->get();

        if ($result->count() > 0) {
            self::where('user_id', $user_id)->where('step_id', $step_id)->update($arrData);
        } else {

            self::Create($arrData);
        }

        return true;
    }
}
