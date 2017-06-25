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
        $carbon = Carbon::createFromFormat('Y-m-d H:m:s', $dt,'UTC');
        if ($this->quantity == 1)  $cooking_time = ($this->dishe->cooking_time);
        else $cooking_time = ($this->dishe->cooking_time) * ($this->quantity)*0.1;
        $carbon->addMinutes($cooking_time);

        return $carbon->toDateTimeString();

    }

}
