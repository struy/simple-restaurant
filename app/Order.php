<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getTimeAttribute()
    {
        $dt = $this->created_at;
        $carbon = Carbon::instance($dt);
        $cooking_time = ($this->dishe->cooking_time) * ($this->quantity);
        $carbon->addMinutes($cooking_time);;


        return $carbon->toDateTimeString();;

    }

}
