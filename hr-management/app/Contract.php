<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = "contracts";
    protected $primaryKey = "contract_id";
    protected $fillable = ['name','description'];

    public function users(){
        return $this->hasMany('App\User');
    }

}
