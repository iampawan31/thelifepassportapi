<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPersonalDetailsCompletion extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = ['step_id', 'user_id', 'is_visited', 'is_filled', 'is_completed'];

    public function getRouteKeyName() {
        return 'user_id';
    }

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }

    public function updatestepinfo($request, $user_id) {
        $inputs         = $request;
        $step_id        = $inputs['step_id'];
        $is_visited     = $inputs['is_visited'] ? '1' : '0';
        $is_filled      = $inputs['is_filled'] ? '1' : '0';
        $is_completed   = $inputs['is_completed'] ? '1' : '0';

        //check if record exists
        $result = self::where('step_id', $step_id)->where('user_id', $user_id)->get();

        if ($result->count() > 0) {
            self::where('user_id', $user_id)->where('step_id', $step_id)->update(['is_visited' => $is_visited, 'is_filled' => $is_filled, 'is_completed' => $is_completed]);
        } else {
            self::Create(['step_id' => $step_id, 'user_id' => $user_id, 'is_visited' => $is_visited, 'is_filled' => $is_filled, 'is_completed' => $is_completed]);
        }

        return true;
    }
}
