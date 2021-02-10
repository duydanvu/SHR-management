<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    protected $table = "user_action";
    protected $primaryKey = "id";
    protected $fillable = ['user_id','action_id'];


}
