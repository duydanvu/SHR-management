<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = "services";
    protected $primaryKey = "id";
    protected $fillable = ['name','description'];

    public function users(){
        return $this->hasMany('App\User');
    }
}
