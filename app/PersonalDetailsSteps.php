<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class PersonalDetailsSteps extends Model
{
    protected $fillable = ['step', 'slug', 'percentage', 'sequence'];

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }

    public function getPersonalDetailsStepsInfo($user_id) {
        $dbtable = self::tableName();
        $result = self::select(
                                $dbtable.'.*', 
                                DB::raw('users_personal_details_completions.is_filled'),
                                DB::raw('users_personal_details_completions.is_completed'),
                                DB::raw('users_personal_details_completions.created_at'),
                                DB::raw('users_personal_details_completions.updated_at')
                            )
                         ->leftJoin('users_personal_details_completions','users_personal_details_completions.step_id', '=', $dbtable.'.id')
                         ->where('users_personal_details_completions.user_id', $user_id); 
        
        $result =  $result->get();
        return $result;
    }
}
