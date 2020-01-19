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
