<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseEmail extends Model
{
    protected $fillable = ['user_id', 'email', 'password', 'is_primary'];

    //Table Name
    static function tableName()
    {
        return with(new static)->getTable();
    }

    public function spouseinfo()
    {
        return $this->belongsTo(SpouseInfo::class, 'user_id');
    }
}
