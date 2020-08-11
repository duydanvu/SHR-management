<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "stores";
    protected $primaryKey = "store_id";
    protected $fillable = ['store_name','store_address','phone'];

    public function users(){
        return $this->hasMany('App\User');
    }
}
