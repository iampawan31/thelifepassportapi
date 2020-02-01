<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Country extends Model
{
    protected $fillable = ['country_code', 'country_name'];

    //Table Name
    static function tableName() {
        return with(new static)->getTable();
    }
}
