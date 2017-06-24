<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    public function dishe()
    {
        return $this->belongsTo('App\Dishe', 'dishes_id');
    }

    public function getTimeAttribute($value)
    {
        $cooking_time = $this->dishe->cooking_time;
        $result = $cooking_time * $this->quantity;

        return $result;

    }

}
