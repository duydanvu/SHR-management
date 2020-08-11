<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = "positions";
    protected $primaryKey = "position_id";
    protected $fillable = ['position_name','description'];

    public function users(){
        return $this->hasMany('App\User');
    }
}
