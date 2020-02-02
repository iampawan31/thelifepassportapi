<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpousePhone extends Model
{
    protected $fillable = ['user_id', 'phone', 'is_primary'];

    public function user()
    {
        return $this->belongsTo(SpouseInfo::class, 'user_id');
    }
}
