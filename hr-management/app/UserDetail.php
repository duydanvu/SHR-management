<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = "user_details";
    protected $primaryKey = "id";
    protected $fillable = ['identity_number','tin','idn_date','idn_address','ssc_number','hospital','ban','bank','noi_address','address_now'];
}
