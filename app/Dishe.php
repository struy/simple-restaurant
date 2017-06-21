<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dishe extends Model
{
    protected $fillable = ['name', 'cooking_time'];


    public function orders()
    {
        return $this->hasMany('App\Order','dishes_id');
    }
}
