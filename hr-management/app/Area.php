<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "area";
    protected $primaryKey = "id";
    protected $fillable = ['area_name','area_description'];

    public function area(){
        return $this->hasMany('App\Store');
    }
}
